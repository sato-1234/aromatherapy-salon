@extends('layouts.common_admin')

@section('head')
<title>キャンペーンMENU作成ページ - {{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.name') }}のキャンペーンMENU作成ページ">
@endsection

@section('head_css')
<link href="{{ asset('css/admin/top.css') }}" rel="stylesheet">
@endsection

@section('content')

@component('admin.components.img')
	@slot('imgs',$imgs)
@endcomponent

<div class="adminRight">
<section>
	<h2>キャンペーンメニュー作成</h2>
	<form id="submitComplete" class="createCampaign" method="POST" action="{{ route('admin.storeCampaign') }}">
	@csrf

		@error('db_error')
			<div class="dbError">{{ $message }}</div>
		@enderror


		<p class="createCampaignP1">
			<span>新規か全員のどちらか選択</span>

			<label>
				<input type="radio" name="type" value="1" {{ is_null(old('type')) || old('type') === '1' ? 'checked' : '' }}>全員
			</label>

			<label>
				<input type="radio" name="type" value="0" {{ old('type') === '0' ? 'checked' : '' }}>新規
			</label>

			@error('type')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP2">
			<span class="span">画像設定
				<span>（画像名コピーして記入：
					<span id="js-imgListOpen" class="colors">画像リスト表示</span>）
				</span>
			</span>
			<input type="text" name="img" value="{{ old('img') }}">
			@error('img')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP20">
			<span>タイトル<span>（全角＆半角含め60文字以内）</span></span>
			<input type="text" name="title" value="{{ old('title') }}">
			@error('title')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP3">
			<span>カテゴリー選択（3つまで）</span>

			@foreach (config('add.category.list') as $category)
				<label class="{{ in_array($loop->index, [3,4,5], true) ? 'createCampaignPP' : '' }}">
					<input type="checkbox" name="category[]" value="{{ $category }}" {{
						( $loop->index === 0 && is_null(old('category')) ) ||
						( is_array(old('category')) && in_array($category, old('category'), true) )
						? 'checked' : ''
					}}>{{ $category }}
				</label>
			@endforeach

			@error('category.*')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP4">
			<span>料金設定（半角数値）</span>
			<input type="number" name="price" value="{{ old('price') }}">円
			@error('price')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP4">
			<span>所要時間（半角数値）</span>
			<input type="number" name="time_required" value="{{ old('time_required') }}">分
			@error('time_required')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP5">
			<span>有効期限</span>
			<input type="date" name="expiration_date" value="{{ old('expiration_date') }}">
			@error('expiration_date')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP6">
			<span>説明（全角＆半角含め92文字以内）</span>
			<textarea type="text" name="body">{{ old('body') }}</textarea>
			@error('body')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP7">
			<span>カテゴリ内の表示順番（半角数値1~9999、1で一番上。設定なしで9999一番下。同じ数値の場合登録が古い順が前に表示）</span>
			<input type="number" name="order_num" value="{{ old('order_num') }}">
			@error('order_num')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<input class="createCampaignSubmit" type="submit" name="campaign" value="投稿する">
	</form>
</section>
</div>
@endsection

@section('footer_script')
<script src="{{ asset('js/admin/create.js') }}"></script>
@endsection
