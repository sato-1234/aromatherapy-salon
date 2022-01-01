<?php
declare(strict_types=1);
namespace App\Services\Reservation;

use App\Services\ReservationService;

final class ReservationChoiceViewService extends ReservationService{

	/**
	 * ID確認
	 * @return bool
	 */
	public function checkId(int $id): bool
	{
		return $this->reservationMenuRepository->where('id', $id)->exists();
	}

	/**
	 * 指定IDをメニューを取得する
	 * @return array
	 */
	public function getIdMenu(int $id): ?array
	{
		$choiceMenu = $this->reservationMenuRepository
			->select('id', 'title', 'price', 'time_required')
			->where('id', $id)
			->first()
			->toArray();

		return empty($choiceMenu) ? null : $choiceMenu;
	}

	/**
	 * 指定IDを除き規定メニューを取得する
	 * @return array
	 */
	public function getBasicMenu(int $id): ?array
	{
		$_ = function($s){return $s;};//変数展開用
		$basicMenus = $this->reservationMenuRepository
			->select('id', 'category', 'title', 'body', 'time_required', 'price')
			->where('type', 1)
			->where('coupon', 0)
			->where('id', '<>', $id)
			->orderByRaw("CASE
				WHEN category = '{$_(self::CATEGORY[0])}' THEN 1
				WHEN category = '{$_(self::CATEGORY[1])}' THEN 2
				WHEN category = '{$_(self::CATEGORY[2])}' THEN 3
				WHEN category = '{$_(self::CATEGORY[3])}' THEN 4
				WHEN category = '{$_(self::CATEGORY[4])}' THEN 5
				WHEN category = '{$_(self::CATEGORY[5])}' THEN 6
				ELSE 9999
				END"
			)
			->orderBy('order_num', 'asc')
			->orderBy('id', 'asc')
			->get()->toArray();

		return empty($basicMenus) ? null : $basicMenus;
	}

}
