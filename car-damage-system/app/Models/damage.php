<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory;

    protected $fillable = [
        'place',
        'date',
        'desc'
    ];

    public function vehicles() {
        return $this->belongsToMany(Vehicle::class);
    }
}
