<?php

namespace App\Validators;

use App\Core\Validator;

class PasswordValidator implements Validator
{
    private $minLength;
    private $maxLength;

    public function __construct() {
        $this->minLength = 8;
        $this->maxLength = 32;
    }

    public function &setMinLength(int $length) : PasswordValidator
    {
        $this->minLength = max(0, $length);
        return $this;
    }

    public function &setMaxLength(int $length) : PasswordValidator {
        $this->maxLength = max(1, $length);
        return $this;
    }

    public function isValid(string $value): bool
    {
        $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{'.$this->minLength.','.$this->maxLength.'}$/';

        return \boolval(\preg_match($pattern, $value));
    }
}