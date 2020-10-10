<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return (\Laravel\Fortify\Rules\Password|string)[]
     *
     * @psalm-return array{0: string, 1: string, 2: \Laravel\Fortify\Rules\Password, 3: string}
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
}
