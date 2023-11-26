<?php

namespace App\Services\Maintenance;

class FormattingService
{
    public static function formatCode($code)
    {
        $formattedCode = strtoupper(trim($code));

        if (strlen($formattedCode) === 0) {
            $formattedCode = '00'; // Handle the case where the string is empty after trimming
        } elseif (strlen($formattedCode) === 1) {
            $formattedCode = '0' . $formattedCode; // Prepend '0' if the string is one character long
        }

        return $formattedCode;
    }

    public static function formatDescription($description)
    {
        return trim(preg_replace('/\s+/', ' ', strtoupper($description)));
    }
}