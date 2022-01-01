@extends('layouts.common_admin')

@section('head')
<title>通常MENU作成ページ - {{ config('app.name') }}</title>
<meta name="description" content="{{ config('app.name') }}の通常MENU作成ページ">
@endsection

@section('head_css')
<link href="{{ asset('css/admin/top.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="adminRight">
<section>
	<h2>基本メニュー作成</h2>
	<form id="submitComplete" class="createCampaign" method="POST" action="{{ route('admin.storeBasic') }}">
	@csrf

		@error('db_error')
			<div class="dbError">{{ $message }}</div>
		@enderror

		<p class="createCampaignP20">
			<span>タイトル<span>（全角＆半角含め60文字以内）</span></span>
			<input type="text" name="title" value="{{ old('title') }}">
			@error('title')
				<span class="error">{{ $message }}</span>
			@enderror
		</p>

		<p class="createCampaignP3">
			<span>カテゴリー選択（1つまで）</span>

			@foreach (config('add.category.list') as $category)
				<label class="{{ in_array($loop->index, [3,4,5], true) ? 'createCampaignPP' : '' }}">
					<input type="radio" name="category" value="{{ $category }}" {{
						( $loop->index === 0 && is_null(old('category')) ) ||
						( $category === old('category') )
						? 'checked' : ''
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
						( $loop->index === 0 && is_null(old('category_menu')) ) ||
						( $category_menu === old('category_menu') )
						? 'checked' : ''
					}}>{{ $category_menu }}
				</label>
			@endforeach

			@error('category_menu')
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

		<input class="createCampaignSubmit" type="submit" name="basic" value="投稿する">
	</form>
</section>
</div>
@endsection
