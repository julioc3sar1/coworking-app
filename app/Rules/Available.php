<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Booking;

class Available implements ValidationRule, DataAwareRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $data = [];
    
    public function setData(array $data): static
    {
        $this->data = $data;
        return $this;
    }
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $booking = Booking::where('room_id', $value)->where('start_date', $this->data['start_date'])->first();
        if ($booking) {
            $fail('La sala no esta disponible en la hora seleccionada.');
        }
    }
}
