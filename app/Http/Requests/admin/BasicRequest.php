<?php
declare(strict_types=1);
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BasicRequest extends FormRequest
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
			'title' => 'required|string|max:60',
			'category' => 'required|string|in:' . implode(',', config('add.category.list')),
			'category_menu' => 'required|string|in:' . implode(',', config('add.menu.list')),
			'price' => 'required|numeric|digits_between:1,10',
			'time_required' => 'required|numeric|digits_between:1,3',
			'body' => 'nullable|string|max:92',
			'order_num' => 'nullable|integer|between:1,9999',
		];
	}

	public function messages() {
		return [
			'title.required'  => 'タイトルは必須です。',
			'title.max'  => 'タイトルは60文字以内で入力。',
			'category.required'  => 'カテゴリの選択必須です。',
			'category.in'  => '指定値で入力。',
			'category_menu.required'  => 'メニューカテゴリの選択必須です。',
			'category_menu.in'  => '指定値で入力。',
			'price.required'  => '料金は必須です。',
			'price.digits_between'  => '料金は10桁以内で入力。',
			'time_required.required'  => '所要時間は必須です。',
			'time_required.digits_between'  => '所要時間は3桁以内で入力。',
			'body.max'  => '説明は92文字以内で入力。',
			'order_num.between'  => '表示順番は1〜9999の半角整数で入力。',
		];
	}

}
