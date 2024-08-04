<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;  
use TheSeer\Tokenizer\Exception;
use App\Models\User;
use URL; 

class SocialiteController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
  
        return redirect('/');
    }
    public function redirectToProvider($provider, Request $request)
    { 
         // Inintialize a URL to the variable 
        $url = URL::previous(); 
        $redirectURL = "/";
        // Use parse_url() function to parse the URL 
        // and return an associative array which contains its various components 
        $url_components = parse_url($url); 
        
        if (array_key_exists('query', $url_components)) {
            parse_str($url_components['query'], $params); 
            var_dump($url_components);
            if (array_key_exists("redirect", $params)) {
                var_dump($params);

                $redirectURL = $params["redirect"];
            }
        }  
         
        Session::put('url.intended', $redirectURL); 
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->stateless()->user(); 
        } catch (Exception $e) {
            return redirect()->back();
        }
        // find or create user and send params user get from socialite and provider
        $authUser = $this->findOrCreateUser($user, $provider);

        // login user
        Auth()->login($authUser, true);

        // setelah login redirect ke dashboard
        $url = Session::get('url.intended', url('/'));
        var_dump($url);

        Session::forget('url.intended');
        return redirect($url) ; 
    }

    public function findOrCreateUser($socialUser, $provider)
    {
        // Get Social Account
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();

        // Jika sudah ada
        if ($socialAccount) {
            // return user
            return $socialAccount->user;

            // Jika belum ada
        } else {

            // User berdasarkan email 
            $user = User::where('email', $socialUser->getEmail())->first();

            // Jika Tidak ada user
            if (!$user) {
                // Create user baru
                $user = User::create([
                    'photo' => $socialUser->getAvatar(),
                    'first_name'  => $socialUser->getName(), 
                    'last_name'  => "", 
                    'email' => $socialUser->getEmail(),
                    'username' => $socialUser->getEmail(),
                    'password' => Hash::make($socialUser->getEmail(), ['rounds' => 12,]),
                    'is_superuser' => false,
                    'is_active' => true,
                    'is_staff' => true,
                    'last_login' => date('Y-m-d H:i'),
                    'date_joined' => date('Y-m-d H:i'),
                ]);
            }

            // Buat Social Account baru
            $user->socialAccounts()->create([
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider
            ]);

            // return user
            return $user;
        }
    }
}
