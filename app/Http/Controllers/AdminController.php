<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\CampaignRequest;
use App\Http\Requests\Admin\BasicRequest;
use App\Http\Requests\Admin\PhotoRequest;

use App\Services\CommonService;
use App\Services\Admin\TopService;
use App\Services\Admin\Reservation\OrderUpdateService;
use App\Services\Admin\Reservation\EditService;
use App\Services\Admin\Reservation\StoreService;
use App\Services\Admin\Reservation\DestroyMenuService;
use App\Services\Admin\Reservation\PhotoListService;
use App\Services\Admin\Reservation\UploadPhotoService;
use App\Services\Admin\Reservation\DestroyPhotoService;

class AdminController extends Controller
{
	/**
	 * 管理画面TOP「/admin」
	 * @return View
	 */
	public function top(TopService $menus): View
	{
		$firstMeuns = $menus->getFirstMenu();
		$reMenus = $menus->getReMenu();
		$basicMenus = $menus->getBasicMenu();
		$categoryNames = $menus->getCategory();
		$categoryBasicMenus = CommonService::conversion($basicMenus,$categoryNames);

		return view('admin.top',compact('firstMeuns','reMenus','categoryBasicMenus'));
	}

	/**
	 * 管理画面TOPからのPOST「/admin/order-update」
	 * 順番更新設定(公開予約ページも自動反映)
	 * @return RedirectResponse
	 */
	public function orderUpdate(Request $request, OrderUpdateService $menus): RedirectResponse
	{
		$request->validate([
			'order_update' => 'required|string',
			'up' => 'required|string|in:順番更新',
		]);
		if( !preg_match('/\A[0-9\,]+/u',$request->input('order_update')) ){
			return redirect()->route('admin.top');
		}

		$orderIds = explode(',', $request->input('order_update'));
		$orderIds = array_diff($orderIds, array('',0,null));//不正空値対応
		$boolOrderId = $menus->checkIds($orderIds);

		if($boolOrderId){
			try {

				\DB::beginTransaction();
				$menus->storeOrder($orderIds);
				\DB::commit();

			} catch (\Throwable $e) {

				\DB::rollback();
				\Log::channel('reservation_menus')->debug('DB順番更新失敗（MENU）：' . $e->getMessage());
				return redirect()->route('admin.top')
					->withErrors(['db_error' => '大変申し訳ありません。システムエラーで順番更新に失敗しました。']);
			}

		}

		return redirect()->route('admin.top');
	}

	/**
	 * キャンペーンメニュー作成ページ「/admin/create-campaign」
	 * @return View
	 */
	public function createCampaign(PhotoListService $photos): View
	{
		$imgs = $photos->getImgs();
		return view('admin.create_campaign', compact('imgs'));
	}

	/**
	 * キャンペーンメニュー編集ページ「/admin/edit-campaign/{id}」
	 * @return View|RedirectResponse
	 */
	public function editCampaign(int $id, PhotoListService $photos, EditService $menus)
	{
		if( $menus->checkId($id) ){
			$imgs = $photos->getImgs();
			$editMenu = $menus->getEditMenu($id,'campaign');
			$editMenu['category'] = explode(',',$editMenu['category']);
			return view('admin.edit_campaign',compact('imgs','editMenu'));
		}

		return redirect()->route('admin.top');
	}

	/**
	 * キャンペーンメニュー作成ページからのPOST(保存)
	 * @return RedirectResponse
	 */
	public function storeCampaign(CampaignRequest $request, StoreService $menus): RedirectResponse
	{
		if( max(array_count_values($request->input('category'))) !== 1){
			redirect()->route('admin.createCampaign')
				->withErrors(['category.*' => '不正重複です'])
				->withInput();
		}

		$content = $this->storeCampaignSet($request);

		// 保存対応
		try {

			\DB::beginTransaction();
			$menus->storeMenu($content,null);
			\DB::commit();

		} catch (\Throwable $e) {

			\DB::rollback();
			\Log::channel('reservation_menus')->debug('DB保存失敗(キャンペーン)：' . $e->getMessage());
			return redirect()->route('admin.createCampaign')
				->withErrors(['db_error' => '大変申し訳ありません。システムエラーで保存に失敗しました。再度入力が必要です。'])
				->withInput();
		}

		return redirect()->route('admin.top');
	}

