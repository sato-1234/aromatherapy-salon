/*	------------------------------------------------
jQuery用
------------------------------------------------	*/
jQuery(function($) {
		"use strict";

		/*	アンカーリンク,スムーズスクロールJQ(先頭に戻る含む＝全部)
		(サファリの場合JSでは逆走の実装難しいかつメンテ関係のため現状JQ使用。)
		---------------------------------------------------------	*/
		if(document.querySelectorAll('.js-pageLink')){
				$('.js-pageLink').click(function(){
						const speed = 500;
						let href= $(this).attr("href");
						let target = $(href == "#" || href == "" ? 'html' : href);
						let position = target.offset().top;
						$("html, body").animate({scrollTop:position}, speed, "swing");
						return false;
				});
		}

});

/*	------------------------------------------------
DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策
		// -- 本番で const IF コメント解除 -- //
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

				/*	header nav OPEN CLOSE
				---------------------------------------------------------	*/
				if ( document.getElementById('js-nav') ) {

						let nav = document.getElementById('js-nav');
						let button = document.getElementById('js-button');

						button.addEventListener('click',function(e){
								nav.classList.add('js-navOpen');
								e.stopPropagation();
						});

						document.addEventListener('click', (e) => {
								if( !e.target.closest('.js-navOpen') && nav.closest('.js-navOpen') ) {
										nav.classList.remove('js-navOpen');
								}
								e.stopPropagation();
						});

				}

		// }
});
