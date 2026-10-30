<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->get()->map(fn ($u) => [
            'id'         => $u->id,
            'name'       => $u->name,
            'email'      => $u->email,
            'phone'      => $u->phone ?? '-',
            'role'       => $u->role,
            'status'     => 'Aktif',
            'date'       => $u->created_at->translatedFormat('j M Y'),
            'can_delete' => $u->role !== 'Admin' && $u->id !== Auth::id(),
        ]);

        $stats = [
            'total'   => User::count(),
            'penyewa' => User::where('role', 'Penyewa')->count(),
            'pemilik' => User::where('role', 'Pemilik')->count(),
            'admin'   => User::where('role', 'Admin')->count(),
        ];

        return view('admin', compact('users', 'stats'));
    }

    public function destroy(User $user)
    {
        // Admin dan akun sendiri tidak boleh dihapus
        abort_if($user->role === 'Admin' || $user->id === Auth::id(), 403, 'Akun ini tidak dapat dihapus.');

        DB::transaction(function () use ($user) {
            // Hapus file foto properti dan kamar milik akun ini
            $properties = Property::with('rooms')->where('user_id', $user->id)->get();
            foreach ($properties as $p) {
                foreach ($p->rooms as $room) {
                    if ($room->image) {
                        Storage::disk('public')->delete($room->image);
                    }
                }
                if ($p->image) {
                    Storage::disk('public')->delete($p->image);
                }
            }

            // Putuskan sesi login akun ini (jika sesi disimpan di database)
            if (Schema::hasTable('sessions')) {
                DB::table('sessions')->where('user_id', $user->id)->delete();
            }

            // Properti dan kamar ikut terhapus otomatis (cascade di database)
            $user->delete();
        });

        return redirect()->route('admin')->with('status', 'Akun "' . $user->name . '" berhasil dihapus.');
    }
}