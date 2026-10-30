<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->merge([
            'phone' => preg_replace('/[\s-]/', '', (string) $request->phone),
        ]);

        $data = $request->validate([
            'name'     => 'required|string|min:2|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => ['required', 'regex:/^(\+62|62|0)8\d{7,11}$/'],
            'role'     => 'required|in:Penyewa,Pemilik',
            'password' => 'required|min:8|confirmed',
            'terms'    => 'accepted',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'role'     => $data['role'],
            'password' => $data['password'],
        ]);

        return redirect()->route('login')->with('status', 'Registrasi berhasil. Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return match (Auth::user()->role) {
                'Admin'   => redirect()->route('admin'),
                'Pemilik' => redirect()->route('pengguna'),
                default   => redirect()->route('cari-hunian'),
            };
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}