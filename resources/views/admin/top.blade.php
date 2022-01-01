@extends('layouts.common_admin')

@section('head')
<title>管理TOPページ - {{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.name') }}の管理TOPページ">
@endsection

@section('head_css')
<link href="{{ asset('css/admin/top.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="adminRight">
	<section id="js-deleteAll">

		<div class="adminRightDiv">
			<a href="{{ route('reservation.show') }}" target="_blank">公開中の予約メニューページ確認</a>
		</div>

		<h2>作成メニュー一覧</h2>
		<span>（ドラッグ&ドロップで順番を並べ替え、カテゴリ専用の「順番更新」をクリックで順番変更可能です。）</span>

		@error('db_error')
			<div class="dbError">{{ $message }}</div>
		@enderror

		@php $i = 0; @endphp

		@if ( isset($firstMeuns) )
			@php $i++; @endphp
			@component('admin.components.menu')
				@slot('p_title','新規のご来店（キャンペーン）')
				@slot('i',$i)
				@slot('posts',$firstMeuns)
				@slot('edit','Campaign')
			@endcomponent
		@endif

		@if ( isset($reMenus) )
			@php $i++; @endphp
			@component('admin.components.menu')
				@slot('p_title','全員（キャンペーン）')
				@slot('i',$i)
				@slot('posts',$reMenus)
				@slot('edit','Campaign')
			@endcomponent
		@endif

		@if ( isset($categoryBasicMenus) )
			@foreach ($categoryBasicMenus as $key => $basicMenus)
				@php $i++; @endphp
				@component('admin.components.menu')
					@slot('p_title',$key)
					@slot('i',$i)
					@slot('posts',$basicMenus)
					@slot('edit','Basic')
				@endcomponent
			@endforeach
		@endif

	</section>
</div>
@endsection

@section('footer_script')
<script src="{{ asset('js/admin/top.js') }}"></script>
@endsection
