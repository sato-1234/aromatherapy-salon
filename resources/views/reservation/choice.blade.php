@extends('layouts.common_show')

@section('head_meta')
	<title>予約 - {{ config('app.name') }}</title>
	<meta name="robots" content="noindex" />
	<meta name="description" content="{{ config('app.name') }}のご予約ページになります。">
	<link rel="canonical" href="{{ url()->current() }}">
@endsection

@section('head_css')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link href="{{ asset('css/reservation/choice.css') }}" rel="stylesheet">
@endsection

@section('content')

	<div class="reservationNowAll">
		<form class="reservationNowForm" method="POST" action="{{ route('reservation.addPost') }}">
			@csrf

			<div class="reservationNow">

				@if( count($errors) > 0 )
				<div class="messBox"><span>※修正が必要な項目があります。</span></div>
				@endif

				<h2>現在の予約メニュー</h2>
				<ul>
					<li>
						<span>{{ $choiceMenu['title'] }}</span>
						<span><span>所要時間：</span>{{ $choiceMenu['time_required'] }}分</span>
						<span><span>料金：</span>{{ $choiceMenu['price'] }}円</span>
					</li>
				</ul>

				<h3>希望日時入力</h3>
				<p class="reservationChoiceP">※23:00の最終受付は60分以内のメニューでお選びください。また今日以降の日付でご選択ください。</p>
				<p class="dateP clearF">
					<label>
						<span>日時：</span>
						<input type="text" id="js-calendar" name="date" placeholder="日付選択" value="{{ old('date') }}">
					</label><br />
					<label>
						<input type="text" id="js-time" name="time" placeholder="時間選択" value="{{ old('time') }}">
					</label>
					@error('date')
						<span class="error">{{ $message }}</span>
					@enderror
					@error('time')
						<span class="error">{{ $message }}</span>
					@enderror
				</p>

				<div class="divForm">
					<a class="js-hover" href="{{ route('reservation.show') }}">選択のやり直し</a>
					<input class="js-hover" type="submit" value="この内容で次へ">
				</div>

				@if ( isset($categoryBasicMenus) )
				<h3 class="addMenuH3">追加メニューは以下から選択可能です。</h3>
				<p class="reservationChoiceP">
					※所要時間はあくまで目安です。混み具合等によって多少異なる場合があります。<br/>
					※料金は基本料金です。長さ、内容、キャンペーン利用等によって異なる場合があります。
				</p>

				<div class="divFormTwo">
					<table class="js-hover">
						<tbody>
							@foreach ($categoryBasicMenus as $key => $basicMenus)
							<tr><th class="mintyo">{{ $key }}</th></tr>
								@foreach ($basicMenus as $post)
								<tr>
									<td class="clearF">
										<label class="clearF">
											<input type="checkbox" class="click" name="ids[]" value="{{ $post['id'] }}"
											{{ gettype(old('ids')) === 'array' && in_array( (string)$post['id'], old('ids'), true) ? 'checked' : '' }}>
											<span>{{ $post['title'] }}</span>
											<span>{{ $post['price'] }}円</span>
											<span>{{ $post['time_required'] }}分</span>
										</label>
									</td>
								</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>
					<div>
						<a class="js-hover" href="{{ route('reservation.show') }}">選択のやり直し</a>
						<input class="js-hover" type="submit" value="この内容で次へ">
					</div>
				</div>
				@endif

			</div>

		</form>
	</div>
@endsection

@section('footer_script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
<script src="{{ asset('js/reservation/choice.js') }}"></script>
@endsection
