<?php
declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    /**
     * 不可属性指定
     *
     * @var array
     */
    protected $guarded = ['id','created_at','updated_at'];

}
