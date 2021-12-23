<?php
declare(strict_types=1);
namespace App\Services\Reservation;

final class ReservationAddPostService extends ReservationService{

	private const DAY = 1440;//分
	private const HOUR = 60;

	/**
	 * ID確認
	 * @return bool
	 */
	public function checkIds(array $ids): bool
	{
		$ids = array_map('intval', $ids);
		return $this->reservationMenuRepository->whereIn('id', $ids)->exists();
	}

	/**
	 * 時間（16:00）形式から利用可能時間を計算
	 * @return int
	 */
	public function getUsableTime(string $time): int
	{
		$t = explode(':', $time);
		$h = (int)$t[0];
		$i = (int)$t[1];
		$today = self::DAY;
		return $today - ($h * self::HOUR + $i);
	}

	/**
	 * 指定ID配列を合計を取得する
	 * @return int
	 */
	public function getTotal(array $ids, string $column): int
	{
		$ids = array_map('intval', $ids);
		$total = $this->reservationMenuRepository
			->whereIn('id', $ids)
			->sum($column);

		return is_null($total) ? null : (int) $total;
	}

}
