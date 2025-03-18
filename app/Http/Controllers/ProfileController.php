<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update( Request $request )
    {
             $user = auth()->user();
             $validatedData = $request->validate([
                 'name' => 'required|string|max:255',
                 'email' => 'required|string|email|max:255',
                 'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
             ]);
             if($request->hasFile('avatar')) {
                 $file = $request->file('avatar')->store('avatars', 'public'); 
                 $user->avatar = $file;
             } 
             $user->name = $validatedData['name'];
             $user->email = $validatedData['email'];
             $user->save();
             return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
            
    }
}
