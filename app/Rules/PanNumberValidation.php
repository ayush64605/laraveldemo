<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PanNumberValidation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = '/^([A-Z]){5}([0-9]){4}([A-Z]){1}$/';

        if (!preg_match($regex, $value)) {
            $fail('The :attribute must be a valid Indian PAN number (e.g., AAAAA1234A).');
        }

        $fourthChar = strtoupper($value[3] ?? '');
        $validFourthChars = ['P', 'C', 'H', 'F', 'A', 'T', 'B', 'L', 'J', 'G'];
        if (!in_array($fourthChar, $validFourthChars)) {
            $fail('The :attribute has an invalid 4th character for entity type.');
        }
    }
}   
