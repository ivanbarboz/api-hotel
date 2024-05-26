<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'address',
        'price',
        'roomType',
        'phoneNumber',
        'department_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function photos(){
        return $this->hasMany(HotelPhoto::class);
    }
}
