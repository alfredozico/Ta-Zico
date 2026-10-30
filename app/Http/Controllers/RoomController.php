<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('property')
            ->whereHas('property', fn ($q) => $q->where('user_id', Auth::id()))
            ->latest()
            ->get()
            ->map(fn ($r) => [
                'id'          => $r->id,
                'property_id' => $r->property_id,
                'name'        => $r->name,
                'property'    => $r->property->name,
                'price'       => (int) $r->price,
                'facilities'  => $r->facilities ?? [],
                'status'      => $r->status,
                'image'       => $r->image ? Storage::url($r->image) : null,
            ]);

        // Hanya properti berjenis Kos milik Pemilik yang login
        $properties = Property::where('user_id', Auth::id())
            ->where('type', 'Kos')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('kamar', compact('rooms', 'properties'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(
            Rule::exists('properties', 'id')->where('user_id', Auth::id())->where('type', 'Kos')
        ));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $data['facilities'] = $data['facilities'] ?? [];

        Room::create($data);

        return redirect()->route('kamar')->with('status', 'Kamar berhasil ditambahkan.');
    }

    public function update(Request $request, Room $room)
    {
        abort_if($room->property->user_id !== Auth::id(), 403);

        // Saat edit, properti boleh jenis apa pun asal milik Pemilik ini
        $data = $request->validate($this->rules(
            Rule::exists('properties', 'id')->where('user_id', Auth::id())
        ));

        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        } else {
            unset($data['image']); // tidak memilih foto baru: pakai foto lama
        }

        $data['facilities'] = $data['facilities'] ?? [];

        $room->update($data);

        return redirect()->route('kamar')->with('status', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        abort_if($room->property->user_id !== Auth::id(), 403);

        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('kamar')->with('status', 'Kamar dihapus.');
    }

    private function rules($propertyRule): array
    {
        return [
            'property_id'  => ['required', $propertyRule],
            'name'         => 'required|string|min:2|max:255',
            'price'        => 'required|integer|min:0',
            'facilities'   => 'nullable|array',
            'facilities.*' => 'in:WiFi,AC,Kipas Angin,Kamar Mandi Dalam',
            'status'       => 'required|in:Tersedia,Terisi',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}