<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['accountNoActive' => 'Your account is not active. Please contact the admin.']);
            }

            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['loginError' => 'Login failed. Please check your credentials and try again.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
