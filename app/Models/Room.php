<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\RoomFactory;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    protected static function newFactory()
    {
        return RoomFactory::new();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'room_user');
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
