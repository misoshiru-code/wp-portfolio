document.addEventListener('DOMContentLoaded', () => { //DOMが読み込まれたら

    /*----------------------------------------
    テキスト分割(ローディングアニメーション用)
    ----------------------------------------*/

    class TextAnimation {
        constructor(el) {
            this.el = el instanceof HTMLElement ? el : document.querySelector(el); //ターゲット要素がHTML要素かチェック、そうでなければ取得
            this.chars = this.el.innerHTML.trim().split(""); //HTML要素を取得して前後の余白を削除し、配列化
            this.el.innerHTML = this._splitText();
        }
        _splitText() {
            return this.chars.reduce((acc, curr) => { //HTML要素に単一の文字列を出力
                curr = curr.replace(' ', '&nbsp;'); //半角スペース文字列を特殊文字に置換
                return `${acc}<span class="char">${curr}</span>` //1文字ずつspanタグに格納
            }, "");
        }
    }

    const ta = new TextAnimation('.js-loading-text'); //ローディングアニメーション用テキストの分割


    /*----------------------------------------
    ローディング処理
    ----------------------------------------*/

    class Loading {
        constructor() {
            this.DOM = {};
            this.DOM.loadAnime = document.querySelector('.js-loading-anime'); //ターゲット要素を取得
            this.DOM.loadBg = document.querySelector('.js-loading'); //サブターゲット要素を取得
            this._endLoading();
        }
        _endLoading() {
            return new Promise((resolve) => { //処理が完了したらコールバックするオブジェクト
                this.DOM.loadAnime.classList.add('hideAnime'); //ターゲット要素を隠すクラスを追加
                resolve(); //処理が完了したら値を返す
            })
                .then(() => { //Promiseがコールバックされたら実行される
                    setTimeout(() => this.DOM.loadBg.classList.add('hideBg'), 500); //0.5s後にサブターゲット要素を隠すクラスを追加
                });
        }
    }

    window.addEventListener('load', () => { //リソースの読み込みが完了したら
        const load = new Loading(); //ローディング処理
    })

    /*----------------------------------------
    innerHeightの自動取得（主にスマホ用）
    ----------------------------------------*/

    class SetHeight {
        constructor() {
            this.vh = window.innerHeight * 0.01; //ビューポート高さの1%(vh単位の値)を取得
            this.setFillHeight();
        }
        setFillHeight() {
            document.documentElement.style.setProperty('--vh', `${this.vh}px`); //CSSのカスタムプロパティに定義した変数を代入
        }
    }

    window.addEventListener('resize', () => { //ページサイズが変更されたら
        const sh = new SetHeight(); //innerHeightの自動取得（主にスマホ用）
    });

    /*----------------------------------------
    ヘッダーより下にスクロールした時ロゴに背景色
    ----------------------------------------*/

    class ChangeHeader {
        constructor() {
            this.DOM = {};
            this.DOM.header = document.querySelector('.js-header'); //ヘッダーの要素取得
            this.DOM.anchor = document.querySelectorAll('.js-header-logo>a, .js-header-logo>a>span, .js-headerNav-item>a, .js-headerNav-item>a>span'); //アンカータグの要素取得
            this.DOM.openBtn = document.querySelectorAll('.js-top, .js-middle, .js-bottom'); //トグルアイコンの要素取得
            this.DOM.heroBottom = document.getElementById('js-topMain').getBoundingClientRect().bottom; //ターゲット要素のボトム位置を取得
            this._changeColor();
        }
        _changeColor() {
            if (this.DOM.heroBottom < 0) { //ターゲット要素のボトムが0より小さくなったら
                this.DOM.header.classList.add("g-white"); //ヘッダーにクラス追加
                this.DOM.anchor.forEach((e) => e.classList.add('t-black')); //アンカータグにクラス追加
                this.DOM.openBtn.forEach((e) => e.classList.add('b-btn')); //トグルアイコンにクラス追加
            } else {
                this.DOM.header.classList.remove("g-white"); //ヘッダーのクラス削除
                this.DOM.anchor.forEach((e) => e.classList.remove('t-black')); //アンカータグのクラス削除
                this.DOM.openBtn.forEach((e) => e.classList.remove('b-btn')); //トグルアイコンのクラス削除
            };
        }
    }

    window.addEventListener("scroll", () => { //マウススクロールで発火
        const ch = new ChangeHeader(); //ヘッダーより下にスクロールした時ロゴに背景色
    });

    /*----------------------------------------
    ナビゲーションメニューの開閉
    ----------------------------------------*/

    class Navigation { //クラス名を定義
        constructor(obj) { //初期化
            this.DOM = {}; //オブジェクトを初期化
            this.DOM.openNav = document.querySelector(obj.hookName); //ターゲット要素の取得
            this.DOM.bgNav = document.querySelector(obj.subName); //サブターゲット要素の取得
            this.eventType = this._getEventType(); //イベントタイプを定義
            this._addEvent(); //イベントを実行
        }
        _getEventType() {
            return window.ontouchstart ? 'touchstart' : 'click'; //if分の省略型、タップかクリックを識別
        }
        _toggle() {
            this.DOM.openNav.classList.toggle('open'); //ターゲットにクラスをトグル
            this.DOM.bgNav.classList.toggle('open'); //サブターゲットにクラスをトグル
        }
        _addEvent() {
            this.DOM.openNav.addEventListener(this.eventType, this._toggle.bind(this)); //ターゲットをタップorクリックでトグル実行
            this.DOM.bgNav.addEventListener(this.eventType, this._toggle.bind(this)); //サブターゲットをタップorクリックでトグル実行
        }
    }

    const openNavigation = new Navigation({ //クラスの定義、実行
        hookName: '.js-openBtn', //ターゲット要素
        subName: '.js-bgNav' //サブターゲット要素(背景)
    });

    /*----------------------------------------
    指定要素から150pxスクロールしたら、下から上にフェードイン
    ----------------------------------------*/

    class fadeEl {
        constructor(obj) {
            this.el = document.querySelectorAll(obj); //フェードインさせる要素を取得
            this.func = this.fadeFunc();
        }
        fadeFunc() {
            for (var i = 0; i < this.el.length; i++) {//要素の数だけ繰り返し処理
                if (window.innerHeight > this.el[i].getBoundingClientRect().top + 100) { //対象要素の上端が画面内にオフセット距離分入ってきたら
                    this.el[i].classList.add('fadeUp'); //対象要素にクラス追加
                };
            }
        }
    }

    window.addEventListener("scroll", () => { //マウススクロールで発火
        const fe = new fadeEl('.fadeIn'); //対象要素が150pxウィンドウに入ったらフェードイン
    });

    /*----------------------------------------
    ページトップへ戻る
    ----------------------------------------*/

    class scrollTop {
        constructor(obj) {
            this.pageTop = document.querySelector(obj); //トップへ戻るボタン要素の取得
            this.scr();
        }
        scr() {
            this.pageTop.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            })
        }
    }

    const st = new scrollTop('.js-pageTop');

    /*----------------------------------------
    ページトップへ戻るボタンの出現
    ----------------------------------------*/

    class ptBtn {
        constructor(obj) {
            this.ptBtn = document.querySelector(obj.hookName); //トップへ戻るボタン要素の取得
            this.hHeight = window.innerHeight; //ウィンドウ内部の高さ取得
            this._addEvent();
        }
        _addEvent() {
            if (window.pageYOffset > this.hHeight * 2 / 3) { //マウススクロール位置がヒーロビュー高さの2/3以上になったら
                this.ptBtn.classList.add('showBtn'); //ボタン表示するクラスを追加
            } else {
                this.ptBtn.classList.remove('showBtn'); //ボタン表示するクラスを削除
            }
        }
    }

    window.addEventListener("scroll", () => { //マウススクロールで発火
        const pb = new ptBtn({ //指定要素までスクロールでページトップに戻るボタンの表示
            hookName: '.js-pageTop'
        })
    });

    /*----------------------------------------
    バルーンの表示
    ----------------------------------------*/

    class Balloon {
        constructor() {
            this.target = document.querySelectorAll('.js-readMore'); //ターゲット要素の取得
            this.balloon = document.querySelectorAll('.balloon'); //表示させる要素の取得
            this._addEvent();
        }
        _addEvent() {
            for (let i = 0; i < this.target.length; i++) { //ターゲット要素のループ処理
                for (let i = 0; i < this.balloon.length; i++) { //表示させる要素のループ処理

                    this.target[i].addEventListener('mouseenter', () => { //ターゲット要素にポインタが乗ったら
                        this.balloon[i].classList.add('js-showBln'); //フェードイン用クラスの追加
                        this.balloon[i].classList.remove('js-hideBln'); //フェードアウト用クラスの削除
                    }, false);

                    this.target[i].addEventListener('mouseleave', () => { //ターゲット要素がポインタから外れたら
                        this.balloon[i].classList.add('js-hideBln'); //フェードアウト用クラスの追加
                        this.balloon[i].classList.remove('js-showBln'); //フェードイン用クラスの削除
                    }, false);
                }
            }
        }
    }

    const bl = new Balloon();

    /*----------------------------------------
    カルーセルスライダー(swiper)
    ----------------------------------------*/

    class Slider {
        constructor(el) {
            this.el = el;
            this.wrapper = document.querySelector('.swiper-wrapper'); //wrapperを定義
            this.swiper = this._initSwiper(); //初期化
        }
        _initSwiper() {
            return new Swiper(this.el, {
                // Optional parameters
                // https://swiperjs.com/swiper-api
                loop: true, //スライドが最後に達したら先頭に戻る
                freeMode: true, //スライドが任意の位置で止まる
                loopedSlides: 5, //スライダーの複製を定義
                speed: 4000, //スライドのスピード(ミリ秒指定)
                autoplay: { //スライドの自動切り替え
                    delay: 0, //スライド間遷移の遅延時間(スムーズスライドの場合は0)
                    disableOnInteraction: false //ユーザーアクション後もスライドが止まらないようにする
                },
                // centeredSlides: true, //アクティブなスライドを中央に配置
                grabCursor: true, //カーソルが乗った時、グラブカーソルになる
                // effect: 'coverflow', //スライドのエフェクト 'slide(default)','fade','cube','coverflow','flip'
                slidesPerView: 1, //一度に表示するスライドの数
                on: {
                    slideChangeTransitionStart: () => { //次スライドorスライド開始された時に実行
                        this.wrapper.style.transitionTimingFunction = 'linear' //アニメーションをeaseからlinearに変更
                    }
                },
                breakpoints: { //ブレイクポイント
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    }
                }
            });
        }
    }

    const sl = new Slider('.swiper-container');

    /*----------------------------------------
    アコーディオン
    ----------------------------------------*/

    class Accordion { //クラス名を定義
        constructor(obj) { //初期化
            const menu = document.querySelector(obj.hookName); //ターゲットの親要素を取得
            const trigger = menu.getElementsByTagName(obj.tagName); //ターゲットとなるタグ名
            for (let i = 0; i < trigger.length; i++) { //タグ名の数だけループ処理
                trigger[i].addEventListener("click", (e) => this.toggle(e)); //ターゲットをクリックで発火
            }
        }
        toggle(e) {
            e.preventDefault();
            const target = e.currentTarget; //現在のターゲットを識別
            const content = target.nextElementSibling; //ターゲットの次要素を変数定義
            target.classList.toggle('is-active'); //ターゲットにクラスをトグル
            content.classList.toggle('is-open'); //ターゲットの次要素のクラスをトグル
        }
    }

    const openAccordion = new Accordion({ //クラスの定義、実行
        hookName: '.promise-list', //ターゲットの親要素
        tagName: 'h3' //ターゲットとなるタグ名
    });
});


