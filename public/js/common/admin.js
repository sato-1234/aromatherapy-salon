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

				/*	POST(投稿と下書き)削除JS
				---------------------------------------------------------	*/
				if( document.getElementById('js-postUl') ){
						const postUl = document.getElementById('js-postUl');
						postUl.addEventListener('click', e => {
								if( e.target.classList.contains('js-postA') ){
										e.preventDefault();
										if (confirm('選択した投稿を削除していいですか?')) {
												document.getElementById('js-delete' + e.target.dataset.id).submit();
										}
								}
								e.stopPropagation();
						});
				}

				if( document.getElementById('js-postUl2') ){
						const postUl2 = document.getElementById('js-postUl2');
						postUl2.addEventListener('click', e => {
								if( e.target.classList.contains('js-postA') ){
										e.preventDefault();
										if (confirm('選択した下書きを削除していいですか?')) {
												document.getElementById('js-delete2' + e.target.dataset.id).submit();
										}
								}
								e.stopPropagation();
						});
				}

				/*	POST(投稿)表示と非表示設定JS
				---------------------------------------------------------	*/
				if( document.getElementById('js-postUl') ){
						const postUl = document.getElementById('js-postUl');
						postUl.addEventListener('click', e => {
								if( e.target.classList.contains('js-postB') ){
										e.preventDefault();
										document.getElementById('js-display' + e.target.dataset.id).submit();
								}
								e.stopPropagation();
						});
				}

				/*	予約メニューページの画像クリックでURLコピー(他ブラウザ検証必須)
				---------------------------------------------------------	*/
				if( document.querySelector('.js-imgName') ){

						const imgUl = document.getElementById('js-imgUl');

						imgUl.addEventListener('click', e => {
								if( e.target.classList.contains('js-imgName') ){
										let textCopy = e.target.getAttribute('src');

										document.addEventListener('copy', (e) => {
												e.preventDefault();
												e.clipboardData.setData('text/plain', textCopy);
										}, {once:true});
										document.execCommand('copy');

										alert('画像URLをコピーしました。');
								}
								e.stopPropagation();
						});

				}

				/*	予約ページの画像リスト表示
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

				/*	予約メニュー削除JS
				---------------------------------------------------------	*/
				if( document.getElementById('js-deleteAll') ){
						const deleteAll = document.getElementById('js-deleteAll');
						deleteAll.addEventListener('click', e => {
								if( e.target.classList.contains('deleteMenu') ){
										e.preventDefault();
										if (confirm('選択したメニューを削除していいですか?')) {
												document.getElementById('js-delete' + e.target.dataset.id).submit();
										}
								}
								e.stopPropagation();
						});
				}

		// }
});
