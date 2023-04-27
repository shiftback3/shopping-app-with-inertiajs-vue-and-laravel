<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Inertia\Inertia;

class RegisterController extends Controller
{

    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Inertia::render('Public/Register', [
            // Data goes here......
        ]);
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return redirect('/dashboard')->with('notification', [
            'color' => 'green',
            'title' => 'success',
            'message' => 'Login Successful!',
        ]);
    }
}