<div id="js-imgListBox" class="imgListBox">
	<div>
		<span id="js-imgListClose"></span>
		<ul class="js-hover" id="js-imgUl">
		@if(isset($imgs))
		@foreach ($imgs as $post)
			<li>
				@if( isset($post['type']) )
					<span class="category">{{ $post['type'] }}</span>
				@endif
				<img data-id="{{ $post['url'] }}" class="js-imgName js-hover js-ObjectFitCover" src="{{ asset('storage/img/reservation_set/' . $post['url']) }}" alt="">
			</li>
		@endforeach
		@else
			<li>保存画像なし</li>
		@endif
		</ul>
	</div>
</div>
