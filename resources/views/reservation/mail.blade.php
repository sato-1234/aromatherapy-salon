<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />

<!-- レスポンシブ対応用 -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="email=no,telephone=no,address=no" />

<!-- CSS -->
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,500,700,900%7CNoto+Serif+JP:400,500,600,700,900&amp;display=swap&amp;subset=japanese" rel="stylesheet">

<style>
p {
	line-height:2;
}
p span{
	color:#ff66cc;
}
p a {
	color:blue;
}
.div2 .firstP{
	font-size: 18px;
	font-weight:bold;
}
</style>

</head>
<body>
	@if( $type === 'admin' )
	<div class="div1">
		<p>{{ config('app.name') }}のWEB予約ページから、予約のお問い合わせが入りました。<br/>
		以下の予約内容をご確認後、お客様にご連絡してください。</p>
	</div>
	@elseif( $type === 'client' )
	<div class="div1">
		<p>この度は{{ config('app.name') }}へ予約の受付（送信）、まことにありがとうございます。<br />
			現状予約可能か確認致しますので、今しばらくお待ち下さい。<span>（※まだ予約は確定しておりません）</span><br />
			確認出来次第、「{{ config('app.name') }}スタッフ」からお客様のメールアドレスまたはお電話にてご連絡いたします。<br />
			迷惑メール設定やシステムのトラブルや遅延などでメールが届かない場合は、お手数ですが以下のお電話かメールまでご連絡お願いいたします。（迷惑メールの設定をしている場合、{{ config('add.info.mail') }}からのメールが届く設定をお願いいたします。）
		</p>
		<p>TEL：<a href="tel:{{ config('add.info.tel') }}">{{ config('add.info.tel') }}</a></p>
		<p>MAIL：<a href="mailto:info&#64;{{ config('add.info.mail') }}">{{ config('add.info.mail') }}</a></p>
	</div>
	@endif

	<hr />
	<div class="div2">
		<p class="firstP">---- お問い合わせの予約内容 ----</p>
		@foreach ($content['orderMenus'] as $menu)
			<p>「{{ $menu['title'] }}」</p>
		@endforeach
		<p>日時：{{ $content['date'] }}　{{ $content['time'] }}</p>
		<p>合計所要時間：{{ $content['totalTime'] }}分</p>
		<p>合計料金：{{ $content['totalPrice'] }}円</p>

		<p>お名前：{{ $content['name'] }}</p>
		<p>フリガナ：{{ $content['hurigana'] }}</p>
		<p>お電話：<a href="tel:{{ $content['tel'] }}">{{ $content['tel'] }}</a></p>
		<p>メール：<a href="mailto:info&#64;{{ $content['email'] }}">{{ $content['email'] }}</a></p>
		<p>ご要望・備考：{{ $content['body'] }}</p>
	</div>
</body>
</html>
