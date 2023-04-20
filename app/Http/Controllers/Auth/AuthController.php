<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Models\Vehicle;
use App\Models\DeliveryMan;
use Illuminate\Http\Request;
use App\Models\DrivingLisense;
use App\Models\ProductCommand;
use App\Models\FishingLiscence;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function registration(){
        return view('auth.register');
    }

    public function registerUser(Request $request){
        $commonValidation = [];
        if($request->role == 2 || $request->role == 3){
            $commonValidation = [
                'license_number' => ['required', 'string'],
                'issue_date' => ['required', 'date'],
                'expiration_date' => ['required', 'date', 'after:' . $request['issue_date']],
                'notes' => ['required', 'string'],
                'document' => ['required', 'mimes:jpeg,png,jpg,svg', 'max:2048']
            ];
        }

        $rules = [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'img' => ['required', 'image', 'mimes:jpeg,jpg,svg', 'max:2048']
        ];

        $additionalRules = [];

        if ($request->role == 2) {
            $additionalRules = [
                'type' => ['required', 'string'],
                'issuing_authority' => ['required', 'string'],
            ];
        }

        $rules = array_merge($rules, $additionalRules, $commonValidation);

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

            $imgName = time().'.'.$request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('profile-img'), $imgName);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone,
                'address' => $request->address,
                'photo' => $imgName,
            ]);

            if($request->role == 2){
                $user->assignRole('fisher');

                $docName = time().'.'.$request->file('document')->getClientOriginalName();
                $request->file('document')->move(public_path('fishing-liscences-img'), $docName);

                FishingLiscence::create([
                    'license_number' => $request->license_number,
                    'expiration_date' => $request->expiration_date,
                    'issue_date' => $request->issue_date,
                    'type' => $request->type,
                    'issuing_authority' => $request->issuing_authority,
                    'fisher_id' => $user->id,
                    'notes' => $request->notes,
                    'document' => $docName
                ]);

                return redirect('login')->with('success', 'You registered successfully');

            } else if($request->role == 1){
                $user->assignRole('client');
                return redirect('login')->with('success', 'You registered successfully');
            }
    }

    //login

    public function login(){
        return view('auth.login');
    }

    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' =>'required|string|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user){
        if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginUser', $user->id);
                $request->session()->put('role', $user->roles->pluck('name')[0]);

                $userId = $user->id;

                if($user->hasRole('client')){
                    $request->session()->put('user', $user);
                    return redirect('/store');
                }

                $request->session()->put('user', $user);
                return redirect('/store');

            }else{
                Session::pull('loginUser');
                return back()->with('fail', 'Password are not correct');
            }
        }else{
            Session::pull('loginUser');
            return back()->with('fail', 'This email is not registered');

        }
    }

    // logout
    public function logout(){
        if(Session::has('loginUser')){
            Session::pull('loginUser');
            return redirect('login');
        }
    }
}
