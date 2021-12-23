<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Reservation\MenuRequest;
use App\Http\Requests\Reservation\UserRequest;
use App\Services\Reservation\ReservationShowService;
use App\Services\Reservation\ReservationChoiceViewService;
use App\Services\Reservation\ReservationAddPostService;
use App\Services\Reservation\ReservationUserViewService;
use App\Services\Reservation\ReservationUserPostService;
use App\Mail\SendReservationMail;
use Mail;

class ReservationController extends Controller
{
	private const DELETE_SESSION = ['id','ids','date','time','totalTime','totalPrice','result'];

	/**
	 * 公開の予約ページ「/reservation」
	 * @return View
	 */
	public function show(ReservationShowService $menus): View
	{
		$this->DeleteSession(self::DELETE_SESSION);

		$firstMeuns = $menus->getFirstMenu();
		$reMenus = $menus->getReMenu();

		$basicMenus = $menus->getBasicMenu();
		$categoryNames = $menus->getCategory();
		$categoryBasicMenus = $this->conversion($basicMenus,$categoryNames);

		return view('reservation.show',compact('firstMeuns','reMenus','categoryBasicMenus'));
	}

	/**
	 * 公開の予約ページからのPOST
	 * @return RedirectResponse
	 */
	public function choicePost(Request $request): RedirectResponse
	{
		$request->validate([
			'id' => 'required|numeric',
			'new' => 'required|string|in:ご予約',
		]);

		$id = $request->input('id');
		return redirect()->route('reservation.choiceView')->with(compact('id'));
	}

	/**
	 * 公開の予約ページ_追加メニュー選択ページ「/reservation/choice」
	 */
	public function choiceView(Request $request, ReservationChoiceViewService $menus)
	{
		//「セッションなしの直接アクセス対応」
		if( !$this->confirmSession(['id']) ){
			return redirect()->route('reservation.show');
		}
		$id = (int) session('id');

		$boolId = $menus->checkId($id);
		if( $boolId ){
			$choiceMenu = $menus->getIdMenu($id);
			$basicMenus = $menus->getBasicMenu($id);
			$categoryNames = $menus->getCategory();
			$categoryBasicMenus = $this->conversion($basicMenus,$categoryNames);

			session()->flash('id', $id);
			//「選択のやり直しoid値対応」
			if( $this->confirmSession(['ids','date','time']) ){
				$this->setSession(['ids','date','time'],'old');
			}
			return view('reservation.choice',compact('choiceMenu','categoryBasicMenus'));
		}
		//不正アクセス
		return redirect()->route('reservation.show');
	}

	/**
	 * 公開の予約ページ_追加メニュー選択ページからのPOST
	 * @return RedirectResponse
	 */
	public function addPost(MenuRequest $request, ReservationAddPostService $menus): RedirectResponse
	{
		//「ブラウザ戻るでのセッションなしの送信対応
		if( !$this->confirmSession(['id']) ){
			return redirect()->route('reservation.show');
		}
		$id = session('id');

		// ID存在確認や結合
		$requestIds = $request->input('ids');
		$boolIds = $requestIds !== null && $menus->checkIds($requestIds);
		$ids = [$id];
		if( $boolIds ){
			$ids = array_merge($ids, $requestIds);
		}

		// 希望時間から残り営業時間で可能か計算
		$time = $request->input('time');
		$usableTime = $menus->getUsableTime($time);//利用可能時間
		$totalTime = $menus->getTotal($ids,'time_required');//必要時間

		// バリデーション判定（必要時間を超えるため戻る）
		if ( ($usableTime - $totalTime) < 0 ) {
			return redirect()->route('reservation.choiceView')
				->withErrors(['time' => '施術時間が営業時間を超えております。'])
				->withInput()->with(compact('id'));
		}

		$date = $request->input('date');
		return redirect()->route('reservation.userView')->with(compact('id','ids','date','time'));
	}

