<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // dd(Auth::user(), get_class(Auth::user()), method_exists(Auth::user(), 'isAdmin'));
            if (Auth::user()->isAdmin()) {
                return redirect()->route('index')->with('status', 'Selamat datang, Admin!');
            } else {
                return redirect()->intended('/landingPage')->with('status', 'Selamat datang, Pengguna!');
            }
            return redirect()->intended('/index')->with('status', 'Anda berhasil login!');
        }

        throw ValidationException::withMessages([
            'email' => ['Kredensial yang diberikan tidak cocok dengan catatan kami.'],
        ])->redirectTo(route('login'));
    }

    public function showRegistrationForm()
    {
        return view('register'); // Sesuaikan path view jika Anda menyimpannya di tempat lain
    }


    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' akan memeriksa password_confirmation
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Login user yang baru terdaftar
        Auth::login($user);

        // Redirect ke halaman landingPage setelah pendaftaran sukses
        return redirect()->route('landingPage')->with('status', 'Akun Anda berhasil didaftarkan dan Anda telah login!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Anda telah berhasil logout.');
    }
}
