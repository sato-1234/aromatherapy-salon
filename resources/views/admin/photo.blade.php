@extends('layouts.common_admin')

@section('head')
<title>画像管理ページ（ - {{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.name') }}の画像管理ページ">
@endsection

@section('head_css')
<link href="{{ asset('css/admin/top.css') }}" rel="stylesheet">
@endsection

@section('content')

	@if (session('success'))
		<div class="success" id="js-success"><span>{{ session('success') }}</span></div>
	@endif

	<div class="adminRight">
		<section>

			<form class="reservationUp" method="POST" action="{{ route('admin.uploadPhoto') }}" enctype="multipart/form-data">
				@csrf
				<p>
					<span>※画像選択後、アップロードすると保存ができます。<br />【推奨画像比率：横600✕縦500】</span>
					<span>※画像を圧縮（容量を小さく）してアップロードすると、画像表示も早くなります。<br /><a href="https://tinypng.com/" rel="noopener noreferrer" target="_blank">おすすめ画像圧縮サイト（5MBまで対応）</a></span>
					<input type="file" name="photo" placeholder="画像選択">
				</p>
				<input type="submit" value="画像アップロード">
				@error('photo')
					<div class="error">{{ $message }}</div>
				@enderror
			</form>

			<h2 class="colorClick">画像一覧<span>（画像クリックで画像名コピー）</span></h2>
			<div class="imgList">
				<ul class="clearF" id="js-imgUl">
				@if(isset($imgs))
				@foreach ($imgs as $post)
					<li>
						<form method="POST" action="{{ route('admin.destroyPhoto') }}" enctype="multipart/form-data">
							@csrf
							@if( isset($post['type']) )
								<span class="category">{{ $post['type'] }}</span>
							@endif
							<img data-id="{{ $post['url'] }}" class="js-imgName js-hover js-ObjectFitCover" src="{{ asset('storage/img/reservation_set/' . $post['url']) }}" alt="">
							<input type="text" name="photo_destroy" value="{{ $post['url'] }}">
							<input class="js-delete" type="submit" value="削除">
						</form>
					</li>
				@endforeach
				@else
					<li class="imgNo">保存画像なし</li>
				@endif
				</ul>
			<div>

		</section>
	</div>
@endsection

@section('footer_script')
<script src="{{ asset('js/admin/create.js') }}"></script>
<script src="{{ asset('js/admin/photo.js') }}"></script>
@endsection
