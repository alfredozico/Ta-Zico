<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', Auth::id())
            ->latest()
            ->get()
            ->map(fn ($p) => [
                'id'       => $p->id,
                'name'     => $p->name,
                'type'     => $p->type,
                'location' => $p->location,
                'price'    => (int) $p->price,
                'active'   => $p->active,
                'image'    => $p->image ? Storage::url($p->image) : null,
            ]);

        return view('pengguna', compact('properties'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('properties', 'public');
        }

        Property::create($data + ['user_id' => Auth::id()]);

        return redirect()->route('pengguna')->with('status', 'Properti berhasil ditambahkan.');
    }

    public function update(Request $request, Property $property)
    {
        abort_if($property->user_id !== Auth::id(), 403);

        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            if ($property->image) {
                Storage::disk('public')->delete($property->image);
            }
            $data['image'] = $request->file('image')->store('properties', 'public');
        } else {
            unset($data['image']); // tidak memilih foto baru: pakai foto lama
        }

        $property->update($data);

        return redirect()->route('pengguna')->with('status', 'Properti berhasil diperbarui.');
    }

    public function destroy(Property $property)
    {
        abort_if($property->user_id !== Auth::id(), 403);

        if ($property->image) {
            Storage::disk('public')->delete($property->image);
        }

        $property->delete();

        return redirect()->route('pengguna')->with('status', 'Properti dihapus.');
    }

    private function rules(): array
    {
        return [
            'name'     => 'required|string|min:3|max:255',
            'type'     => 'required|in:Kos,Kontrakan',
            'location' => 'required|string|max:255',
            'price'    => 'required|integer|min:0',
            'active'   => 'required|boolean',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}