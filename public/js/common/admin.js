/*	------------------------------------------------
DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策（指定ドメインでないとJSなし）
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

				/*	header nav OPEN CLOSE
				---------------------------------------------------------	*/
				if ( document.getElementById('js-nav') ) {

						let nav = document.getElementById('js-nav');
						let button = document.getElementById('js-button');
						let close = document.getElementById('js-close');

						button.addEventListener('click',function(e){
								if( !nav.closest('.js-navOpen') ) {
										nav.classList.add('js-navOpen');
								}
								e.stopPropagation();
						});

						close.addEventListener('click',function(e){
								if( nav.closest('.js-navOpen') ) {
										nav.classList.remove('js-navOpen');
								}
								e.stopPropagation();
						});

				}

				/*	管理ページログアウトJS
				---------------------------------------------------------	*/
				if( document.getElementById('js-logoutButton') ){
						document.getElementById('js-logoutButton').onclick = function(e){
								e.preventDefault();
								document.getElementById('js-logoutForm').submit();
						}
				}

		// }
});
