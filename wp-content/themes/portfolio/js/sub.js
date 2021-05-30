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
});