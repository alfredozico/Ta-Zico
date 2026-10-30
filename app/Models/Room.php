<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    protected $fillable = ['property_id', 'name', 'price', 'facilities', 'status', 'image'];

    protected function casts(): array
    {
        return ['facilities' => 'array'];
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}