<?php
declare(strict_types=1);
namespace App\Services;

class CommonService{

	public static function conversion(?array $basicMenus,array $categoryNames): ?array
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

}
