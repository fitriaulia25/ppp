<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Display the profile page
    public function edit() {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function show()
    {
        $user = Auth::user(); // Ambil user yang sedang login
        return view('profile.show', compact('user')); // Ganti 'profile.show' dengan nama view Anda
    }

    public function update(Request $request){
        $user = Auth::user();
        // Validate the input    $request->validate
        ([
            'name' => 'required|string|max:255',       
            'email' => 'required|email|max:255',
            'old_password' => 'nullable|string',        
            'new_password' => 'nullable|string|confirmed|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',    ]);
        // Update name and email
        $user->name = $request->input('name');    $user->email = $request->input('email');
        // Handle password update
        if ($request->filled('old_password') && $request->filled('new_password')) {        if (Hash::check($request->input('old_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));        } else {
                return back()->with('error', 'Old password does not match!');        }
        }
        // Handle profile photo upload   
         if ($request->hasFile('photo')) {
            // Delete the old photo if it exists    
        if ($user->photo && Storage::exists('public/' . $user->photo))
             {
                Storage::delete('public/' . $user->photo);        }
            // Store the new photo
            $path = $request->file('photo')->store('public/photos');        $user->photo = str_replace('public/', '', $path);
        }
        // Save the user data  
          $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}