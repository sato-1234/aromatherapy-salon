<div class="UnderImg">
	<h2 class="mintyo"><span>{{ $titleEn }}</span><span>{{ $titleJa }}</span></h2>
	<div class="UnderImgDiv clearF">
		<ul class="js-hover">
			<li><a href="{{ config('app.url') }}/"></a></li>
			@if ($titleEn !== 'MENU')
			<li><a href="{{ config('app.url') }}/menu/">メニュー</a></li>
			@endif
			<li>{{ $titleJa }}</li>
		</ul>
	</div>
	<img src="{{ asset('img/menu/' . $url) }}" alt="">
</div>
