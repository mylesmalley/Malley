<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidVinRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function transliterate(string $c)
    {
        return strpos('0123456789.ABCDEFGH..JKLMN.P.R..STUVWXYZ', $c) % 10;
    }

    private function getCheckDigit(string $vin)
    {
        $map = '0123456789X';
        $weights = '8765432X098765432';
        $sum = 0;
        for ($i = 0; $i < 17; $i++) {
            $sum += ($this->transliterate($vin[$i]) * stripos($map, $weights[$i]));
        }
        $key = $sum % 11;

        return $map[$key];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (strlen($value) !== 17) {
            return false;
        }

        return $this->getCheckDigit($value) === substr($value, 8, 1);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not a valid VIN.';
    }
}
