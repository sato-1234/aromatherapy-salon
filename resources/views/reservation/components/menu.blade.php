<ul>
@foreach ($posts as $post)
<li class="clearF">
	<img class="js-ObjectFitCover" src="{{ asset('storage/img/reservation_set/' . $post['img']) }}" alt="{{ $post['title'] }}">
	<div>
		<h4>{{ $post['title'] }}</h4>
		<p>
		@php
			$categorys = explode(',', $post['category']);
		@endphp
		@foreach ($categorys as $value)
			<span>{{ $value }}</span>
		@endforeach
		</p>
		<p>
			<span><span>所要時間</span>：{{ $post['time_required'] }}分</span>
			<span><span>料金</span>：{{ $post['price'] }}円</span>
			<span><span>有効期限</span>：{{ $post['expiration_date'] }}まで</span>
		</p>
		<p>{{ $post['body'] }}</p>
		<form class="js-hover" method="POST" action="{{ route('reservation.choicePost') }}">
			@csrf
			<input type="number" name="id" value="{{ $post['id'] }}">
			<input class="new" type="submit" name="new" value="ご予約">
		</form>
	</div>
</li>
@endforeach
</ul>
