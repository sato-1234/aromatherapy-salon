<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\ReservationMenu;

abstract class ReservationService
{
	protected ReservationMenu $reservationMenuRepository;
	protected const CATEGORY = [
		'ボディトリートメント',
		'フェイシャル',
		'その他メニュー（リラク）',
		'足裏・リフレクソロジー',
		'ヘッド',
		'ボディケア'
	];

	public function __construct(ReservationMenu $reservationMenuRepository)
	{
		$this->reservationMenuRepository = $reservationMenuRepository;
	}

	/**
	 * カテゴリ名を取得する
	 * @return array
	 */
	public function getCategory(): array
	{
		return self::CATEGORY;
	}

	/**
	 * 単体id存在確認
	 * @return bool
	 */
	public function checkId(int $id): bool
	{
		return $this->reservationMenuRepository->where('id', $id)->exists();
	}

	/**
	 * 複数id存在確認
	 * @return bool
	 */
	public function checkIds(array $ids): bool
	{
		$ids = array_map('intval', $ids);
		return $this->reservationMenuRepository->whereIn('id', $ids)->exists();
	}

}
