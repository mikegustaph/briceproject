<?php

namespace App\Helpers;

class DetermineProviderHelper
{
    public static function providerName(string $phone): ?string
    {
        // Remove spaces, dashes
        $cleaned = preg_replace('/[^0-9]/', '', $phone);
        // Normalize to start with 255
        if (str_starts_with($cleaned, '0')) {
            $cleaned = '255' . substr($cleaned, 1);
        } elseif (str_starts_with($cleaned, '+')) {
            $cleaned = ltrim($cleaned, '+');
        }
        // Ensure length is valid
        if (strlen($cleaned) < 9) return null;
        // Extract prefix (first 3 digits after 255)
        $prefix = substr($cleaned, 3, 3);
        return match ($prefix) {
            '610', '611', '612', '613', '614', '615', '616', '617', '618', '619' => 'Airtel',
            '650', '651', '652', '653'                                           => 'Tigo',
            '655', '656', '657'                                                  => 'Halotel',
            '658', '659'                                                         => 'Zantel',
            '754', '755', '756', '757', '758', '759', '710', '711', '712'       => 'Vodacom',
            default => null
        };
    }
}
