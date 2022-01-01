<?php
declare(strict_types=1);
namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;

class CustomPhotoUploadValidation implements Rule
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
		//ファイル名を取得
		$filenameWithExt = $value->getClientOriginalName();

		//ファイル名バリデ
		$validFlag =
			preg_match('/\A[a-zA-Z0-9\-\_]{1,}\.(jpeg|jpg|png|gif|)\z/u',$filenameWithExt) &&
			mb_substr_count($filenameWithExt, '.') &&
			mb_strlen($filenameWithExt) <= 235 &&
			mb_strlen($filenameWithExt) >= 5;

		if($validFlag){
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
		return '「画像名は拡張子合わせて5〜235文字」かつ「半角英数字とハイフンとアンダーバー」かつ「拡張子は[jpeg|jpg|png|gif]」が使用可能です。」)';
	}
}
