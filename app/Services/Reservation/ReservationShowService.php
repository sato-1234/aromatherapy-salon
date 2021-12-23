<?php
declare(strict_types=1);
namespace App\Services\Reservation;

final class ReservationShowService extends ReservationService{

	/**
	 * 初回限定メニューを取得する
	 * @return array
	 */
	public function getFirstMenu(): ?array
	{
		$firstMenus = $this->reservationMenuRepository
			->select('id','img','title','category','time_required','price','expiration_date','body')
			->where('type', 0)
			->where('coupon', 1)
			->orderBy('order_num', 'asc')
			->orderBy('id', 'asc')
			->get()->toArray();

		return empty($firstMenus) ? null : $firstMenus;
	}

	/**
	 * 再来限定メニューを取得する
	 * @return array
	 */
	public function getReMenu(): ?array
	{
		$reMenus = $this->reservationMenuRepository
			->select('id','img', 'title', 'category', 'time_required', 'price', 'expiration_date', 'body')
			->where('type', 1)
			->where('coupon', 1)
			->orderBy('order_num', 'asc')
			->orderBy('id', 'asc')
			->get()->toArray();

		return empty($reMenus) ? null : $reMenus;
	}

	/**
	 * 規定メニューを取得する
	 * @return array
	 */
	public function getBasicMenu(): ?array
	{
		$_ = function($s){return $s;};//変数展開用
		$basicMenus = $this->reservationMenuRepository
			->select('id','category','time_required', 'title','body','price')
			->where('type', 1)
			->where('coupon', 0)
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
