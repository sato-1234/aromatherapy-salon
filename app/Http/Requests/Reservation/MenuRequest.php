<?php
declare(strict_types=1);
namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Reservation\CustomTimeValidation;

class MenuRequest extends FormRequest
{
	private const SK = ['id','ids','date','time'];
	private const ROUTE = 'reservation.choiceView';

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
			'ids.*' => ['numeric'],
			'date' => ['required','date','date_format:"Y-m-d"','after:today'],
			'time' => ['required','date_format:"H:i"',new CustomTimeValidation],
		];
	}

	public function messages() {
		return [
			'ids.numeric' => '不正アクセスです。',
			'date.required'  => '日付は必須項目です。',
			'date.date'  => '日付を指定してください',
			'date.date_format'  => '日付を指定してください',
			'date.after'  => '日付は明日以降で指定してください。',
			'time.required'  => '時間は必須項目です。',
			'time.date_format'  => '時間を指定してください',
		];
	}

	protected function getRedirectUrl()
	{
		$url = $this->redirector->getUrlGenerator();

		if ( session()->has(self::SK[0]) ){

			foreach( self::SK as $name){
				if ( session()->has($name) ){
					session()->flash($name, session($name));
				}
			}

		}

		return $url->route(self::ROUTE);
	}
}
