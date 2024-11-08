<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SportsEquipment extends Model
{
    //
    use HasFactory;
    protected $table = 'sports_equipment';  
    protected $fillable = ['name', 'description', 'quantity'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
