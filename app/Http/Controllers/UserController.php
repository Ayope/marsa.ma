<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'img' => 'image|mimes:jpeg,jpg,svg|max:2048',
        ]);

        $user = User::find($request->session()->get('user')->id);

// need to fix the image (take the image name and store it and delete the previous one)

        // if ($request->filled('first_name') && Str::is($request->input('first_name'), $user->first_name)) {
        //     if ($request->filled('last_name') && Str::is($request->input('last_name'), $user->last_name)) {
        //         if ($request->filled('email') && Str::is($request->input('email'), $user->email)) {
        //             if ($request->filled('phone') && Str::is($request->input('phone'), $user->phone)) {
        //                             dd('hh');

        //                 if ($request->filled('address') && Str::is($request->input('address'), $user->address)) {
        //                             dd('hh');

        //                     if ($request->filled('password') && Hash::check($request->input('password'), $user->password)) {
        //                             dd('hh');
        //                         if ($request->hasFile('img') && Str::is($request->file('img')->getClientOriginalName(), $user->photo)) {
        //                             dd('hh');
        //                             return back()->with('fail', 'No changes');
        //                         }
        //                     }
        //                 }
        //             }
        //         }            
        //     } 
        // }
        
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'photo' => $request->img,
        ]);

        if($request->filled('password')){
            $request->validate([
                'password' => 'string|min:8|confirmed'
            ]);
            
            if(Hash::check($request->old_Password, $user->password)){
                $user->update([
                    'password' => $request->password
                ]);
            }
        }

        return back()->with('success', 'updated successfully');
        
    }
}
