<?php
declare(strict_types=1);
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomControlIndentionValidation implements Rule
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
        if (preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $value)) {
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
        return '改行タブ以外の制御文字は使用できません。';
    }
}
