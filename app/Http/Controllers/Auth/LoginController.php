<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login() 
    {
        $user = Socialite::driver('github')->stateless()->user();
        dd($user);
    }
}
