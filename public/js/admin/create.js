/*	------------------------------------------------
DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策（指定ドメインでないとJSなし）
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

				/*	管理ページの画像クリックでURLコピー(他ブラウザ検証必須)
				---------------------------------------------------------	*/
				if( document.querySelector('.js-imgName') ){

						const imgUl = document.getElementById('js-imgUl');

						imgUl.addEventListener('click', e => {
								if( e.target.classList.contains('js-imgName') ){
										let textCopy = e.target.getAttribute('data-id');

										document.addEventListener('copy', (e) => {
												e.preventDefault();
												e.clipboardData.setData('text/plain', textCopy);
										}, {once:true});
										document.execCommand('copy');

										alert('画像名をコピーしました。');
								}
								e.stopPropagation();
						});

				}

				/*	管理ページとキャンペーンMENU作成の画像リスト表示
				---------------------------------------------------------	*/
				if ( document.getElementById('js-imgListOpen') ) {

						let imgListOpen = document.getElementById('js-imgListOpen');
						let imgListClose = document.getElementById('js-imgListClose');
						let imgListBox = document.getElementById('js-imgListBox');

						imgListOpen.addEventListener('click',function(e){
								imgListBox.classList.add('js-imgListOpen');
								e.stopPropagation();
						});
						imgListClose.addEventListener('click',function(e){
								imgListBox.classList.remove('js-imgListOpen');
								e.stopPropagation();
						});
				}

		// }
});
