<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\BookingFactory;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'sala_id', 'start_date', 'end_date'];

    protected static function newFactory()
    {
        return BookingFactory::new();
    }

    public function room(){
        return $this->belongsTo(Sala::class);
    }

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
