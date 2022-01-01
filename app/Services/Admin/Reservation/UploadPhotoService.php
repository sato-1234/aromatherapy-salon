<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\Admin\PhotoService;
use Carbon\Carbon;

final class UploadPhotoService extends PhotoService{

	/**
	 * 画像dataをDBとストレージに保存
	 * @return void
	 */
	public function storePhoto(object $photo): void
	{
		//ファイル名を取得
		$filenameWithExt = $photo->getClientOriginalName();

		//拡張子を外したファイル名を取得
		//$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

		//拡張子を取得
		$extension = $photo->getClientOriginalExtension();

		// 時間(ファイル名かぶりを防ぐ) + ファイル名 + 拡張子 というファイル名
		$now = Carbon::now()->format('Y_m_d-H_i_s');
		$filenameToStore = $now . '_' . $filenameWithExt;

		//ストレージ内に画像を保存
		$path = $photo->storeAs('public/img/reservation_set/', $filenameToStore);

		$this->photoRepository->extension = $extension;
		$this->photoRepository->category = 'reservation';
		$this->photoRepository->url = $filenameToStore;
		$this->photoRepository->save();
	}
}
