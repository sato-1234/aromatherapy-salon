/*	------------------------------------------------
jQuery用
------------------------------------------------	*/
jQuery(function($) {
		"use strict";

		/*	順番変更のためJQ
		---------------------------------------------------------	*/
		for(let $i = 1; $i <= 8; $i++){
				if( document.querySelector('#sortable' + $i) ){
						$('#sortable' + $i).sortable({
								cursor: "move",
								placeholder: "ph1",
								// updateで並べ替えるたびに更新
								update: function(){
									// toArrayで現在の順番を取得しinputのvalue出力
									$("#log" + $i).attr('value', $('#sortable' + $i).sortable("toArray"));
								}
						});
				}
		}

});

"use strict";
//JSによるオープンリダイレクタ対策（指定ドメインでないとJSなし）
const url = new URL(location.href);
//if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

		//タブレットかつ1020以下のときは昔のviewport(タブレットだからwindow.screen.availWidth)
		if( (
				navigator.userAgent.indexOf('iPad') > 0 ||
				navigator.userAgent.indexOf('Android') > 0
				) &&
				document.head.querySelector("[name=viewport]") &&
				window.matchMedia('(max-width: 1020px)').matches &&
				window.screen.availWidth <= 1020)
		{
			let viewport = document.head.querySelector("[name=viewport]");
			viewport.setAttribute("content", "width=1020,user-scalable=no");
		}

//}
