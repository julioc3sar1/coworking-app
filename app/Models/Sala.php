<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\RoomFactory;

class Sala extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    protected static function newFactory()
    {
        return RoomFactory::new();
    }

    public function users()
    {
        return $this->hasMany(User::class, 'sala_user');
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
