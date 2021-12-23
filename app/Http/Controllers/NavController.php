<?php
declare(strict_types=1);
namespace App\Http\Controllers;

class NavController extends Controller
{
	private const RE = [
		'menu',
		'reservation',
		'login',
	];

	private const TITLE = [
		'top' => [
			'自然療法で本来の自分らしさを取り戻す',
			'Natural Remedies',
		],
		'about' => [
			'当店について',
			'ABOUT',
		],
		'news' => [
			'お知らせ',
			'NEWS',
		],
		'netshop' => [
			'ネットショップ',
			'NET SHOP',
		],
		'recruit' => [
			'採用情報',
			'RECRUIT',
		],
		'access' => [
			'アクセス',
			'ACCESS',
		],
		'therapist' => [
			'セラピスト',
			'THERAPIST',
		],
		'privacy' => [
			'プライバシーポリシー',
			'PRIVACY',
		],
	];

	/**
	 * 静的ページ「/」
	 */
	public function show(?string $url = null)
	{
		if( is_null($url) ){
			$title = self::TITLE['top'];
			return view('nav.show',compact('title','url'));
		}

		if( in_array($url,self::RE,true) ){
			return redirect()->route($url . '.show');
		}

		$title = self::TITLE[$url];
		return view('nav.show',compact('title','url'));
	}
}
