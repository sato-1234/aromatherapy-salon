<div class="menuList">
	<p class="mintyo">{{ $p_title }}</p>

	<form method="POST" action="{{ route('admin.orderUpdate') }}">
		@csrf
		<input type="hidden" id="log{{$i}}" name="order_update" type="text">
		<input type="submit" name="up" value="順番更新">
	</form>

	<ul id="sortable{{$i}}">
		@foreach ($posts as $post)
		<li class="clearF {{ ($edit === 'Campaign') ? 'sort' : '' }}" id="{{ $post['id'] }}">

			@if($edit === 'Campaign')
			<img class="sortImg" src="{{ asset('storage/img/reservation_set/' . $post['img']) }}" alt="">
			<div class="sortDiv">
				<span>有効期限：{{ $post['expiration_date'] }}</span>
			@endif

				<span class="{{ ($edit === 'Basic') ? 'menuListPrice' : '' }}">料金：{{ $post['price'] }}円</span>
				<span>所要時間：{{ $post['time_required'] }}分</span>

				<h3>{{ $post['title'] }}</h3>
				<div class="clearF">
					<form method="GET" action="{{ route('admin.edit' . $edit, ['id' => $post['id'] ]) }}">
						@csrf
						<input type="submit" value="編集">
					</form>
					<form id="js-delete{{ $post['id'] }}" method="POST" action="{{ route('admin.destroy', ['id' => $post['id'] ]) }}">
						@csrf
						<input data-id="{{ $post['id'] }}" class="deleteMenu" type="submit" value="削除">
					</form>
				</div>

			@if($edit === 'Campaign')
			</div>
			@endif

		</li>
		@endforeach
	</ul>
</div>
