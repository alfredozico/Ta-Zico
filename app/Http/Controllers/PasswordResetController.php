<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function show()
    {
        return view('forgot-password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'phone'    => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);

        // Samakan format: hapus spasi/tanda -, awalan 0 / +62 jadi 62
        $norm = fn ($n) => preg_replace('/^(\+?62|0)/', '62', preg_replace('/[\s\-]/', '', (string) $n));

        // Akun Admin tidak boleh direset lewat halaman ini
        $user = User::where('email', $data['email'])->where('role', '!=', 'Admin')->first();

        if (! $user || ! $user->phone || $norm($user->phone) !== $norm($data['phone'])) {
            return back()
                ->withErrors(['email' => 'Email dan nomor HP tidak cocok dengan akun mana pun.'])
                ->onlyInput('email', 'phone');
        }

        $user->password = $data['password']; // otomatis di-hash oleh model
        $user->save();

        return redirect()->route('login')->with('status', 'Password berhasil diubah. Silakan login.');
    }
}