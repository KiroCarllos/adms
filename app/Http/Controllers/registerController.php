<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{



public function register(){
    return view('account.register');
}




    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->idnum = $request->idnum;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();


        if ($user->save()) {
            return back()->with('success', 'Account is created successfully!!');
        } else {
            return back()->with('error', 'User already exists!');
        }


        // Additional logic if needed

    }

    public function login() {

        return view ('account.login');

    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            if(auth()->user()->role == "head"){
                return redirect()->route("roleHead","becolar")->with('success', 'Login successful!');
            }

            return redirect('/role')->with('success', 'Login successful!');

        }

        return back()->with('error', 'Email or password incorrect!');
    }
}
