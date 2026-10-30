<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HunianController extends Controller
{
    // Daftar hunian untuk Penyewa
    public function index()
    {
        $hunian = Property::with('rooms')
            ->where('active', true)
            ->latest()
            ->get()
            ->map(fn ($p) => [
                'id'      => $p->id,
                'name'    => $p->name,
                'type'    => $p->type,
                'area'    => trim(Str::afterLast($p->location, ',')),
                'address' => $p->location,
                'price'   => (int) $p->price,
                'ok'      => $this->tersedia($p),
                'image'   => $p->image ? Storage::url($p->image) : null,
            ]);

        return view('cari-hunian', compact('hunian'));
    }

    // Detail satu hunian
    public function show(Property $property)
    {
        abort_unless($property->active, 404);

        $property->load('rooms');

        $hunian = [
            'id'         => $property->id,
            'name'       => $property->name,
            'type'       => $property->type,
            'location'   => $property->location,
            'price'      => (int) $property->price,
            'ok'         => $this->tersedia($property),
            'image'      => $property->image ? Storage::url($property->image) : null,
            'facilities' => $property->rooms->pluck('facilities')->flatten()->filter()->unique()->values(),
            'rooms'      => $property->rooms->map(fn ($r) => [
                'name'      => $r->name,
                'available' => $r->status === 'Tersedia',
            ])->values(),
        ];

        return view('detail', compact('hunian'));
    }

    // Kos yang punya kamar: tersedia jika ada kamar kosong. Lainnya: tersedia.
    private function tersedia(Property $p): bool
    {
        return $p->rooms->isNotEmpty()
            ? $p->rooms->contains('status', 'Tersedia')
            : true;
    }
}