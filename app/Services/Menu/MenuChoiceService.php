<?php
declare(strict_types=1);
namespace App\Services\Menu;

use App\Services\Reservation\ReservationService;

final class MenuChoiceService extends ReservationService
{
	/**
	 * 接続URLであるか確認
	 * @return bool
	 */
	public function checkUrl(string $url): bool
	{
		$keys = array_keys(MenuService::MENU);
		return in_array($url,$keys,true);
	}

	/**
	 * URLに応じたメニューを取得する
	 * @return array
	 */
	public function getUrlMenu(string $url): array
	{
		return MenuService::MENU[$url];
	}

	/**
	 * URLに応じた規定メニューを取得する
	 * @return array
	 */
	public function getBasicMenu(string $url): ?array
	{
		$basicPosts = $this->reservationMenuRepository
			->select('id','category','category_menu','time_required', 'title','body','price')
			->where('category_menu', MenuService::MENU[$url][0])
			->where('type', 1)
			->where('coupon', 0)
			->orderBy('order_num', 'asc')
			->orderBy('id', 'asc')
			->get()->toArray();

		return empty($basicPosts) ? null : $basicPosts;
	}

	/**
	 * footer表示情報
	 * @return array
	 */
	public function getFooterMenu(): array
	{
		return MenuService::MENU;
	}

}
