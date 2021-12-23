@extends('layouts.common_show')

@section('head_meta')
	<title>予約 - {{ config('app.name') }}</title>
	<meta name="robots" content="noindex" />
	<meta name="description" content="{{ config('app.name') }}のご予約ページになります。">
	<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('head_css')
	<link href="{{ asset('css/reservation/complete.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="reservationNowAll reservationCompletePadding">
		<div class="reservationCompleteDivs">
			@if ( $result )
			<p class="reservationCompleteP">
				<span>予約内容の送信が完了いたしました。</span>
				「{{ config('app.name') }}」からお客様のメールまたはお電話に、予約可能かご連絡いたしますので、今しばらくお待ち下さい。迷惑メール設定やシステムのトラブルや遅延などで、メールが届かない場合は、お手数ですが以下のお電話かメール先までご連絡お願いいたします。（迷惑メールの設定をしている場合、{{ config('add.info.mail') }}からのメールが届く設定をお願いいたします。）
			</p>
			<div class="reservationCompleteDiv">
				<a href="tel:{{ config('add.info.tel') }}">TEL：{{ config('add.info.tel') }}</a>
				<a href="mailto:info&#64;{{ config('add.info.mail') }}">MAIL：{{ config('add.info.mail') }}</a>
				<a class="js-hover" href="{{ route('reservation.show') }}">予約ページへ</a>
			</div>
			@else
			<p class="reservationCompleteP">
				<span>送信に失敗しました。</span>
				大変申しわけありません。システムエラーにより予約送信に失敗しました。再度予約送信が必要になります。お手数おけしますが何卒よろしくお願い致します。
			</p>
			<div class="reservationCompleteDiv">
				<a class="js-hover" href="{{ route('reservation.show') }}">予約ページへ</a>
			</div>
			@endif
		</div>
	</div>
@endsection
