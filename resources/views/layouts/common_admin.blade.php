<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<!-- 必須設定 -->
	@include('includes/head_meta_required')

	<!-- noindex title description canonical ogp -->
	<meta name="robots" content="noindex" />
	@yield('head_meta')

	<!-- Fonts icon -->
	@include('includes/head_fonts_icon')

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="{{ asset('js/common/ofi.min.js') }}"></script>
	<script src="{{ asset('js/common/admin_head.js') }}"></script>
	@yield('head_script')

	<!-- Styles	-->
	<link href="{{ asset('css/common/common.css') }}" rel="stylesheet">
	<link href="{{ asset('css/common/admin.css') }}" rel="stylesheet">
	@yield('head_css')

	<!-- ファビコン必要な場合、正方形の700pxから作成推奨、種類3個	-->
	@include('includes/head_favicon')

</head>
<body id="body">
<div class="contents">
	<header class="adminHeader clearF">

		<h1>
			<a class="js-hover" href="{{ url('/admin') }}">{{ config('app.name') }}</a>
		</h1>

		<span id="js-button"><span></span></span>
		<div id="js-nav">
			<span id="js-close"></span>
			<nav class="clearF">
			@guest
				<div>
					<a href="{{ route('login') }}">{{ __('Login') }}</a>
				</div>
			@else
				<a class="js-hover" id="js-logoutButton" href="{{ route('logout') }}">
							{{ __('ログアウト') }}
				</a>
				<form id="js-logoutForm" action="{{ route('logout') }}" method="POST">
							@csrf
				</form>
				<span>管理者名：{{ Auth::user()->name }}</span>
				<ul class="navUlAdmin">
					<li><a href="{{ route('admin.top') }}">メニュー一覧</a></li>
					<li><a href="{{ route('admin.createCampaign') }}">キャンペーンメニュー作成</a></li>
					<li><a href="{{ route('admin.createBasic') }}">基本メニュー作成</a></li>
					<li><a href="{{ route('admin.createPhoto') }}">画像管理</a></li>
				</ul>
			@endguest
			</nav>
		</div>

	</header>

	<main>
		<section class="adminLeft">
			<h2>【管理メニュー覧】</h2>
			<ul>
				<li><a href="{{ route('admin.top') }}">メニュー一覧</a></li>
				<li><a href="{{ route('admin.createCampaign') }}">キャンペーンメニュー作成</a></li>
				<li><a href="{{ route('admin.createBasic') }}">基本メニュー作成</a></li>
				<li><a href="{{ route('admin.createPhoto') }}">画像管理</a></li>
			</ul>
		</section>
		@yield('content')
	</main>

	<footer class="adminfooter">
		<p><small>&copy; {{ config('app.name') }}</small></p>
	</footer>

</div>
<script src="{{ asset('js/common/common.js') }}"></script>
<script src="{{ asset('js/common/admin.js') }}"></script>
@yield('footer_script')
</body>
</html>
