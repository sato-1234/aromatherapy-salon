/*  ----------- 禁止JS---------------------
0、「インラインJS記述」
1、「location.href」：new URLのオブジェクトの使用は必須
2、「document.write」
3、「eval」
4、「innerHTML」（「innerText」　と　「textContent」と「document.createTextNode」ならまだ良い）
		const text = document.createTextNode(
			'テキスト作成'
		);
		document.body.appendChild( text );
5、 new XMLHttpRequest();を使用する場合は：参考URLを必ず読む
---------------------  */

/*	------------------------------------------------
DOM読み込む後用
------------------------------------------------	*/
document.addEventListener('DOMContentLoaded', function() {
		"use strict";


		//JSによるオープンリダイレクタ対策
		// -- 本番で const IF コメント解除 -- //
		// const url = new URL(location.href);
		// if( url.origin === "https://ドメイン" && url.protocol.match(/^https?:/) ) {


				//共通変数
				let uAg = window.navigator.userAgent.toLowerCase();
				let nameRegexp = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i;
				let jsBody = document.getElementById('body');
				let jsContents = document.querySelector('.contents');


				/*	OSとブラウザ判定して「適用CSS付与」
				---------------------------------------------------------	*/
				// bodyに「js_OS名」クラス付与
				if(uAg.indexOf("windows nt") !== -1) {

						jsBody.classList.add('js-windows');

				} else if(uAg.indexOf("android") !== -1) {

						jsBody.classList.add('js-android');

				} else if(uAg.indexOf("iphone") !== -1 || uAg.indexOf("ipad") !== -1) {

						jsBody.classList.add('js-ios');

				} else if(uAg.indexOf("mac os x") !== -1) {

						jsBody.classList.add('js-mac');

				}

				// .contentsに「js_ブラウザ名」クラス付与
				if( uAg.indexOf('msie') != -1 || uAg.indexOf('trident') != -1) {

						jsContents.classList.add('js-ie');

				} else if(uAg.indexOf('edge') != -1) {

						jsContents.classList.add('js-edge');

				} else if(uAg.indexOf('edg') != -1) {
						//edgeの新バージョン（クローム版）
						jsContents.classList.add('js-edg');

				} else if(uAg.indexOf('chrome') != -1) {

						jsContents.classList.add('js-chrome');

				} else if(uAg.indexOf('safari') != -1) {

						jsContents.classList.add('js-safari');

				} else if(uAg.indexOf('firefox') != -1) {

						jsContents.classList.add('js-firefox');

				} else if(uAg.indexOf('opera') != -1) {

						jsContents.classList.add('js-opera');

				}


				/*	Androidのときの「部分に明朝対策」「グーグルフォントも必須」
				---------------------------------------------------------	*/
				if( (document.querySelector('.mintyo')) && (uAg.indexOf('android') != -1) ){

						let androidMintyo = document.querySelectorAll('.mintyo');
						let androidMintyoLength = androidMintyo.length;

						for(let i = 0; androidMintyoLength > i; i++){
								androidMintyo[i].classList.add('js-androidMintyo');
						}
				}


				/*	Android綺麗なゴッシク対策「グーグルフォント必須」
				---------------------------------------------------------	*/
				if ( (jsBody) && (uAg.indexOf('android') != -1) ) {
						jsBody.classList.add('js-androidGothic');
				}


				/*	hoverに必要なアニメショーンで、読み込む時のエラー対策
				---------------------------------------------------------	*/
				setTimeout(function () {
						jsBody.classList.add('js-trans');
				}, 300);


				/*	PCのみjs-hoverにjs-hoverCssをつける
				---------------------------------------------------------	*/
				if ( (document.querySelector('.js-hover')) && !(window.navigator.userAgent.search(nameRegexp) !== -1) ) {

						let hoverPcs = document.querySelectorAll('.js-hover');
						let hoverPcsLength = hoverPcs.length;

						for (let i = 0; hoverPcsLength > i; i++) {
								hoverPcs[i].classList.add('js-hoverCss');
						}
				}


				/*	ブラウザがIEとエッジのときでもCSS「object-fit: cover;」（自動トリミング）適用させる
				---------------------------------------------------------	*/
				// if ( document.querySelector('.js-ObjectFitCover') ) {
				// 		objectFitImages('.js-ObjectFitCover');
				// }

		// }
});
