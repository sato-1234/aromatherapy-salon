<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\ReservationService;

final class OrderUpdateService extends ReservationService
{
	/**
	 * オーダーMENUと表示を変更保存
	 * @return void
	 */
	public function storeOrder(array $orderIds): void
	{
		$i = 0;
		foreach($orderIds as $id){
			$i++;
			$post = $this->reservationMenuRepository->find(intval($id));
			$post->order_num = $i;
			$post->save();
		}
		$post->save();
	}
}
