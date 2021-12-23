<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationHistory extends Model
{
    protected $table = 'reservation_historys';

    /**
     * 不可属性指定
     *
     * @var array
     */
    protected $guarded = ['id','person','created_at','updated_at'];
}
