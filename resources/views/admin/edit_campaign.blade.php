@extends('layouts.common_admin')

@section('head')
<title>キャンペーンメニュー編集ページ - {{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.name') }}のキャンペーンメニュー編集ページ">
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
	<h2>キャンペーンメニュー編集</h2>
	<form id="submitComplete" class="createCampaign" method="POST" action="{{ route('admin.updateCampaign',['id' => $editMenu['id']]) }}">
		@csrf

		@error('db_error')
			<div class="dbError">{{ $message }}</div>
		@enderror


		<p class="createCampaignP1">
			<span>新規か全員のどちらか選択</span>

			<label>
				<input type="radio" name="type" value="1" {{ $editMenu['type'] === 1 ? 'checked' : '' }}>全員
			</label>

			<label>
				<input type="radio" name="type" value="0" {{ $editMenu['type'] === 0 ? 'checked' : '' }}>新規
			</label>

			@error('type')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP2">
			<span class="span">画像設定
				<span>（保存画像名コピーして記入：
					<span id="js-imgListOpen" class="colors">画像リスト表示</span>）
				</span>
			</span>
			<input type="text" name="img" value="{{ $editMenu['img'] }}">
			@error('img')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP2">
			<span>タイトル<span>（全角＆半角含め60文字以内）</span></span>
			<input type="text" name="title" value="{{ $editMenu['title'] }}">
			@error('title')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP3">
			<span>カテゴリー選択（3つまで）</span>

			@foreach (config('add.category.list') as $category)
				<label class="{{ in_array($loop->index, [3,4,5], true) ? 'createCampaignPP' : '' }}">
					<input type="checkbox" name="category[]" value="{{ $category }}" {{
						in_array($category,$editMenu['category'], true) ? 'checked' : ''
					}}>{{ $category }}
				</label>
			@endforeach

			@error('category.*')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP4">
			<span>料金設定（半角数値）</span>
			<input type="number" name="price" value="{{ $editMenu['price'] }}">円
			@error('price')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP4">
			<span>所要時間（半角数値）</span>
			<input type="number" name="time_required" value="{{ $editMenu['time_required'] }}">分
			@error('time_required')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP5">
			<span>有効期限</span>
			<input type="date" name="expiration_date" value="{{ $editMenu['expiration_date'] }}">
			@error('expiration_date')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP6">
			<span>説明（全角＆半角含め92文字以内）</span>
			<textarea type="text" name="body">{{ $editMenu['body'] }}</textarea>
			@error('body')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP7">
			<span>カテゴリ内の表示順番（半角数値1~9999、1で一番上。設定なしで9999一番下。同じ数値の場合登録が古い順が前に表示）</span>
			<input type="number" name="order_num" value="{{ $editMenu['order_num'] }}">
			@error('order_num')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<input class="createCampaignSubmit" type="submit" name="campaign" value="編集する">
	</form>
</section>
</div>
@endsection

@section('footer_script')
<script src="{{ asset('js/admin/create.js') }}"></script>
@endsection
