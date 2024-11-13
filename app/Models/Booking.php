<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'room_id', 'start_date', 'end_date'];
    
    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
