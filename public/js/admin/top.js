/*	------------------------------------------------
jQuery用
------------------------------------------------	*/
jQuery(function($) {
		"use strict";

		/*	順番変更のためJQ
		---------------------------------------------------------	*/
		if( document.querySelector('.menuList') ){
			let num = document.querySelectorAll('.menuList').length;
			for(let $i = 1; $i <= num; $i++){
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

/*	------------------------------------------------
DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";

		//JSによるオープンリダイレクタ対策（指定ドメインでないとJSなし）
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {

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
