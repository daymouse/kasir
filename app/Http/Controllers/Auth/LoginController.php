<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function create()
    {
        return view('auth.signin');
    }

    /**
     * Handle login request.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $rememberMe = $request->boolean('remember');


        if (Auth::attempt($credentials, $rememberMe)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            return match ($userRole) {
                'admin' => redirect('/dashboard'), // Hapus intended()
            'karyawan' => redirect('/kasir'),
                default => $this->logoutWithError($request, 'Akses tidak diizinkan untuk peran ini.'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }


    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }

    /**
     * Logout and return an error message.
     */
    private function logoutWithError(Request $request, string $message)
    {
        Auth::logout();
        return back()->withErrors(['message' => $message]);
    }

    public function defauld(Request $request)
    {
        $userRole = Auth::user()->role;

        return match ($userRole) {
            'admin' => redirect()->intended('/dashboard'),
            'karyawan' => redirect()->intended('/kasir'),
            default => $this->logoutWithError($request, 'Akses tidak diizinkan untuk peran ini.'),
        };

    }
}
