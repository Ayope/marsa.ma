<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Models\DrivingLisense;
use App\Models\FishingLiscence;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $commonValidation = [];
        if($data['role'] == 2 || $data['role'] == 3){
            $commonValidation = [
                'license_number' => ['required', 'string'],
                'issue_date' => ['required', 'date'],
                'expiration_date' => ['required', 'date', 'after:' . $data['issue_date']],
                'notes' => ['required', 'string'],
                'document' => ['required', 'mimes:jpeg,png,jpg,svg', 'max:2048']
            ];
        }

        $rules = [
            'first-name' => ['required', 'string'],
            'last-name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'img' => ['required', 'image', 'mimes:jpeg,jpg,svg', 'max:2048']
        ];

        $additionalRules = [];

        if ($data['role'] == 2) {
            $additionalRules = [
                'type' => ['required', 'string'],
                'issuing_authority' => ['required', 'string'],
            ];

        } else if ($data['role'] == 3) {
            $additionalRules = [
                'max_deliveries_in_day' => ['required', 'integer'],
                // license
                'issuing_place' => ['required', 'string'],
                'class' => ['required', 'string', 'max:1'],
                // vehicle
                'registration_matricule' => ['required', 'string'],
                'make' => ['required', 'string'],
                'model' => ['required', 'string'],
                'capacity' => ['required', 'integer'],
                'photo' => ['required', 'image', 'mimes:jpeg,jpg,svg', 'max:2048'],
                'type' => ['required', 'string'],
                'insurance' => ['required', 'string'],
            ];
        }

        $rules = array_merge($rules, $additionalRules, $commonValidation);

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['role'] == 2 || $data['role'] == 3){
            $docName = $data['document']->getClientOriginalName();
        }

        $imgName=$data['img']->getClientOriginalName();
        $data['img']->move(public_path('profile-img'), $imgName);

        $user = User::create([
            'first_name' => $data['first-name'],
            'last_name' => $data['last-name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone'],
            'address' => $data['address'],
            'photo' => $imgName,
        ]);

        if($data['role'] == 2){
            $user->assignRole('fisher');

            $data['document']->move(public_path('fishing-liscences-img'), $docName);

            FishingLiscence::create([
                'license_number' => $data['license_number'],
                'expiration_date' => $data['expiration_date'],
                'issue_date' => $data['issue_date'],
                'type' => $data['type'],
                'issuing_authority' => $data['issuing_authority'],
                'fisher_id' => $user->id,
                'notes' => $data['notes'],
                'document' => $docName
            ]);
        }else if($data['role'] == 3){

            $data['document']->move(public_path('driving-liscences-img'), $docName);

            $user->assignRole('deliveryMan');

            $drivingLisence = DrivingLisense::create([
                'license_number' => $data['license_number'],
                'issue_date' => $data['issue_date'],
                'expiration_date' => $data['expiration_date'],
                'notes' => $data['notes'],
                'document' => $docName,
                'issuing_place' => $data['issuing_place'],
                'class' => $data['class'],
                'delivery_man_id' => $user->id

            ]);

            $photoName = $data['photo']->getClientOriginalName();
            $data['photo']->move(public_path('vehicle-img'), $photoName);

            $vehicle = Vehicle::create([
                'registration_matricule' => $data['registration_matricule'],
                'make' => $data['make'],
                'model' => $data['model'],
                'capacity' => $data['capacity'],
                'photo' => $photoName,
                'type' => $data['type'],
                'insurance' => $data['insurance'],
                'delivery_man_id' => $user->id
            ]);

            DeliveryMan::create([
                'max_deliveries_in_day'=> $data['max_deliveries_in_day'],
                'delivery_man_id' => $user->id,
                'fisher_id' => NULL,
                'vehicle_id' => $vehicle->id,
                'driving_lisence_id' => $drivingLisence->id
            ]);

        }else if($data['role'] == 1){
            $user->assignRole('client');
        }

        return $user;
    }
}
