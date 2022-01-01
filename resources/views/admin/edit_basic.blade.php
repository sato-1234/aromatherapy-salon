@extends('layouts.common_admin')

@section('head')
<title>通常メニュー編集ページ - {{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.name') }}の通常メニュー編集ページ">
@endsection

@section('head_css')
<link href="{{ asset('css/admin/top.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="adminRight">
<section>
	<h2>通常メニュー編集</h2>
	<form id="submitComplete" class="createCampaign" method="POST" action="{{ route('admin.updateBasic',['id' => $editMenu['id']]) }}">
	@csrf

		@error('db_error')
			<div class="dbError">{{ $message }}</div>
		@enderror

		<p class="createCampaignP2">
			<span>タイトル<span>（全角＆半角含め60文字以内）</span></span>
			<input type="text" name="title" value="{{ $editMenu['title'] }}">
			@error('title')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP3">
			<span>カテゴリー選択（1つまで）</span>

			@foreach (config('add.category.list') as $category)
				<label class="{{ in_array($loop->index, [3,4,5], true) ? 'createCampaignPP' : '' }}">
					<input type="radio" name="category" value="{{ $category }}" {{
						$category === $editMenu['category'] ? 'checked' : ''
					}}>{{ $category }}
				</label>
			@endforeach

			@error('category')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP3">
			<span>メニューカテゴリ選択（1つ）</span>

			@foreach (config('add.menu.list') as $category_menu)
				<label class="{{ in_array($loop->index, [4,5,6,7], true) ? 'createCampaignPP' : '' }}">
					<input type="radio" name="category_menu" value="{{ $category_menu }}" {{
						$category_menu === $editMenu['category_menu'] ? 'checked' : ''
					}}>{{ $category_menu }}
				</label>
			@endforeach

			@error('category_menu')
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

		<input class="createCampaignSubmit" type="submit" name="basic" value="編集する">
	</form>
</section>
</div>
@endsection
