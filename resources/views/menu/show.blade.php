@extends('layouts.common_show')

@section('analytics')
@include('includes/head_analytics')
@endsection

@section('head_meta')
	@component('components.head_meta')
		@slot('title','メニュー')
		@slot('description', config('app.name') . 'のメニュー一覧ページになります。')
	@endcomponent
@endsection

@section('head_css')
	<link href="{{ asset('css/menu/style.css') }}" rel="stylesheet">
@endsection

@section('content')

	@component('menu.components.under_img')
		@slot('titleEn','MENU')
		@slot('titleJa','メニュー')
		@slot('url','menu/menu.jpg')
	@endcomponent

	<div class="menuBox">
		<div class="menuBox2">

			<div class="menuBox3">
				<h3 class="mintyo">
					<span class="mintyo">心身の健康を維持し、</span>
					<span class="brSpan1">自然治癒力を高める</span>
				</h3>
				<p class="hiragino">厳選したアロマオイルを使い、香りとトリートメントで心と身体を健康へ。<br>
				一人ひとりのお悩みに丁寧にお応えし、お忙しいあなたの貴重なひとときを確かなものにいたします。<br>
				豊富なメニューとコースの中から、あなたに適切な施術をいたします。</p>
			</div>

			<ul class="menuBox4">
				@foreach ($categoryList as $key => $post)
				<li class="js-hover">
					<a href="{{ config('app.url') }}/menu/{{ $key }}">
						<div>
							<img src="{{ asset('img/menu/menu/' . $key . '.jpg') }}" alt="">
							<h4 class="mintyo"><span>{{ $post[1] }}</span><span>{{ $post[0] }}</span></h4>
						</div>
						<p class="hiragino">{{ $post[2] }}</p>
					</a>
				</li>
				@endforeach
			</ul>

		</div>
	</div>

@endsection

@section('footer_a')
<a class="js-hover" href="{{ route('reservation.show') }}">ご予約</a>
@endsection
