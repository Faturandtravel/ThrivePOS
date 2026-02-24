<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/cashier');
        }

        $totalUsers = 0;
        $firebaseStatus = 'Belum terhubung';

        try {
            $auth = Firebase::auth();
            $users = $auth->listUsers();
            $totalUsers = count(iterator_to_array($users));
            $firebaseStatus = 'Berhasil terhubung!';
        } catch (\Exception $e) {
            $firebaseStatus = 'Error: ' . $e->getMessage();
        }

        return view('auth.login', [
            'status' => $firebaseStatus,
            'totalUsers' => $totalUsers
        ]);
    }

    public function verifyGoogle(Request $request)
    {
        $token = $request->input('token');

        try {
            $auth = Firebase::auth();
            $verifiedIdToken = $auth->verifyIdToken($token);
            $email = $verifiedIdToken->claims()->get('email');
            $name = $verifiedIdToken->claims()->get('name');
            $picture = $verifiedIdToken->claims()->get('picture');

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => bcrypt(Str::random(16)),
                    'avatar' => $picture
                ]
            );

            if ($picture && $user->avatar !== $picture) {
                $user->avatar = $picture;
                $user->save();
            }

            Auth::login($user);

            return response()->json(['message' => 'Login berhasil!']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Token tidak valid atau error: ' . $e->getMessage()], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}