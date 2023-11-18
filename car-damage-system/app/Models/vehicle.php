<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'license',
        'type',
        'model',
        'year',
        'img_hash_name'
    ];

    public function damages() {
        return $this->belongsToMany(Damage::class);
    }
}
