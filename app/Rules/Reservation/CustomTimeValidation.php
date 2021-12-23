<?php
declare(strict_types=1);
namespace App\Rules\Reservation;

use Illuminate\Contracts\Validation\Rule;

class CustomTimeValidation implements Rule
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
		$t = explode(':', $value);
		$h = (int)$t[0];
		$i = (int)$t[1];
		return in_array($h,range(16, 22),true) || ($h === 23 && $i === 0);
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return '16:00 ~ 23:00時内で指定してください。';
	}
}
