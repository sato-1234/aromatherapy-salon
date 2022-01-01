/*	------------------------------------------------
DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策（指定ドメインでないとJSなし）
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

				/*	画像削除確認
				---------------------------------------------------------	*/
				if( document.querySelector('.js-imgName') ){
						const imgSubmits = document.querySelectorAll('.js-delete');
						imgSubmits.forEach(imgSubmit => {
								imgSubmit.addEventListener('click', e => {
										if (confirm('選択画像を削除していいですか?')) {
												imgSubmit.parentNode.submit();
										}
										e.stopPropagation();
								});
						});
				}

		// }
});
