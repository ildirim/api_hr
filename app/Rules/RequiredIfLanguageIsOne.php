<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RequiredIfLanguageIsOne implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $languageIds = request()->input('translations.*.languageId') ?? [request()->input('languageId')];
        if (!in_array(1, $languageIds)) {
            $fail('The :attribute field is required when language is English.');
        }
    }
}
