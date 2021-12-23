@if ( isset($categoryBasicMenus) )
	<div class="aromaBox4">

		<h3 class="mintyo aromaH3"><span>{{ $titleEn }}</span><span>{{ $titleJa }}料金</span></h3>
		<table>
			<tbody>

				@foreach ($categoryBasicMenus as $key => $basicMeuns)
				<tr><th  class="mintyo" colspan="3">{{ $key }}</th></tr>
					@foreach ($basicMeuns as $post)
					<tr>
						<td><span>{{ $post['time_required'] }}分</span></td>
						<td>
							<p>
								<span>{{ $post['title'] }}</span>
								<span>{{ $post['body'] }}</span>
							</p>
						</td>
						<td><span>¥{{ $post['price'] }}</span></td>
					</tr>
					@endforeach
				@endforeach

			</tbody>
		</table>

		<ul>
			@if ( $titleJa === 'アロマトリートメント' )
				<li>※お客様のお好みに応じた強さで施術させて頂きます。</li>
				<li class="liTwo">※お客様専用のオリジナルコースもお作りできます。<br/>
					（お疲れの部分に合わせたメニューの組み合わせや時間配分など）</li>
				<li>※時間延長できます。（延長料金　1,260円／10分）</li>
			@elseif ( $titleJa === 'ローズコース' || $titleJa === '金箔トリートメント')
				<li>※お客様のお好みに応じた強さで施術させて頂きます。</li>
				<li class="liTwo">※お客様専用のオリジナルコースもお作りできます。<br>
					（お疲れの部分に合わせたメニューの組み合わせや時間配分など）</li>
				<li>※医療行為ではありません。</li>
			@elseif ( $titleJa === 'フットケア' || $titleJa === 'その他メニュー')
				<li>※アロマオイルの使用ご希望の方はプラス300円になります。</li>
				<li>※お客様のお好みに応じた強さで施術させて頂きます。</li>
				<li class="liTwo">※お客様専用のオリジナルコースもお作りできます。<br>
					（お疲れの部分に合わせたメニューの組み合わせや時間配分など）</li>
				<li>※時間延長できます。（延長料金 1,260円／10分）</li>
				<li>※医療行為ではありません。</li>
			@elseif ( $titleJa === 'ヘッドケア' )
				<li>※お客様のお好みに応じた強さで施術させて頂きます。</li>
				<li class="liTwo">※お客様専用のオリジナルコースもお作りできます。<br/>
					（お疲れの部分に合わせたメニューの組み合わせや時間配分など）</li>
				<li>※時間延長できます。（延長料金　1,260円／10分）</li>
				<li>※医療行為ではありません。</li>
			@elseif ( $titleJa === '耳ツボマッサージ' )
				<li>※お試しコースには以下の4つのコースがあります。<ul>
						<li>疲労回復コース（ストレス・疲れ目・肩こり・腰痛・不眠）</li>
						<li>ダイエットコース（イライラの解消・食欲抑制・新陳代謝の促進）</li>
						<li>お顔スッキリコース（リフトアップ・美顔・小顔・しっとりプルプル）</li>
						<li>女子力UPコース（キレイを維持・冷え・美顔・便秘）</li>
					</ul>
				</li>
				<li>※施術後、御希望に応じて耳ツボシール（1枚 30円～）をお貼りすることも出来ます。</li>
				<li>※医療行為ではありません。</li>
			@elseif ( $titleJa === '矯正メニュー' )
				<li>※医療行為ではありません。</li>
			@endif
		</ul>

	</div>
@endif
