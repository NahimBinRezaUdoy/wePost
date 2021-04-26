<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        //validate User 
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        //sign the user in
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->back()->with('message', 'Invalid Login Detaiils');
        }

        //redirect the user in Dashboard
        return redirect()->route('dashboard');

        dd('store');
    }
}
