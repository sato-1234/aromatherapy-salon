@extends('layouts.common_show')

@section('analytics')
@include('includes/head_analytics')
@endsection

@section('head_meta')
	@component('components.head_meta')
		@slot('title',$menu[0])
		@slot('description', config('app.name') . 'のメニュー内容の' . $menu[0] . '説明ページになります。')
	@endcomponent
@endsection

@section('head_css')
	<link href="{{ asset('css/menu/choice.css') }}" rel="stylesheet">
@endsection

@section('content')

	@component('menu.components.under_img')
		@slot('titleEn',$menu[1])
		@slot('titleJa',$menu[0])
		@slot('url',$url . '/' . $url . '_1.jpg')
	@endcomponent


	<div class="aromaBox">
		<div class="aromaBox2">

			@include('menu/includes/' . $url)

			@component('menu.components.menu')
				@slot('titleEn',$menu[1])
				@slot('titleJa',$menu[0])
				@slot('categoryBasicMenus',$categoryBasicMenus)
			@endcomponent

			<div class="aromaBox5">
				<h3 class="mintyo">施術の流れ</h3>
				<ol>
					<li class="clearF">
						<p>
							<span class="mintyo">カウンセリング</span>
							<span>カウンセリングをした後、心と身体に合わせたアロマブレンドのご提案をいたします。</span>
						</p>
					</li>
					<li class="clearF">
						<p>
							<span class="mintyo">施術</span>
							<span>カウンセリング内容をもとに、お客様のお身体の状態に合わせた施術をいたします。</span>
						</p>
					</li>
					<li class="clearF">
						<p>
							<span class="mintyo">アフターフォロー</span>
							<span>施術時に診断した、現在のお身体の状態をお伝えし、それに基づいたセルフケアのアドバイスをご提供します。</span>
						</p>
					</li>
				</ol>
			</div>

		</div>
	</div>

	<section class="menuFooter mintyo">

		<h2>
			<span>MENU</span><span>メニュー</span>
		</h2>

		<ul class="js-hover">
			@foreach ($footerMenu as $key => $value)
			<li>
				<a href="{{ url('/menu/' . $key) }}">
					<img src="{{ asset('img/menu/common/' . $key . '.jpg') }}" alt="">
					<p><span>{{ $value[1] }}</span><span>{{ $value[0] }}</span></p>
				</a>
			</li>
			@endforeach
		</ul>

	</section>
@endsection

@section('footer_a')
<a class="js-hover" href="{{ route('reservation.show') }}">ご予約</a>
@endsection