	/**
	 * キャンペーンメニュー編集ページからのPOST(更新)
	 * @return RedirectResponse
	 */
	public function updateCampaign(int $id, CampaignRequest $request, StoreService $menus): RedirectResponse
	{
		if( $menus->checkId($id) ){

			if( max(array_count_values($request->input('category'))) !== 1){
				return redirect()
					->route('admin.editCampaign',['id' => $id])
					->withErrors(['category.*' => '不正重複です']);
			}

			$content = $this->storeCampaignSet($request);

			// 保存対応
			try {

				\DB::beginTransaction();
				$menus->storeMenu($content,$id);
				\DB::commit();

			} catch (\Throwable $e) {

				\DB::rollback();
				\Log::channel('reservation_menus')->debug('DB更新失敗(キャンペーン)：' . $e->getMessage());
				return redirect()->route('admin.editCampaign',['id' => $id])
					->withErrors(['db_error' => '大変申し訳ありません。システムエラーで更新に失敗しました。再度入力が必要です。']);
			}
		}

		return redirect()->route('admin.top');
	}

	/**
	 * 通常メニュー作成ページ「/admin/create-basic」
	 * @return View
	 */
	public function createBasic(): View
	{
		return view('admin.create_basic');
	}

	/**
	 * 通常メニュー編集ページ「/admin/edit-basic/{id}」
	 * @return View|RedirectResponse
	 */
	public function editBasic(int $id, EditService $menus)
	{
		if( $menus->checkId($id) ){
			$editMenu = $menus->getEditMenu($id,'basic');
			return view('admin.edit_basic',compact('editMenu'));
		}

		return redirect()->route('admin.top');
	}

	/**
	 * 通常メニュー作成ページからのPOST(保存)
	 * @return RedirectResponse
	 */
	public function storeBasic(BasicRequest $request, StoreService $menus): RedirectResponse
	{
		$content = $this->storeBasicSet($request);

		// 保存対応
		try {

			\DB::beginTransaction();
			$menus->storeMenu($content,null);
			\DB::commit();

		} catch (\Throwable $e) {

			\DB::rollback();
			\Log::channel('reservation_menus')->debug('DB保存失敗（通常）：' . $e->getMessage());
			return redirect()->route('admin.createBasic')
				->withErrors(['db_error' => '大変申し訳ありません。システムエラーで保存に失敗しました。再度入力が必要です。'])
				->withInput();
		}

		return redirect()->route('admin.top');
	}

	/**
	 * 通常メニュー編集ページからのPOST(更新)
	 * @return RedirectResponse
	 */
	public function updateBasic(int $id, BasicRequest $request, StoreService $menus): RedirectResponse
	{
		if( $menus->checkId($id) ){

			$content = $this->storeBasicSet($request);

			// 保存対応
			try {

				\DB::beginTransaction();
				$menus->storeMenu($content,$id);
				\DB::commit();

			} catch (\Throwable $e) {

				\DB::rollback();
				\Log::channel('reservation_menus')->debug('DB更新失敗（通常）：' . $e->getMessage());
				return redirect()->route('admin.editBasic',['id' => $id])
					->withErrors(['db_error' => '大変申し訳ありません。システムエラーで更新に失敗しました。再度入力が必要です。']);
			}
		}

		return redirect()->route('admin.top');
	}

	/**
	 * 管理ページからPOST「メニュー削除(キャンペーンまたは通常)」
	 * @return RedirectResponse
	 */
	public function destroy(int $id, DestroyMenuService $menus): RedirectResponse
	{
		// ID存在確認
		if( $menus->checkId($id) ){

			try {

				\DB::beginTransaction();
				$menus->destroy($id,$menus->getCouponImg($id));
				\DB::commit();

				return redirect()->route('admin.top')->with(['success'=> '削除完了しました']);

			} catch (\Throwable $e) {

				\DB::rollback();
				\Log::channel('photos')->debug('DB削除失敗（MENU）：' . $e->getMessage());
				return redirect()->route('admin.top')
					->withErrors(['db_error' => '大変申し訳ありません。システムエラーで削除に失敗しました。']);
			}
		}

		return redirect()->route('admin.top');
	}

