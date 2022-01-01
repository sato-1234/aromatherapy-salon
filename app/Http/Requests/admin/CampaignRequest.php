<?php
declare(strict_types=1);
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\admin\CustomPhotoValidation;

class CampaignRequest extends FormRequest
{
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
			'type' => 'required|numeric|digits:1',
			'img' => ['nullable','string','max:255',new CustomPhotoValidation],//画像確認
			'title' => 'required|string|max:60',
			'category.0' => 'required|string|in:' . implode(',', config('add.category.list')),
			'category.1' => 'nullable|string|in:' . implode(',', config('add.category.list')),
			'category.2' => 'nullable|string|in:' . implode(',', config('add.category.list')),
			'category.3' => ['nullable',
				function ($attribute, $value, $fail) {
					if ( isset($value) ) {
						return $fail('カテゴリーは3つ以内で設定してください');
					}
				}
			],
			'price' => 'required|numeric|digits_between:1,10',
			'time_required' => 'required|numeric|digits_between:1,3',
			'expiration_date' => 'required|date|date_format:Y-m-d|after:yesterday',
			'body' => 'nullable|string|max:92',
			'order_num' => 'nullable|integer|between:1,9999',//整数と0付きなし、1〜9999の数値
		];
	}

	public function messages() {
		return [
			'type.required' => '新規か全員の選択必須です。',
			'img.max'  => '画像名は255文字以内で入力。',
			'title.required'  => 'タイトルは必須です。',
			'title.max'  => 'タイトルは60文字以内で入力。',
			'category.0.required'  => 'カテゴリは1つ以上選択必須です。',
			'category.0.in'  => '指定値で入力。',
			'category.1.in'  => '指定値で入力。',
			'category.2.in'  => '指定値で入力。',
			'price.required'  => '料金は必須です。',
			'price.digits_between'  => '料金は10桁以内で入力。',
			'time_required.required'  => '所要時間は必須です。',
			'time_required.digits_between'  => '所要時間は3桁以内で入力。',
			'expiration_date.required'  => '有効期限は必須です。',
			'expiration_date.date_format'  => '有効期限は2XXX-XX-XX形式で入力。',
			'expiration_date.after'  => '今日以降で入力してください',
			'body.max'  => '説明は92文字以内で入力。',
			'order_num.between'  => '表示順番は1〜9999の半角整数で入力。',
		];
	}

}
