<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ポートフォリオ | 西ノ谷コード</title>
  <?php wp_head(); ?>
</head>

<body id="top">
  <header class="header js-header">
    <div class="header-inner">
      <h1 class="header-logo js-header-logo"><a href="<?php echo home_url(); ?>">Nishinoya-Code<span>西ノ谷コード</span></a></h1>
      <?php if (is_front_page()) : ?>

        <nav class="headerNav">
          <ul class="headerNav-list">
            <li class="headerNav-item js-headerNav-item"><a href="#about">About<span>私について</span></a></li>
            <li class="headerNav-item js-headerNav-item"><a href="#works">Works<span>制作例</span></a></li>
            <li class="headerNav-item js-headerNav-item"><a href="#skills">Skills<span>できること</span></a></li>
            <li class="headerNav-item js-headerNav-item"><a href="#price">Price<span>価格</span></a></li>
            <li class="headerNav-item js-headerNav-item"><a href="#promise">Promise<span>約束</span></a></li>
            <li class="headerNav-item js-headerNav-item"><a href="#contact">Contact<span>問い合わせ</span></a></li>
          </ul>
        </nav>

        <div class="openBtn js-openBtn">
          <span class="top js-top"></span>
          <span class="middle js-middle"></span>
          <span class="bottom js-bottom"></span>
        </div>
      <?php endif; ?>
      <div class="bgNav js-bgNav">
        <div class="bgNav-inner">
          <nav class="globalNav">
            <ul class="globalNav-list">
              <li class="globalNav-item"><a href="#top">Home<span>ホーム</span></a></li>
              <li class="globalNav-item"><a href="#about">About<span>私について</span></a></li>
              <li class="globalNav-item"><a href="#works">Works<span>実績</span></a></li>
              <li class="globalNav-item"><a href="#skills">Skills<span>スキル</span></a></li>
              <li class="globalNav-item"><a href="#promise">Promise<span>約束</span></a></li>
              <li class="globalNav-item"><a href="#contact">Contact<span>問い合わせ</span></a></li>
            </ul>
          </nav>
          <div class="bgNav-aside">
            <h2 class="bgNav-heading">portfolio</h2>
          </div>
        </div>
      </div>
    </div>
  </header>
