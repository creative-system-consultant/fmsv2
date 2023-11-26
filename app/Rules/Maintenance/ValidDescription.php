<?php

namespace App\Rules\Maintenance;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDescription implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[A-Za-z ]+(\([A-Za-z]+\))?$/u', $value)) {
            $fail('The ' . $attribute . ' is not in a valid format.');
        }
    }
}
