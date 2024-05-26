<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelPhoto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'uri',
        'hotel_id'
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class);

    }
    protected function uri(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => "/storage/{$value}"
        );
    }
}
