<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\Admin\PhotoService;
use App\Models\ReservationMenu;

final class DestroyPhotoService extends PhotoService{

	/**
	 * url存在確認
	 * @return int|null
	 */
	public function checkUrl(string $url): ?int
	{
		$url = $this->photoRepository
			->select('id')
			->where('url', $url)
			->first()->toArray();

		return empty($url) ? null : $url['id'];
	}

	/**
	 * 指定画像IDを削除する
	 * 画像が使用されているキャンペーンMENU画像を「no_image.png」にする
	 */
	public function destroy(int $id, string $url): void
	{
		$this->photoRepository
			->where('id', $id)
			->delete();

		ReservationMenu::where('img',$url)->update(['img' => 'no_image.png']);
	}

}
