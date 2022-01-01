<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('type')->default(1)->comment('新規キャンペーン(0)||全員キャンペーン（1）');
            $table->boolean('coupon')->default(0)->comment('通常メニュー(0)||キャンペーンメニュー（1）');
            $table->string('category', 255)->comment('所属カテゴリで予約ページ用。キャンペーンメニューの場合複数選択可能');
            $table->string('category_menu', 50)->default('アロマトリートメント')->comment('コースカテゴリでMENU詳細ページ用');
            $table->string('title',72)->comment('メニュータイトル');
            $table->string('body',92)->nullable()->comment('メニュー詳細');
            $table->integer('price')->unsigned()->comment('料金');
            $table->integer('time_required')->unsigned()->comment('所要時間（分単位）');
            $table->string('img',255)->nullable()->default('no_image.png')->comment('キャンペーン用画像');
            $table->date('expiration_date')->nullable()->comment('キャンペーン用有効期限');
            $table->integer('order_num')->unsigned()->default(1)->comment('表示順の操作（数値4桁までの並べ順）');
            $table->boolean('display')->default(1)->comment('表示フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_menus');
    }
}
