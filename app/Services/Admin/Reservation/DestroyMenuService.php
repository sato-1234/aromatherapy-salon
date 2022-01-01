<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\ReservationService;
use App\Models\Photo;

final class DestroyMenuService extends ReservationService
{
	/**
	 * 「キャンペーン：1」または「通常：0」
	 * 「キャンペーン：画像名」または「通常：null」
	 * @return array
	 */
	public function getCouponImg(int $id): array
	{
		$couponImg = $this->reservationMenuRepository
			->select('coupon','img')
			->where('id', $id)
			->first()->toArray();

		return $couponImg;
	}

	/**
	 * 指定MENU_IDを削除する
	 * 画像が使用されているキャンペーンMENU画像を「typeを変更」する
	 */
	public function destroy(int $id, array $couponImg): void
	{
		$this->reservationMenuRepository
			->where('id', $id)
			->delete();

		// キャンペーンのみ
		if( $couponImg['coupon'] === 1 ){
			// 初キャンペーンカウント
			$firstCount = $this->reservationMenuRepository
				->where('img',$couponImg['img'])
				->where('type',0)
				->where('coupon',1)
				->count();

			// 全員キャンペーンカウント
			$reCount = $this->reservationMenuRepository
				->where('img',$couponImg['img'])
				->where('type',1)
				->where('coupon',1)
				->count();

			if($firstCount === 0 && $reCount === 0){
				Photo::where('url',$couponImg['img'])->update(['type' => null]);
			}
			if($firstCount >= 1 && $reCount === 0){
				Photo::where('url',$couponImg['img'])->update(['type' => '新規']);
			}
			if($firstCount === 0 && $reCount >= 1){
				Photo::where('url',$couponImg['img'])->update(['type' => '全員']);
			}
			if($firstCount >= 1 && $reCount >= 1){
				Photo::where('url',$couponImg['img'])->update(['type' => '新規,全員']);
			}
		}
	}
}
