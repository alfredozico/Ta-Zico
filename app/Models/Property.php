<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = ['user_id', 'name', 'type', 'location', 'price', 'active', 'image'];

    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
}