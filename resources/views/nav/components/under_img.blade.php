<div class="UnderImg">
	<h2 class="mintyo"><span>{{ $titleEn }}</span><span>{{ $titleJa }}</span></h2>
	<div class="UnderImgDiv clearF">
		<ul class="js-hover">
			<li><a href="{{ config('app.url') }}/"></a></li>
			@if ( url()->current() !== config('app.url') )
			<li>{{ $titleJa }}</li>
			@endif
		</ul>
	</div>
	@if ( url()->current() === config('app.url') )
	<img src="{{ asset('img/nav/top/top.jpg') }}" alt="">
	@else
	<img src="{{ asset('img/nav/' . $url) }}" alt="">
	@endif
</div>
