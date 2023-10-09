<?php

namespace Deligoez\TCKimlikNo\Rules;

use Deligoez\TCKimlikNo\TCKimlikNo;
use Illuminate\Contracts\Validation\Rule;

class TCKimlikNoValidate implements Rule
{
    public function __construct(
        protected string $name,
        protected string $surname,
        protected int|string $birthYear,
        protected bool $autoUppercase = true,
        protected null|int|string $birthMonth = null,
        protected null|int|string $birthDay = null,
        protected bool $forcePublicApi = false,
    ) {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     *
     * @throws \SoapFault
     */
    public function passes($attribute, $value): bool
    {
        return TCKimlikNo::validate(
            $value,
            $this->name,
            $this->surname,
            $this->birthYear,
            $this->autoUppercase,
            $this->birthMonth,
            $this->birthDay,
            $this->forcePublicApi
        );
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
