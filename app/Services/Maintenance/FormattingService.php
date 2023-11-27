<?php

namespace App\Services\Maintenance;

class FormattingService
{
    public static function formatCode($code, $prefix = false, $totalNo = 2)
    {
        $formattedCode = strtoupper(trim($code));

        if ($prefix) {
            $formattedCode = str_pad($formattedCode, $totalNo, '0', STR_PAD_LEFT);
        }

        return $formattedCode;
    }

    public static function formatDescription($description, $range = false)
    {
        $formattedDescription = trim(preg_replace('/\s+/', ' ', strtoupper($description)));

        if ($range) {
            $formattedDescription = str_replace(" ", "", $formattedDescription);
            $formattedDescription = str_replace("-", " - ", $formattedDescription);
        }

        return $formattedDescription;
    }
}