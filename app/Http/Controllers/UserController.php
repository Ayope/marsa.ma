<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($user_id)
    {
        $user = User::where('id', $user_id)->first();
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request){
        
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string|email',
            'phone' => 'string',
            'address' => 'string',
        ]);


        $user = User::find($request->session()->get('user')->id);
        
        if($request->hasFile('img')){
            
            $path = public_path('profile-img/'. $user->photo);

            if(file_exists($path) && $user->photo != null){
                unlink($path);
            }

            $request->validate([
                'img' => 'image|mimes:jpeg,jpg,svg|max:2048',
            ]); 
            
            $imgName = time().'.'.$request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('profile-img'), $imgName);
            
            $user->update([
                'photo' => $imgName,
            ]);
        }

        
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'address' => $request->address,
        ]);

        if($request->filled('password')){
            $request->validate([
                'password' => 'string|min:8|confirmed'
            ]);
            
            if(Hash::check($request->old_Password, $user->password)){
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
        }

        $request->session()->put('user', $user);

        return back()->with('success', 'updated successfully');
        
    }

    public function roleCount($role){
        $user = User::whereHas('roles', function($q) use ($role){
            $q->where('name', $role);
        })->count();
        return $user;
    }
}
