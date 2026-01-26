<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'type',
    ];

    // Relationships
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}