<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\Admin\PhotoService;

final class PhotoListService extends PhotoService{

	/**
	 * キャンペーン用画像URLを取得する
	 * @return array
	 */
	public function getImgs(): ?array
	{
		$imgUrls = $this->photoRepository
			->select('url','type')
			->where('category', 'reservation')
			->orderBy('created_at', 'desc')
			->get()->toArray();

		return empty($imgUrls) ? null : $imgUrls;
	}
}
