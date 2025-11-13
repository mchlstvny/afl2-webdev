<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'location',
        'date_time',
        'image_url'
    ];

    protected $casts = [
        'date_time' => 'datetime'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}