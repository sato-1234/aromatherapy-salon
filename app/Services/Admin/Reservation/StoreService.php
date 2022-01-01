<?php
declare(strict_types=1);
namespace App\Services\Admin\Reservation;

use App\Services\ReservationService;
use App\Models\Photo;

final class StoreService extends ReservationService
{
	/**
	 * 予約MENU情報保存または更新
	 * 画像URLに一致する画像IDの「type」を設定する
	 * @return void
	 */
	public function storeMenu(array $content, ?int $id): void
	{
		// 更新または新規保存
		if(isset($id)){
			$post = $this->reservationMenuRepository::find($id);
		} else {
			$post = $this->reservationMenuRepository;
		}

		$post->type = $content['type'];
		$post->coupon = $content['coupon'];
		$post->img = $content['img'];
		$post->title = $content['title'];
		$post->category = $content['category'];
		$post->category_menu = $content['category_menu'];
		$post->price = $content['price'];
		$post->time_required = $content['time_required'];
		$post->body = $content['body'];
		$post->expiration_date = $content['expiration_date'];
		$post->order_num = $content['order_num'];
		$post->save();

		// キャンペーンかつデフォルト画像以外
		if( $content['coupon'] === 1 && $content['img'] !== 'no_image.png'){

			// 初キャンペーンカウント
			$firstCount = $this->reservationMenuRepository
				->where('img',$content['img'])
				->where('type',0)
				->where('coupon',1)
				->count();

			// 全員キャンペーンカウント
			$reCount = $this->reservationMenuRepository
				->where('img',$content['img'])
				->where('type',1)
				->where('coupon',1)
				->count();

			if($firstCount === 0 && $reCount === 0){
				Photo::where('url',$content['img'])->update(['type' => null]);
			}
			if($firstCount >= 1 && $reCount === 0){
				Photo::where('url',$content['img'])->update(['type' => '新規']);
			}
			if($firstCount === 0 && $reCount >= 1){
				Photo::where('url',$content['img'])->update(['type' => '全員']);
			}
			if($firstCount >= 1 && $reCount >= 1){
				Photo::where('url',$content['img'])->update(['type' => '新規,全員']);
			}
		}

	}

}
