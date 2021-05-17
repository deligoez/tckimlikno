<?php

namespace Deligoez\TCKimlikNo\Rules;

use Deligoez\TCKimlikNo\TCKimlikNo;
use Illuminate\Contracts\Validation\Rule;

class TCKimlikNoVerify implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return TCKimlikNo::verify($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('tckimlikno::messages.tckn');
    }
}
