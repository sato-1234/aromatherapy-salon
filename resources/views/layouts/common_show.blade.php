<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
	<!-- アナリティクス設定 -->
	@yield('analytics')

	<!-- 必須設定 -->
	@include('includes/head_meta_required')

	<!-- noindex title description canonical ogp -->
	@yield('head_meta')

	<!-- Fonts icon -->
	@include('includes/head_fonts_icon')

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="{{ asset('js/common/ofi.min.js') }}"></script>
	@yield('head_script')

	<!-- Styles	-->
	<link href="{{ asset('css/common/common.css') }}" rel="stylesheet">
	<link href="{{ asset('css/common/show.css') }}" rel="stylesheet">
	@yield('head_css')

	<!-- ファビコン必要な場合、正方形の700pxから作成推奨、種類3個	-->
	@include('includes/head_favicon')

</head>
<body id="body">
<div class="contents">

	<header class="header">

		<div class="headerUnder">
			<h1 class="mintyo"><a href="{{ config('app.url') }}/">{{ config('app.name') }}</a></h1>
		</div>

		<span class="navButton" id="js-button"><span></span></span>

		<nav class="headerNav" id="js-nav">
			<ul class="clearF js-hover mintyo">
				<li><a href="{{ config('app.url') }}/">HOME<span>トップ</span></a></li>
				<li><a href="{{ config('app.url') }}/about/">ABOUT<span>店舗案内</span></a></li>
				<li><a href="{{ config('app.url') }}/news/">NEWS<span>お知らせ</span></a></li>
				<li><a href="{{ route('menu.show') }}">MENU<span>メニュー</span></a></li>
				<li><a href="{{ route('reservation.show') }}">RESERVATION<span>ご予約</span></a></li>
				<li><a  href="{{ config('app.url') }}/netshop/">NETSHOP<span>ネットショップ</span></a></li>
				<li><a href="{{ config('app.url') }}/recruit/">RECRUIT<span>採用情報</span></a></li>
			</ul>
		</nav>

	</header>

	<aside class="sns">
		<ul class="clearF js-hover">
			<li class="insta"><a href="{{ config('add.info.insta') }}" rel="noopener noreferrer" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
			<li class="twitter"><a href="{{ config('add.info.twi') }}" rel="noopener noreferrer" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
			<li class="facebook"><a href="{{ config('add.info.face') }}" rel="noopener noreferrer" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
			<li class="pinterest"><a href="{{ config('add.info.pin') }}" rel="noopener noreferrer" target="_blank" title="Pinterest"><i class="fab fa-pinterest"></i></a></li>
			<li class="line"><a href="{{ config('add.info.line') }}" rel="noopener noreferrer" target="_blank" title="LINE@"><i class="fab fa-line"></i></a></li>
		</ul>
	</aside>

	<main>
		@yield('content')
	</main>

	<div class="returnTop">
		<a href="#body" class="js-hover js-pageLink"><span></span></a>
	</div>

	<ul class="footerPrev clearF mintyo">
		<li>
			<a class="js-hover" href="{{ config('app.url') }}/access/">
				<img src="{{ asset('img/common/footer_1.jpg') }}" alt="">
				<img class="img2" src="{{ asset('img/common/sp/footer_sp1.jpg') }}" alt="ACCESS">
				<span>ACCESS</span>
			</a>
		</li>
		<li>
			<a class="js-hover" href="{{ config('app.url') }}/netshop/">
				<img src="{{ asset('img/common/footer_2.jpg') }}" alt="">
				<img class="img2" src="{{ asset('img/common/sp/footer_sp2.jpg') }}" alt="NETSHOP">
				<span>NETSHOP</span>
			</a>
		</li>
		<li>
			<a class="js-hover" href="{{ config('app.url') }}/therapist/">
				<img src="{{ asset('img/common/footer_3.jpg') }}" alt="">
				<img class="img2" src="{{ asset('img/common/sp/footer_sp3.jpg') }}" alt="THERAPIST">
				<span>THERAPIST</span>
			</a>
		</li>
	</ul>

	<footer class="footer">

		<div class="footerDiv">
			<div>
				<a class="mintyo" href="{{ config('app.url') }}/">
					<span>{{ config('app.name') }}</span>
				</a>
			</div>
			<address>
				<span>〒XXX-XXXX　XX県XX市X番町X丁目X-XX<span>XXXXXXXXXXXX</span></span>
				<span>{{ config('add.info.tel') }}</span>
			</address>
			<div class="footerLink">
				<a href="#" target="_blank" rel="noopener noreferrer">
					<img src="{{ asset('img/common/banner.png') }}" alt="バナーリンク">
				</a>
			</div>
			<ul class="clearF js-hover">
				<li class="insta"><a href="{{ config('add.info.insta') }}" rel="noopener noreferrer" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
				<li class="twitter"><a href="{{ config('add.info.twi') }}" rel="noopener noreferrer" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
				<li class="facebook"><a href="{{ config('add.info.face') }}" rel="noopener noreferrer" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
				<li class="pinterest"><a href="{{ config('add.info.pin') }}" rel="noopener noreferrer" target="_blank" title="Pinterest"><i class="fab fa-pinterest"></i></a></li>
				<li class="line"><a href="{{ config('add.info.line') }}" rel="noopener noreferrer" target="_blank" title="LINE@"><i class="fab fa-line"></i></a></li>
			</ul>

			@yield('footer_a')
		</div>

		<p class="footerP">営業時間：16:00～24:00（最終受付：23:00）定休日：年中無休</p>

		<ul class="clearF js-hover">
				<li><a href="{{ config('app.url') }}/">HOME</a></li>
				<li><a href="{{ config('app.url') }}/about/">ABOUT</a></li>
				<li><a href="{{ config('app.url') }}/news/">NEWS</a></li>
				<li><a href="{{ route('menu.show') }}">MENU</a></li>
				<li><a href="{{ route('reservation.show') }}">RESERVATION</a></li>
				<li><a href="{{ config('app.url') }}/netshop/">NETSHOP</a></li>
				<li><a href="{{ config('app.url') }}/recruit/">RECRUIT</a></li>
				<li><a href="{{ config('app.url') }}/therapist/">THERAPIST</a></li>
				<li><a href="{{ config('app.url') }}/privacy/">PRIVACY</a></li>
		</ul>

		<p class="footerSmall">
			<small>&copy; 2019-{{ $year }} {{ config('app.name') }} All Rights Reserved</small>
		</p>

	</footer>

</div>
<script src="{{ asset('js/common/common.js') }}"></script>
<script src="{{ asset('js/common/show.js') }}"></script>
@yield('footer_script')
</body>
</html>
