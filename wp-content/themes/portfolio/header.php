<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>西ノ谷コード</title>
    <?php wp_head(); ?>
</head>

<body id="top">
    <header class="header js-header">
        <div class="header-inner">
            <h1 class="header-logo js-header-logo"><a href="<?php echo home_url(); ?>"><span>portfolio</span></a></h1>
            <?php if (is_front_page()) : ?>
                <nav class="headerNav">
                    <ul class="headerNav-list">
                        <li class="headerNav-item js-headerNav-item"><a href="#top"><span>Home</span></a></li>
                        <li class="headerNav-item js-headerNav-item"><a href="#about"><span>About</span></a></li>
                        <li class="headerNav-item js-headerNav-item"><a href="#works"><span>Works</span></a></li>
                        <li class="headerNav-item js-headerNav-item"><a href="#skills"><span>Skills</span></a></li>
                        <li class="headerNav-item js-headerNav-item"><a href="#promise"><span>Promise</span></a></li>
                        <li class="headerNav-item js-headerNav-item"><a href="#contact"><span>Contact</span></a></li>
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
                            <li class="globalNav-item"><a href="#top">Home</a></li>
                            <li class="globalNav-item"><a href="#about">About</a></li>
                            <li class="globalNav-item"><a href="#works">Works</a></li>
                            <li class="globalNav-item"><a href="#skills">Skills</a></li>
                            <li class="globalNav-item"><a href="#promise">Promise</a></li>
                            <li class="globalNav-item"><a href="#contact">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- <div class="bgNav-aside">
                        <h2 class="bgNav-heading">portfolio</h2>
                    </div> -->
                </div>
            </div>
        </div>
    </header>