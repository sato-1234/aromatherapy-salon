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
			$photo = Photo::select('id','type')
				->where('url', $content['img'])
				->first()->toArray();

			$type = $content['type'] === 0 ? '新規' : '全員';
			$post = Photo::find($photo['id']);

			if( is_null($photo['type']) ){
				$post->type = $type;
			}
			elseif( $photo['type'] !== $type ){
				$post->type = '新規,全員';
			}
			$post->save();
		}
	}

}
