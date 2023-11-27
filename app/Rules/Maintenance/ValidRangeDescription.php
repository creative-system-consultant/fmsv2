<?php

namespace App\Rules\Maintenance;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidRangeDescription implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^\s*(\d+)\s*-\s*(\d+)\s*$/', $value)) {
            $fail('The ' . $attribute . ' is not in a valid format.');
        }
    }
}
