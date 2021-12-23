/*	------------------------------------------------
/reservationページ：DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策
		// -- 本番で const IF コメント解除 -- //
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

				/*	予約ページの地図表示
				---------------------------------------------------------	*/
				// if ( document.getElementById('js-parkingOpen') ) {

				// 		let parkingOpen = document.getElementById('js-parkingOpen');
				// 		let parkingClose = document.getElementById('js-parkingClose');
				// 		let parkingBox = document.getElementById('js-parkingBox');

				// 		parkingOpen.addEventListener('click',function(e){
				// 				parkingBox.classList.add('js-parkingOpen');
				// 				e.stopPropagation();
				// 		});
				// 		parkingClose.addEventListener('click',function(e){
				// 				parkingBox.classList.remove('js-parkingOpen');
				// 				e.stopPropagation();
				// 		});
				// }

				/*	予約ページの日時時間カスタマイズ
				---------------------------------------------------------	*/
				if( document.getElementById('js-calendar') ){
						const d = new Date();
						const time = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + (d.getDate() + 1);
						flatpickr.localize(flatpickr.l10ns.ja);
						flatpickr('#js-calendar', {
								dateFormat: "Y-m-d",
								//minDate: new Date().setHours(new Date().getHours() + 24),
								minDate: time,
						});
				}

				if( document.getElementById('js-time') ){

						flatpickr.localize(flatpickr.l10ns.ja);
						flatpickr('#js-time', {
								noCalendar: true,
								enableTime: true,
								dateFormat: "H:i",
								minDate: "16:00", // 時間の下限
								maxDate: "23:00", // 時間の上限
						});
				}

		// }
});