/*----------------------------------------------------------------------*/

/*
//jQuery
jQuery(function ($) {

    //ローディング処理
    //読み込みが完了したら実行
    $(window).on('load', function () {
        // ローディングが10秒以内で終わる場合、読み込み完了後ローディング非表示
        endLoading();
    });

    //10秒経過した段階で、上記の処理を上書き、強制終了
    setTimeout('endLoading()', 10000);

    //ローディング非表示処理
    function endLoading() {
        // 0.8秒かけてロゴを非表示にし、その後1秒かけて背景を非表示にする
        $('.loading-circle').fadeOut(800, function () {
            $('.loading').fadeOut(1000);
        });
    }

    //ヘッダーより下にスクロールした時ロゴに背景色

     var header = $('.header'); //ヘッダーコンテンツ
     var anchor = $('.header-logo>a, .headerNav-item>a');
     var openBtn = $('.top, .middle, .bottom');
     var topViewHeight = $('.topMain').height();

    //初回処理、ページトップにいる場合、ヘッダーの背景色を消す

        // if ($(window).scrollTop() == 0) {
        //     linkBox.removeClass('bg-active');
        //     backLink.fadeOut(100);
        // }

     $(window).on('scroll', function () {
         if (!$('.topMain').length) {
             ;
         } else if (topViewHeight > jQuery(this).scrollTop()) {
             //スクロール位置が指定クラスより上にいるので、cssで指定した色のまま
             header.removeClass('g-white');
             anchor.removeClass('t-black');
             openBtn.removeClass('b-btn');
         } else {
             //指定位置より下までスクロールしたので、色を反転させる
             header.addClass('g-white');
             anchor.addClass('t-black');
             openBtn.addClass('b-btn');
         }
     });

    // メニューの開閉
    var duration = 1000;

    $('.openBtn').on('click', function () {
        $('.bgNav, .openBtn').toggleClass('open');

        if ($('.bgNav').hasClass('open')) {
            $('.bgNav').stop(true).animate({
                left: '0'
            }, duration, 'easeOutExpo');
        } else {
            $('.bgNav').stop(true).animate({
                left: '100%'
            }, duration, 'easeOutExpo');
        };
    });

    $('.globalNav-list a[href]').on('click', function (event) {
        $('.openBtn').trigger('click');
    });

    // 指定要素から150pxスクロールしたら、下から上にフェードイン
    $(window).scroll(function () {
        $('.fadeIn').each(function () {
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 150) {
                $(this).addClass('fadeUp');
            }
        });
    });

    //ページトップへのスクロール
    $('.pageTop').click(function () {
        //class名.page-topがクリックされたら、以下の処理を実行
        $("html,body").animate({ scrollTop: 0 }, "300"); //300ms
    });
    //ページトップの出現
    $('.pageTop').hide();
    $(window).scroll(function () {
        if ($(window).scrollTop() > 600) { //600px
            $('.pageTop').fadeIn(600); //600ms
        } else {
            $('.pageTop').fadeOut(600); //600ms
        }
    });

    //balloonの表示/非表示切り替え
    $('.readMore').hover(
        function () {
            $('.balloon').fadeIn();
        },
        function () {
            $('.balloon').fadeOut();
        }
    );

    // スライダー
    $('.works-wrapper').slick({
        dots: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 0,//自動的に動き出す待ち時間。初期値は3000ですが今回の見せ方では0
        speed: 5000,//スライドのスピード。初期値は300。
        infinite: true,//スライドをループさせるかどうか。初期値はtrue。
        pauseOnHover: false,//オンマウスでスライドを一時停止させるかどうか。初期値はtrue。
        pauseOnFocus: false,//フォーカスした際にスライドを一時停止させるかどうか。初期値はtrue。
        cssEase: 'linear',//動き方。初期値はeaseですが、スムースな動きで見せたいのでlinear
        slidesToShow: 3,//スライドを画面に3枚見せる
        slidesToScroll: 1,//1回のスライドで動かす要素数
        responsive: [{
            breakpoint: 1024,//tb画面の時、2枚表示
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 768,//SP画面の時、1枚表示
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    //アコーディオンをクリックした時の動作
    $('.accordion-title').on('click', function () {//タイトル要素をクリックしたら
        var findElm = $(this).next(".accordion-box");//直後のアコーディオンを行うエリアを取得し
        $(findElm).slideToggle();//アコーディオンの上下動作

        if ($(this).hasClass('close')) {//タイトル要素にクラス名closeがあれば
            $(this).removeClass('close');//クラス名を除去し
        } else {//それ以外は
            $(this).addClass('close');//クラス名closeを付与
        }
    });
});
*/