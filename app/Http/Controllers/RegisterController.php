<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
         
        ]);

        // $validatedData['passsword'] = bcrypt($validatedData['password']);
        //menjadikan password di hash/encrypt
        $validatedData['password'] = Hash::make($validatedData['password']);
        //create a new user
        User::create($validatedData);
        
        return redirect()->route('login')->with('success', 'Registration successfull! Pleasse Login');
    }
}
