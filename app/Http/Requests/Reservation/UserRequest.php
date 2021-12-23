<?php
declare(strict_types=1);
namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CustomControlValidation;
use App\Rules\CustomControlIndentionValidation;

class UserRequest extends FormRequest
{
	private const SK = ['id','ids','date','time'];
	private const ROUTE = 'reservation.userView';

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => ['required','string','max:100',new CustomControlValidation],
			'hurigana' => 'required|string|regex:/^[ぁ-んァ-ヴー 　]+$/u|max:100',
			'tel' => 'required|numeric|digits_between:10,11',
			'email' => 'required|email:strict,dns,spoof|max:255',
			'body' => ['nullable','string',new CustomControlIndentionValidation],
		];
	}

	public function messages() {
		return [
			'name.required' => 'お名前は必須です',
			'name.max'  => 'お名前は100文字以内で入力してください。',
			'hurigana.required' => 'フリガナは必須です',
			'hurigana.max'  => 'フリガナは100文字以内で入力してください。',
			'hurigana.regex'  => 'フリガナ形式で入力してください。',
			'tel.required' => '電話番号は必須です。',
			'tel.numeric' => '半角数字とハイフンのみ使用可能です。',
			'tel.digits_between' => '数字は10文字または11文字で入力してください',
			'email.required' => 'メールは必須です',
			'email.email' => 'メール形式で入力してください',
			'email.max'  => 'メールは255文字以内になります。',
		];
	}

	/**
	 * バリデーション「tel」のハイフンを除く処理
	 */
	protected function prepareForValidation(): void
	{
		if(isset($this->tel)){
			$tel = htmlspecialchars($this->tel, ENT_QUOTES, 'UTF-8');
			$tel = str_replace('-', '', $tel);
			$this->merge([
				'tel' => $tel
			]);
		}
	}

	protected function getRedirectUrl()
	{
		$url = $this->redirector->getUrlGenerator();

		if( $this->confirmSession(self::SK) ){
			foreach( self::SK as $name){
				session()->flash($name, session($name));
			}
		}
		return $url->route(self::ROUTE);
	}

	private function confirmSession(array $names): bool
	{
		foreach( $names as $name){
			if ( is_null(session($name)) ){
				return false;
			}
		}
		return true;
	}

}
