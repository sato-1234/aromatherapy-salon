<?php
declare(strict_types=1);
namespace App\Services\Reservation;

use App\Services\ReservationService;

final class ReservationUserViewService extends ReservationService
{
	private const INPUT_VIEW = [
		'お名前' => ['type' => 'text', 'name' => 'name', 'placeholder' => '例）山田太郎'],
		'フリガナ' => ['type' => 'text', 'name' => 'hurigana', 'placeholder' => '例）ヤマダタロウ'],
		'お電話' => ['type' => 'tel', 'name' => 'tel', 'placeholder' => '例）000-0000-0000'],
		'メール' => ['type' => 'email', 'name' => 'email', 'placeholder' => '例）xxxxxx@docomo.ne.jp'],
	];

	/**
	 * 指定ID配列でメニューを取得する
	 * @return array
	 */
	public function getIdsMenu(array $ids): ?array
	{
		$ids = array_map('intval', $ids);
		$choiceMenus = $this->reservationMenuRepository
			->select('id', 'title', 'price', 'time_required')
			->whereIn('id', $ids)
			->get()->toArray();

		return empty($choiceMenus) ? null : $choiceMenus;
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

	/**
	 * View用配列文字を返す。
	 * @return array
	 */
	public function getInputView(): array
	{
		return self::INPUT_VIEW;
	}
}
