<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_historys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reservation_ids',255)->comment('予約MENU_ID一覧');
            $table->date('hope_date')->comment('希望日時');
            $table->time('hope_time')->comment('希望日時');
            $table->integer('total_time_required')->unsigned()->comment('合計時間');
            $table->integer('total_price')->unsigned()->comment('合計料金');
            //$table->string('person',100)->comment('指名');
            $table->string('name',100)->comment('お客様名');
            $table->string('hurigana',255)->comment('お客様のフリガナ');
            $table->string('tel',20)->comment('お客様のTEL');
            $table->string('email',255)->comment('お客様のMAIL');
            $table->string('body',255)->nullable()->comment('備考');
            //$table->boolean('type')->default(0)->comment('履歴に同じ「電話番号またはMAIL」がある場合「1」');
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
        Schema::dropIfExists('reservation_historys');
    }
}
