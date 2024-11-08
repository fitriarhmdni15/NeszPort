<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'name',
        'class',
        'major',
        'sports_equipment_id',
        'quantity',
        'borrowed_at',
        'returned_at'
    ];

    public function sportsEquipment()
    {
        return $this->belongsTo(SportsEquipment::class);
    }
}
