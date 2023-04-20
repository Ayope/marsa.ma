<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\DeliveryMan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DrivingLisense;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class DeliveryManController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliverymen = DeliveryMan::with('user')->get();
        return view('deliverymen.index', compact('deliverymen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deliverymen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'img' => 'required|image|mimes:jpeg,jpg,svg|max:2048',


            'license_number' => 'required|string',
            'issue_date' => 'required|date',
            'expiration_date' => 'required|date|after:' . $request['issue_date'],
            'notes' => 'required|string',
            'document' => 'required|mimes:jpeg,png,jpg,svg|max:2048',

            'max_deliveries_in_day' => 'required|integer',
            // license
            'issuing_place' =>  'required|string',
            'class' =>  'required|string|max:1',
            // vehicle
            'registration_matricule' =>  'required|string',
            'make' =>  'required|string',
            'model' =>  'required|string',
            'capacity' => 'required|integer',
            'photo' => 'required|image|mimes:jpeg,jpg,svg|max:2048',
            'type' =>  'required|string',
            'insurance' =>  'required|string',
        ]);

        if($validate){
                $password = Str::random(12);

                $password = Str::random(2, '0123456789')
                            . Str::random(2, '!@#$%^&*()_+-=')
                            . Str::random(8, 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

                $imgName = time().'.'.$request->file('img')->getClientOriginalName();
                $request->file('img')->move(public_path('profile-img'), $imgName);

                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($password),
                    'phone_number' => $request->phone,
                    'address' => $request->address,
                    'photo' => $imgName,
                ]);


            if($user){
                $docName = time().'.'.$request->file('document')->getClientOriginalName();
                $request->file('document')->move(public_path('driving-liscences-img'), $docName);

                $user->assignRole('deliveryMan');

                $drivingLisence = DrivingLisense::create([
                    'license_number' => $request->license_number,
                    'issue_date' => $request->issue_date,
                    'expiration_date' => $request->expiration_date,
                    'notes' => $request->notes,
                    'document' => $docName,
                    'issuing_place' => $request->issuing_place,
                    'class' => $request->class,

                ]);

                $photoName = time().'.'.$request->file('photo')->getClientOriginalName();
                $request->file('photo')->move(public_path('vehicle-img'), $photoName);

                $vehicle = Vehicle::create([
                    'registration_matricule' => $request->registration_matricule,
                    'make' => $request->make,
                    'model' => $request->model,
                    'capacity' => $request->capacity,
                    'photo' => $photoName,
                    'type' => $request->type,
                    'insurance' => $request->insurance,
                ]);

                DeliveryMan::create([
                    'max_deliveries_in_day'=> $request->max_deliveries_in_day,
                    'delivery_man_id' => $user->id,
                    'fisher_id' => $request->fisher_id,
                    'vehicle_id' => $vehicle->id,
                    'driving_lisence_id' => $drivingLisence->id
                ]);

                $mail = Mail::send('auth.email.deliveryManCrendentials', ['password' => $password, 'email' => $request->email], function($message) use ($request) {
                    $message->to($request->email)->subject('Your credentials to connect to marsa.ma');
                });

                if($mail){
                    return redirect('show_delivery_men')->with('success', 'Your delivery man added successfully (and he will get email by his credentials).');
                }
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $deliveryman = DeliveryMan::with('user','drivingLisense','vehicle')->where('delivery_man_id', $user_id)->first();
        // dd($deliverymen);
        return view('deliverymen.show', compact('deliveryman'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $user = User::with('deliveryMan')->where('id', $user_id)->first();

        $path = public_path('profile-img/'. $user->photo);

        if(file_exists($path) && $user->photo != null){
            unlink($path);
        }

        $user->delete();

        return back()->with('success', 'delivery man deleted successfully');
    }
}