	/**
	 * 画像管理ページ(画像保存ページ)「/admin/photo」
	 * @return View
	 */
	public function createPhoto(PhotoListService $photos): View
	{
		$imgs = $photos->getImgs();
		return view('admin.photo', compact('imgs'));
	}

	/**
	 * 画像管理ページからPOST「画像アップロード」
	 * @return RedirectResponse
	 */
	public function uploadPhoto(PhotoRequest $request, UploadPhotoService $photos): RedirectResponse
	{
		// 保存対応
		try {

			\DB::beginTransaction();
			$photos->storePhoto($request->file('photo'));
			\DB::commit();

		} catch (\Throwable $e) {

			\DB::rollback();
			\Log::channel('photos')->debug('DB保存失敗（画像）：' . $e->getMessage());
			return redirect()->route('admin.createPhoto')
				->withErrors(['db_error' => '大変申し訳ありません。システムエラーで保存に失敗しました。再度入力が必要です。'])
				->withInput();
		}

		return redirect()->route('admin.createPhoto')->with(['success'=> '保存完了しました']);
	}

	/**
	 * 画像管理ページからPOST「画像削除」
	 * @return RedirectResponse
	 */
	public function destroyPhoto(Request $request,DestroyPhotoService $photos): RedirectResponse
	{
		// バリデーション
		$request->validate([
			'photo_destroy' => 'required|string|max:255',
		]);

		// ID存在確認
		$url = $request->photo_destroy;
		$id = $photos->checkUrl($url);

		if( isset($id) ){

			try {

				\DB::beginTransaction();
				$photos->destroy($id,$url);
				$path = storage_path() . '/app/public/img/reservation_set/' . $url;
				\File::delete($path);
				\DB::commit();

			} catch (\Throwable $e) {

				\DB::rollback();
				\Log::channel('photos')->debug('DB削除失敗（画像）：' . $e->getMessage());
				return redirect()->route('admin.createPhoto')
					->withErrors(['db_error' => '大変申し訳ありません。システムエラーで削除に失敗しました。']);
			}
		}

		return redirect()->route('admin.createPhoto')->with(['success'=> '削除完了しました']);
	}


	// -------- 以下プライベート関数 -------- //
	/**
	 * キャンペーン用配列作成
	 */
	private function storeCampaignSet(CampaignRequest $request): array
	{
		$img = $request->input('img');
		if( is_null($img) || empty($img) ){
			$img = 'no_image.png';
		}
		$orderNum = $request->input('order_num');
		if( is_null($orderNum) || empty($orderNum) ){
			$orderNum = 9999;
		}

		return [
			'type' => (int) $request->input('type'),
			'coupon' => 1,
			'img' => $img,
			'title' => $request->input('title'),
			'category' => implode(',', $request->input('category')),
			'category_menu' => config('add.menu.list')[0],
			'price' => (int) $request->input('price'),
			'time_required' => (int) $request->input('time_required'),
			'body' => $request->input('body'),
			'expiration_date' => $request->input('expiration_date'),
			'order_num' => (int) $orderNum
		];
	}

	/**
	 * basic用配列作成
	 */
	private function storeBasicSet(BasicRequest $request): array
	{
		$orderNum = $request->input('order_num');
		if( is_null($orderNum) || empty($orderNum) ){
			$orderNum = 9999;
		}

		return [
			'type' => 1,
			'coupon' => 0,
			'img' => null,
			'title' => $request->input('title'),
			'category' => $request->input('category'),
			'category_menu' => $request->input('category_menu'),
			'price' => (int) $request->input('price'),
			'time_required' => (int) $request->input('time_required'),
			'body' => $request->input('body'),
			'expiration_date' => $request->input('expiration_date'),
			'order_num' => (int) $orderNum
		];
	}
}
