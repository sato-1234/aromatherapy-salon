<?php
declare(strict_types=1);
namespace App\Services\Reservation;

use App\Models\ReservationHistory;

final class ReservationUserPostService extends ReservationService{

	/**
	 * 指定ID配列でメニュータイトルを取得する
	 * @return array
	 */
	public function getIdsMenu(array $ids): array
	{
		$ids = array_map('intval', $ids);
		return $this->reservationMenuRepository
			->select('title')
			->whereIn('id', $ids)
			->get()->toArray();
	}

	/**
	 * オーダーMENUとお客様情報保存
	 * @return bool
	 */
	public function storeHistory($content): void
	{
		$post = new ReservationHistory;

		$post->reservation_ids = implode(',', $content['orderMenus']);
		$post->hope_date = $content['date'];
		$post->hope_time = $content['time'];
		$post->total_time_required = $content['totalTime'];
		$post->total_price = $content['totalPrice'];

		//$post->person = $content['person');
		$post->name = $content['name'];
		$post->hurigana = $content['hurigana'];
		$post->tel = $content['tel'];
		$post->email = $content['email'];
		$post->body = $content['body'];

		$post->save();
	}

}
