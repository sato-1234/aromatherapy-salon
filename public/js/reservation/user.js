/*	------------------------------------------------
/reservationページ：DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策
		// -- 本番で const if コメント解除 -- //
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

				// 2重送信対策
				if(document.getElementById('submitComplete')){
						const formID = document.getElementById('submitComplete');
						const submit = document.querySelector('#submitComplete input[type="submit"]');
						formID.addEventListener('submit', function(){
								submit.disabled = true;
								submit.classList.add('disabled');
								submit.classList.remove('js-hoverCss');
								submit.value = '送信中･･･';
						}, false);
				}

		// }
});
