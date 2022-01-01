<?php
declare(strict_types=1);
namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class CustomPhotoValidation implements Rule
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
        if ( $value === 'no_image.png' ) {
            return true;
        }

        if ( isset($value) ) {
            // DBとストレージ確認
            $dbBool = Photo::where('url', $value)->exists();
            $fileBool = Storage::disk('local')->exists('public/img/reservation_set/' . $value);
        }

        if($dbBool && $fileBool){
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
        return '指定の画像名が間違えています。(もしくはDBとストレージの先どちらかで保存がされておりません。)';
    }
}