	/**
	 * 公開の予約ページ_ユーザー情報入力一覧ページ「/reservation/user」
	 */
	public function userView(Request $request, ReservationUserViewService $menus)
	{
		//「セッションなしの直接アクセス」
		if( !$this->confirmSession(['id','ids','date','time']) ){
			return redirect()->route('reservation.show');
		}
		list($id,$ids,$date,$time) = [
			session('id'),
			session('ids'),
			session('date'),
			session('time')
		];

		$choiceMenus = $menus->getIdsMenu($ids);
		$totalTime = $menus->getTotal($ids,'time_required');
		$totalPrice = $menus->getTotal($ids,'price');
		$inputView = $menus->getInputView();

		$this->setSession(['id','ids','date','time']);
		$this->setSession(['totalPrice' => $totalPrice,'totalTime' => $totalTime],'key');
		return view('reservation.user',compact(
			'choiceMenus',
			'date',
			'time',
			'totalTime',
			'totalPrice',
			'inputView'
		));
	}

	/**
	 * 公開の予約ページ_ユーザー情報入力一覧ページからのPOST
	 */
	public function userPost(UserRequest $request, ReservationUserPostService $menus): RedirectResponse
	{
		//「セッションなし対応」
		if( !$this->confirmSession(['id','ids','date','time','totalPrice','totalTime']) ){
			return redirect()->route('reservation.show');
		}

		//メール内容作成
		$orderMenus = $menus->getIdsMenu(session('ids'));
		$body = is_null($request->input('body')) ? '' : $request->input('body');
		$content = [
			'orderMenus' => $orderMenus,
			'date' => session('date'),
			'time' => session('time'),
			'totalPrice' => session('totalPrice'),
			'totalTime' => session('totalTime'),
			'name' => $request->input('name'),
			'hurigana' => $request->input('hurigana'),
			'tel' => $request->input('tel'),
			'email' => $request->input('email'),
			'body' => $body
		];

		//管理者側にメール送信、ログ残す
		Mail::to(config('add.mail.mail_to'))->send(new SendReservationMail($content,'admin'));
		$result = $this->mailLog(Mail::failures(),'管理者');

		//クライアント側（入力側）にメール送信、ログ残す
		if( $result ){
			Mail::to([$request->input('email')])->send(new SendReservationMail($content,'client'));
			$resultClient = $this->mailLog(Mail::failures(),'クライアント');

			// データベース保存
			try {
				$content['orderMenus'] = session('ids');
				\DB::beginTransaction();
				$menus->storeHistory($content);
				\DB::commit();
			} catch (\Throwable $e) {
				\DB::rollback();
				\Log::channel('reservation_historys')->debug('DB保存失敗：' . $e->getMessage());
			}
		}

		return redirect()->route('reservation.completeView')->with(compact('result'));
	}

	/**
	 * 公開の予約ページ_送信完了ページ「/reservation/complete」
	 */
	public function completeView()
	{
		//「セッションなし対応」
		if( !$this->confirmSession(['result']) ){
			return redirect()->route('reservation.show');
		}
		$result = session('result');
		$this->DeleteSession(self::DELETE_SESSION);

		return view('reservation.complete',compact('result'));
	}


	// ------------------------------------------------ //
	/**
	 * private用 共通関数(以下)
	 */
	private function DeleteSession(array $names): void
	{
		foreach( $names as $name){
			if (session()->exists($name)) {
				session()->forget($name);
			}
		}
	}

	private function confirmSession(array $names): bool
	{
		foreach( $names as $name){
			if ( is_null(session($name)) ){
				return false;
			}
		}
		return true;
	}

	private function setSession(array $names, string $type = 'flash'): void
	{
		if($type === 'flash'){
			foreach( $names as $name){
				$value = session($name);
				session()->flash($name, $value);
			}
		}

		if($type === 'key'){
			foreach( $names as $key => $value){
				session()->flash($key, $value);
			}
		}

		if($type === 'old'){
			$arrOld = [];
			foreach( $names as $name){
				$arrOld[$name] = session($name);
			}
			session()->flash('_old_input', $arrOld);
		}
	}

	private function conversion(?array $basicMenus,array $categoryNames): ?array
	{
		if(is_null($basicMenus)){
			return null;
		}

		$categoryBasicMenus = [];
		foreach($basicMenus as $post){
			if ( in_array($post['category'],$categoryNames,true) ){
				$categoryBasicMenus[$post['category']][] = $post;
			}
		}
		return $categoryBasicMenus;
	}

	private function mailLog(array $mails,string $type): bool
	{
		if ( empty($mails) ) {
			\Log::channel('mail')->info($type . '送信成功');
			return true;
		}
		\Log::channel('mail')->info($type . '送信失敗：' . implode(",",$mails));
		return false;
	}

}
