<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
//use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Http\Request;
//use App\Http\Requests\Reservation\MenuAdminRequest;
//use App\Services\ReservationAdmin\ReservationAdmin;

class AdminController extends Controller
{
	/**
	 * 管理画面TOP「/admin」
	 * @return View
	 */
	public function top(): View
	{
		return view('admin.top');
	}
}
