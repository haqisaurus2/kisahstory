<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Google_Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Firebase\JWT\JWT;

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
  
            $credentials =  ['username' => $user->email, 'id' => $user->id];
            $credentials['exp'] = time() + (60 * 60);

            if (! $token = JWT::encode($credentials, env('JWT_SECRET'), 'HS256')) {
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
            
    
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $credentials['exp']
            ]);
        } else {
            return response()->json(['error' => 'Invalid Google Token'], 401);
        }
    }
    // public function refreshToken()
    // {
    //     try {
    //         $newToken = JWTAuth::refresh(JWTAuth::getToken());
    //         return response()->json(['token' => $newToken]);
    //     } catch (TokenExpiredException $e) {
    //         return response()->json(['error' => 'Token has expired, cannot refresh'], 401);
    //     }
    // }
    public function me(Request $request)
    {
        $userInfo = $request->get('userInfo');
        $user = User::where("id", "=", $userInfo["id"])->firstOrFail();
        $user->password = "";
        return response()->json($user);
    }

    // public function logout(Request $request)
    // {
    //     try {
    //         JWTAuth::invalidate(JWTAuth::getToken());
    //         return response()->json(['message' => 'Successfully logged out']);
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => 'Failed to logout, please try again'], 500);
    //     }
    // }

}