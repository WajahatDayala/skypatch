<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Username implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Add your validation logic here
        return preg_match('/^[a-zA-Z0-9._-]+$/', $value); // Example regex for alphanumeric usernames
    }

    public function message()
    {
        return 'The :attribute must be a valid username.';
    }
}
