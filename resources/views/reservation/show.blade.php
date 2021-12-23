@extends('layouts.common_show')

@section('analytics')
@component('components.analytics')
@endcomponent
@endsection

@section('head_meta')
	@component('components.head_meta')
		@slot('title','予約')
		@slot('description','{{ config("app.name") }}のご予約ページになります。')
	@endcomponent
@endsection

@section('head_css')
<link href="{{ asset('css/reservation/show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="UnderImg">
	<h2 class="mintyo"><span>RESERVATION</span><span>予約</span></h2>
	<div class="UnderImgDiv clearF">
		<ul class="js-hover">
			<li><a href="{{ config('app.url') }}/"></a></li>
			<li>ご予約</li>
		</ul>
	</div>
	<img src="{{ asset('img/reservation/reservation_1.jpg') }}" alt="以下から予約可能です。">
</div>

<div class="reservationBox">

	<section class="boxFirst">
		<h3 class="mintyo">ご予約前に</h3>

		<div class="boxFirstInner">

			<section class="boxFirstSection">
				<h4 class="mintyo">お電話でのご予約</h4>
				<p>
					当日のご予約またはお急ぎの場合は、お電話にてご連絡ください。<br />23:00が最終受付です。最終受付は60分以内のメニューとさせて頂きます。<br />
					<span>※施術中は出られないことがありますが、お電話にて折り返しのご連絡をさせていただきます。</span>
				</p>
				<div class="boxFirstTel mintyo"><span>担当／XX：</span><a href="tel:{{ config('add.info.tel') }}">{{ config('add.info.tel') }}</a></div>
				<div class="boxFirstTel boxFirstTelTwo mintyo"><span>フロント：</span><a href="tel:XXX-XXX-XXXX">XXX-XXX-XXXX</a></div>
			</section>

			<section class="boxFirstSection">
				<h4 class="mintyo">ホットペッパーでのご予約</h4>
				<a class="linkBnr js-hover" href="{{ config('add.info.hotpepper') }}" rel="noopener noreferrer" target="_blank" title="ホットペッパービューティー"><img src="{{ asset('img/reservation/bnr_hotpepper.png') }}" alt="ホットペッパーからでも予約可能"></a>
			</section>

			<section class="boxFirstSection">
				<h4 class="mintyo">ホームページからご予約</h4>
				<a class="linkSquare js-hover js-pageLink" href="#reservationForm">ご予約フォーム</a>
			</section>

		</div>

	</section>

	@if ( is_null($firstMeuns) && is_null($reMenus) && is_null($categoryBasicMenus))
	<p id="reservationForm" style="color:red; text-align:center; line-height:2;">予約MENUが登録されていません<br />シーダーなどで登録してください</p>
	@endif

	@if ( isset($firstMeuns) && isset($reMenus) )
	<section id="reservationForm" class="boxCommon boxCommonOne">
		<h3 class="mintyo"><span>Campaign</span><span>キャンペーンメニュー</span></h3>

		@if ( isset($firstMeuns) )
			<p class="mintyo">新規のご来店</p>
			@component('reservation.components.menu')
				@slot('posts',$firstMeuns)
			@endcomponent
		@endif

		@if ( isset($reMenus) )
			<p class="mintyo">再来店（全員）</p>
			@component('reservation.components.menu')
				@slot('posts',$reMenus)
			@endcomponent
		@endif

	</section>
	@endif

	@if ( isset($categoryBasicMenus) )
	<section class="boxCommon boxCommonTwo">
		<h3 class="mintyo"><span>Menu</span><span>基本メニュー</span></h3>

		<table class="js-hover">
			<tbody>

				@foreach ($categoryBasicMenus as $key => $basicMenus)
				<tr><th  class="mintyo" colspan="3">{{ $key }}</th></tr>
					@foreach ($basicMenus as $post)
					<tr>
						<td><span>{{ $post['time_required'] }}分</span></td>
						<td>
							<p>
								<span>{{ $post['title'] }}</span>
								<span>{{ $post['body'] }}</span>
							</p>
						</td>
						<td>
							<span>¥{{ $post['price'] }}</span>
							<form class="js-hover" method="POST" action="{{ route('reservation.choicePost') }}">
								@csrf
								<input type="number" name="id" value="{{ $post['id'] }}">
								<input class="new" type="submit" name="new" value="ご予約">
							</form>
						</td>
					</tr>
					@endforeach

				@endforeach

			</tbody>
		</table>

	</section>
	@endif

</div>
@endsection
