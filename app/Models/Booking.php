<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'room_id', 'start_date', 'end_date'];

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
