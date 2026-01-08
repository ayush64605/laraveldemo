<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class projectValidation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!str_starts_with($value, 'cbt-')) {
            $fail("The :attribute must start with 'cbt-'.");
        }
    }
}
