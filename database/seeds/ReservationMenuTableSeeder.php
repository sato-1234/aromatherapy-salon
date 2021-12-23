<?php

use Illuminate\Database\Seeder;

class ReservationMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reservation_menus')->insert([
            [
                //新規様キャンペーン
                'type' => 0,
                'coupon' => 1,
                'category' => 'ボディトリートメント',
                'category_menu' => 'アロマトリートメント',
                'title' => '【極上の施術をこのお値段で☆】アロマトリートメント5380円',
                'body' => 'ベテランの施術者があなたの体をほぐします。免疫力もアップします。極めてナチュラルなアロマで、安らぎとともに真の癒しの時間を。',
                'price' => 5380,
                'time_required' => 60,
                'expiration_date' => '2021-11-30'
            ],[
                'type' => 0,
                'coupon' => 1,
                'category' => 'ボディトリートメント',
                'category_menu' => 'アロマトリートメント',
                'title' => '【ご新規様限定】極上アロマトリートメント80分',
                'body' => '特にお疲れの方へオススメ！60分では味わえない、充実のフルボディケアコース',
                'price' => 7180,
                'time_required' => 80,
                'expiration_date' => '2021-11-30'
            ],[
                //全員キャンペーン
                'type' => 1,
                'coupon' => 1,
                'category' => 'ボディトリートメント',
                'category_menu' => 'アロマトリートメント',
                'title' => '【限定】秋ブレンド精油アロマトリートメント70分＋ヘッド20分',
                'body' => 'ベルガモットとユーカリ、ラベンダーの秋限定のブレンドは心のバランスをとり深く落ち着いた呼吸へ導きます。免疫機能とストレス緩和に有効なブレンドです。',
                'price' => 8140,
                'time_required' => 90,
                'expiration_date' => '2021-11-30'
            ],[
                'type' => 1,
                'coupon' => 1,
                'category' => 'ボディトリートメント,ボディケア',
                'category_menu' => 'アロマトリートメント',
                'title' => '【よくばりコース】ほぐし20分＋アロマトリートメント60分',
                'body' => 'ほぐしとアロマトリートメント　どちらも堪能したい方へオススメのクーポン！お疲れの部位をしっかりほぐした後、アロマトリートメントでしっかり流します。',
                'price' => 7480,
                'time_required' => 80,
                'expiration_date' => '2021-11-30'
            ],[
                //通常MENU
                'type' => 1,
                'coupon' => 0,
                'category' => 'ボディトリートメント',
                'category_menu' => 'アロマトリートメント',
                'title' => 'アロマトリートメント お試しコース《20分》 (背中・足後面)',
                'body' => '◆肩こり・腰痛・リンパの流れ・デトックスに効きます◆',
                'price' => 2620,
                'time_required' => 20,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'ボディトリートメント',
                'category_menu' => 'アロマトリートメント',
                'title' => 'アロマトリートメント《30分》(背中・足後面)',
                'body' => null,
                'price' => 3680,
                'time_required' => 30,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'ボディトリートメント',
                'category_menu' => 'ローズコース',
                'title' => 'ローズオイルコースA（足裏・足前後面・背中)　《60分》',
                'body' => '◆ブルガリア産最高級ダマスクローズオイル使用◆',
                'price' => 8500,
                'time_required' => 60,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'フェイシャル',
                'category_menu' => '金箔トリートメント',
                'title' => 'フェイシャル　ゴールドオイルコース　お試しコース《20分》',
                'body' => '◆金箔オイルトリートメント◆',
                'price' => 2800,
                'time_required' => 20,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'フェイシャル',
                'category_menu' => '金箔トリートメント',
                'title' => 'フェイシャル　ゴールドオイルコース　金箔パックコースA《60分》',
                'body' => '◆お試しコース+金箔パック◆',
                'price' => 8200,
                'time_required' => 60,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'その他メニュー（リラク）',
                'category_menu' => '耳ツボマッサージ',
                'title' => '耳つぼトリートメント　お試しコース《10分》',
                'body' => null,
                'price' => 1230,
                'time_required' => 10,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'その他メニュー（リラク）',
                'category_menu' => '矯正メニュー',
                'title' => '頭蓋骨矯正・小顔整顔《60分》',
                'body' => '◆リフトアップ、むくみ解消、エイジングケア、小顔◆',
                'price' => 6900,
                'time_required' => 60,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => '足裏・リフレクソロジー',
                'category_menu' => 'フットケア',
                'title' => 'フットケア《20分》',
                'body' => '足首まで(プラス300円でアロマオイル使用できます☆)',
                'price' => 2620,
                'time_required' => 20,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'ヘッド',
                'category_menu' => 'ヘッドケア',
                'title' => 'ヘッドスパ《10分》',
                'body' => '頭頂部中心',
                'price' => 1230,
                'time_required' => 10,
                'expiration_date' => null
            ],[
                'type' => 1,
                'coupon' => 0,
                'category' => 'ボディケア',
                'category_menu' => 'その他メニュー',
                'title' => 'ほぐしメニュー《30分》',
                'body' => null,
                'price' => 3360,
                'time_required' => 30,
                'expiration_date' => null
            ]
        ]);
    }
}
