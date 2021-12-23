<?php
declare(strict_types=1);
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomControlValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (preg_match('/\A[[:^cntrl:]]*\z/', $value)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '制御文字は使用できません。';
    }
}
