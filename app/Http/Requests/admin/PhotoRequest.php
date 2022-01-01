<?php
declare(strict_types=1);
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\admin\CustomPhotoUploadValidation;

class PhotoRequest extends FormRequest
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
		// mimetypes:image/jpeg,image/png,image/gif|mimes:jpeg,png,jpg,gifは保留
		return [
			'photo' => ['required','max:1024','file','image',new CustomPhotoUploadValidation]
		];
	}

	public function messages() {
		return [
			'photo.required' => '画像を設定してください',
			'photo.max' => '画像サイズは1MB以内にしてください',
			'photo.image' => '画像ファイルを指定してください',
		];
	}

}
