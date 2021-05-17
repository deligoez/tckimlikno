<?php

namespace Deligoez\TCKimlikNo\Rules;

use Deligoez\TCKimlikNo\TCKimlikNo;
use Illuminate\Contracts\Validation\Rule;

class TCKimlikNoValidate implements Rule
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $surname;

    /** @var string */
    protected $birthYear;

    /** @var bool */
    protected $autoUppercase;

    public function __construct(
        string $name,
        string $surname,
        string $birthYear,
        bool $autoUppercase = true
    ) {
        $this->name = $name;
        $this->surname = $surname;
        $this->birthYear = $birthYear;
        $this->autoUppercase = $autoUppercase;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     * @throws \SoapFault
     */
    public function passes($attribute, $value): bool
    {
        return TCKimlikNo::validate(
            $value,
            $this->name,
            $this->surname,
            $this->birthYear,
            $this->autoUppercase
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
