<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    public function handleGoogleAuth(Request $request)
    {
        $token = $request->input('tokenId');

        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]); // Specify your Google Client ID
        $payload = $client->verifyIdToken($token);

        if ($payload) {
            $googleId = $payload['sub'];
            $email = $payload['email'];
            $avatar = $payload['picture'];
            $firstName = $payload['given_name'];
            $lastName = $payload['family_name'];

            // Find or create the user
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'username' => $email,
                    'password' => Hash::make($googleId),
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'google_id' => $googleId,
                    'photo' => $avatar,
                    'is_superuser' => false,
                    'is_staff' => false,
                    'is_active' => true,
                    'last_login' => Carbon::parse(Carbon::now())->setTimezone('Asia/Jakarta'),
                    'date_joined' => Carbon::parse(Carbon::now())->setTimezone('Asia/Jakarta'),
                ]
            );
  
            $credentials =  ['username' => $user->email, 'password' => $googleId];
            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'Invalid Credentials'], 401);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'Could not create token' . $e->getMessage()], 500);
            }
    
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60
            ]);
        } else {
            return response()->json(['error' => 'Invalid Google Token'], 401);
        }
    }
    public function refreshToken()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json(['token' => $newToken]);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired, cannot refresh'], 401);
        }
    }
    public function me()
    {
        try {            
            return response()->json(JWTAuth::user());
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }

}