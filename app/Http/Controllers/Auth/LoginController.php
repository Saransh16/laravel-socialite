<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $providers = [
        'github','google'
    ];

    public function redirectToProvider($driver)
    {
        if( ! $this->isProviderAllowed($driver) ) {
            //return with error message that driver not supported
        }

        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver) 
    {
        $providerUser = Socialite::driver($driver)->stateless()->user();

        $user = User::where('email', $providerUser->getEmail())->first();

        if($user) {
            // update the provider that might have changed
            $user->update([
                'provider' => $driver,
                'provider_id' => $providerUser->getid(),
                'provider_token' => $providerUser->token
            ]);
        } else {
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'provider' => $driver,
                'provider_id' => $providerUser->getid(),
                'provider_token' => $providerUser->token,
            ]);
        }

        dd($user);
        
        //login user and redirect to dashboard page
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }
}
