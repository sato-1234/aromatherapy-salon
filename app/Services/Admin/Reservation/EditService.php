<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\ReservationService;

final class EditService extends ReservationService
{
	/**
	 * 指定メニューを取得する
	 * @return array|null
	 */
	public function getEditMenu(int $id,string $type): ?array
	{
		if( $type === 'campaign' ){
			$select = ['id','type','img','title','category','time_required','price','expiration_date','body','order_num'];
		}
		if( $type === 'basic' ){
			$select = ['id','title','category','category_menu','time_required','price','body','order_num'];
		}

		$editMenu = $this->reservationMenuRepository
			->select($select)
			->where('id', $id)
			->first()->toArray();

		return empty($editMenu) ? null : $editMenu;
	}

}
