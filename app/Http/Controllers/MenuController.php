<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Exceptions\NotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Menu\MenuShowService;
use App\Services\Menu\MenuChoiceService;

class MenuController extends Controller
{
	/**
	 * 公開のMENUページ「/menu」
	 * @return View
	 */
	public function show(MenuShowService $menus): View
	{
		$categoryList = $menus->getCategoryList();
		return view('menu.show', compact('categoryList'));
	}

	/**
	 * 公開の各MENUページ「/menu/get値」
	 * @return View
	 */
	public function choice(string $url, MenuChoiceService $menus): View
	{
		try {

			if( $menus->checkUrl($url) ){
				$menu = $menus->getUrlMenu($url);

				$basicMenus = $menus->getBasicMenu($url);
				$categoryNames = $menus->getCategory();
				$categoryBasicMenus = $this->conversion($basicMenus,$categoryNames);

				$footerMenu = $menus->getFooterMenu();
				return view('menu.choice', compact('menu','url','categoryBasicMenus','footerMenu'));
			}
			throw new NotFoundException('存在しないURLです。');

		} catch (NotFoundException $e) {
			throw new NotFoundHttpException();
		}
	}

	private function conversion(array $basicMenus,array $categoryNames): array
	{
		$categoryBasicMenus = [];
		foreach($basicMenus as $post){
			if ( in_array($post['category'],$categoryNames,true) ){
				$categoryBasicMenus[$post['category']][] = $post;
			}
		}
		return $categoryBasicMenus;
	}

}
