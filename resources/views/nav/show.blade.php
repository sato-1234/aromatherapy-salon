@extends('layouts.common_show')

@section('analytics')
@include('includes/head_analytics')
@endsection

@section('head_meta')
	@component('components.head_meta')
		@if ( url()->current() === config('app.url') )
			@slot('title',config('app.name'))
			@slot('description', config('app.name') . 'の公式サイトになります。')
		@else
			@slot('title',$title[0])
			@slot('description', config("app.name") . 'の' . $title[0] . 'ページになります。')
		@endif
	@endcomponent
@endsection

@section('head_css')
	<link href="{{ asset('css/menu/style.css') }}" rel="stylesheet">
@endsection

@section('content')

	@component('nav.components.under_img')
		@slot('titleEn',$title[1])
		@slot('titleJa',$title[0])
		@slot('url',$url . '/' . $url . '.jpg')
	@endcomponent


	<div class="aromaBox">
		<div class="aromaBox2">

			<p style="text-align: center; padding:80px 20px">ご自由にカスタマイズしてください</p>

		</div>
	</div>
@endsection

@section('footer_a')
<a class="js-hover" href="{{ route('reservation.show') }}">ご予約</a>
@endsection
