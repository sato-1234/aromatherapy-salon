<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationMenu extends Model
{
    protected $table = 'reservation_menus';

    /**
     * 不可属性指定
     *
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];

}
