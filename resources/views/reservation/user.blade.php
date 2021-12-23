@extends('layouts.common_show')

@section('head_meta')
	<title>予約 - {{ config('app.name') }}</title>
	<meta name="robots" content="noindex" />
	<meta name="description" content="{{ config('app.name') }}のご予約ページになります。">
	<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('head_css')
	<link href="{{ asset('css/reservation/user.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="reservationNowAll">
	<form id="submitComplete" method="POST" action="{{ route('reservation.userPost') }}">
		@csrf

		<div class="reservationUser">

			@if( count($errors) > 0 )
				<div class="messBox"><span>※修正が必要な項目があります。</span></div>
			@endif

			<h2>現在の予約メニュー</h2>
			<ul>
			@foreach ($choiceMenus as $post)
				<li>
					<span>{{ $post['title'] }}</span>
					<span><span>所要時間：</span>{{ $post['time_required'] }}分</span>
					<span><span>料金：</span>{{ $post['price'] }}円</span>
				</li>
			@endforeach
			</ul>

			<div class="reservationUserDiv clearF mintyo">
				<span>
					<span>希望日時</span><span>{{ $date }}</span>
					<span>{{ $time }}</span>
				</span>
				<span>
					<span>合計</span><span>{{ $totalTime }}分</span>
					<span>{{ $totalPrice }}円</span>
				</span>
			</div>

			<h3 class="reservationUserh3">必要事項記入</h3>

			<div class="reservationUserForm">

				@foreach ($inputView as $key => $post)
				<label class="clearF">
					<span>{{ $key }}<span class="hissu">（必須）</span></span>
					<input type="{{ $post['type'] }}" name="{{ $post['name'] }}" placeholder="{{ $post['placeholder'] }}" value="{{ old($post['name']) }}">
					@error($post['name'])
						<span class="error">{{ $message }}</span>
					@enderror
				</label>
				@endforeach

				<label class="clearF">
					<span>ご要望・備考</span>
					<textarea type="text" name="body">{{ old('body') }}</textarea>
					@error('body')
						<span class="error">{{ $message }}</span>
					@enderror
				</label>

				<div>
					<a class="js-hover" href="{{ route('reservation.choiceView') }}">選択のやり直し</a>
					<input class="js-hover" type="submit" value="この内容で仮予約">
				</div>

			</div>

		</div>

	</form>
</div>
@endsection

@section('footer_script')
<script src="{{ asset('js/reservation/user.js') }}"></script>
@endsection
