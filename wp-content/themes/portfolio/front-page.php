<?php get_header(); ?>

<div class="loading js-loading">
    <div class="loading-anime js-loading-anime">
        <div class="loading-circle"></div>
        <div class="loading-text js-loading-text">Now Loading</div>
    </div>
</div><!-- /loading -->

<div class="topMain js-topMain" id="js-topMain">
    <div class="topMain-text">
        <p class="topMain-name">Portfolio</p>
    </div>
    <p class="scrollText">SCROLL</p>
    <div class="scrollGuide"><i></i></div>
    <video class="video" playsinline autoplay loop muted poster="<?php echo get_template_directory_uri(); ?>/img/posterImage.jpg">
        <source src="<?php echo get_template_directory_uri(); ?>/mov/top-movie.mov" type="video/mp4">
        <img src="<?php echo get_template_directory_uri(); ?>/img/posterImage.jpg">
    </video>
    <div class="topMain-box"></div>
</div><!-- /TopMain -->

<main class="main">
    <div class="pageTop js-pageTop">
        <i class="fas fa-chevron-up pageTop-size"></i>
    </div><!-- /pageTop -->
    <section class="about" id="about">
        <h2 class="about-heading fadeIn">About Me<span>私について</span></h2>
        <h3 class="about-name fadeIn">屋号：西ノ谷コード</h3>
        <p class="about-text fadeIn">静岡在住 1982生まれのWebコーダーです。<br>
            独学でWeb制作を学び、個人でWebサイトの制作や<br>Web制作会社のコーダー(パートナー)として活動しています。</p>
        <p class="about-text fadeIn">デザインを忠実に再現しつつ<br>保守性を意識したコーディングを心がけています。</p>
        <div class="about-inner fadeIn">
            <ul class="about-list">
                <li class="about-item"><a href="https://nishinoya-code.com/" target="_blank"><i class="fas fa-blog blog"></i><span>Blog</span></a></li>
                <li class="about-item"><a href="https://codepen.io/nishinoya-code" target="_blank"><i class="fab fa-codepen codepen"></i><span>CodePen</span></a></li>
                <li class="about-item"><a href="https://github.com/nishinoya-code" target="_blank"><i class="fab fa-github github"></i><span>GitHub</span></a></li>
                <li class="about-item"><a href="https://twitter.com/nishinoya_eng" target="_blank"><i class="fab fa-twitter twitter"></i><span>Twitter</span></a></li>
            </ul>
        </div>
        <!-- <div class="linkBox fadeIn">
            <p class="readMore js-readMore">Read More</p>
            <p class="balloon">Coming Soon</p>
        </div> -->
    </section><!-- /about -->

    <section class="works" id="works">
        <h2 class="works-heading fadeIn">Works<span>制作例</span></h2>
        <div class="swiper-container">
            <div class="works-wrapper swiper-wrapper">
                <?php
                $args = array(
                    'posts_per_page' => 5 // 表示件数の指定
                );
                $posts = get_posts($args);
                foreach ($posts as $post) : // ループの開始
                    setup_postdata($post); // 記事データの取得
                ?>
                    <div class="works-box swiper-slide" id="post-<?php the_ID(); ?>">
                        <a href="<?php the_permalink(); ?>">
                            <div class="works-img">
                                <div class="works-eff">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
                                </div>
                            </div>
                        </a>
                        <div class="works-descOuter">
                            <h3 class="works-descHeading"><?php the_title(); ?></h3>
                            <div class="works-desc"><?php the_field('言語'); ?></div>
                            <div class="works-desc"><?php the_content(); ?></div>
                        </div>
                    </div>
                <?php
                endforeach; // ループの終了
                wp_reset_postdata(); // 直前のクエリを復元する
                ?>
            </div>
        </div>
        <div class="linkBox fadeIn">
            <a class="readMore" href="<?php echo home_url('/works'); ?>">Read More</a>
            <!-- <p class="balloon">Coming Soon</p> -->
        </div>
    </section><!-- /works -->

    <section class="skills" id="skills">
        <h2 class="skills-heading fadeIn">Skills<span>できること</span></h2>
        <div class="skills-wrapper fadeIn">
            <?php
            $args = array(
                'post_type' => 'skills', // 投稿タイプのスラッグを指定
                'post_status' => 'publish', // 公開済の投稿を指定
                'posts_per_page' => 4 // 投稿件数の指定
            );  // カスタム投稿タイプ skills
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) :
            ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" class="skills-box">
                        <?php the_field('アイコン'); ?>
                        <h3 class="skills-title"><?php the_title(); ?></h3>
                        <div class="skills-desc"><?php the_content(); ?></div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p>このカテゴリーにはまだ1件も記事がありません</p>
            <?php endif; ?>
        </div>
        <div class="skills-textBox fadeIn">
            <h4 class="skills-textHeading">Other Skills</h4>
            <p class="skills-text">Adobe/Affinity/Git(GitHub)</p>
        </div>
        <!-- <div class="linkBox fadeIn">
            <p class="readMore js-readMore">Read More</p>
            <p class="balloon">Coming Soon</p>
        </div> -->
    </section><!-- /skills -->

    <section class="price" id="price">
        <h2 class="price-heading fadeIn">Price<span>価格</span></h2>
        <div class="price-inner">
            <h3 class="price-title fadeIn">コーディング費用</h3>
            <table class="price-table fadeIn">
                <tbody>
                    <tr>
                        <th>トップページ</th>
                        <td>¥20,000~</td>
                    </tr>
                    <tr>
                        <th>下層ページ</th>
                        <td>¥10,000~</td>
                    </tr>
                    <tr>
                        <th>ランディング<span>ページ</span></th>
                        <td>¥30,000~</td>
                    </tr>
                    <tr>
                        <th>WordPress化</th>
                        <td>¥50,000~</td>
                    </tr>
                </tbody>
            </table>
            <p class="price-text fadeIn">※上記価格は目安です。詳細はお問い合わせ時にご確認ください。</p>
        </div><!-- /.price-inner -->
    </section><!-- /price -->

    <section class="promise" id="promise">
        <h2 class="promise-heading fadeIn">PROMISE<span>約束</span></h2>
        <div class="promise-wrapper fadeIn">
            <ul class="promise-list">
                <li class="promise-item">
                    <section class="accordion">
                        <h3 class="accordion-title js-menu">当たり前のことを当たり前に</h3>
                        <div class="accordion-box">
                            <p class="accordion-text">仕事の関係以前に、人対人の関係を大事にしたいと考えています。<br>
                                「あいさつ」「報連相」「納期遵守」、当たり前のことを当たり前に行います。</p>
                        </div>
                    </section>
                </li>
                <li class="promise-item">
                    <section class="accordion">
                        <h3 class="accordion-title js-menu">学ぶ姿勢を持ち続ける</h3>
                        <div class="accordion-box">
                            <p class="accordion-text">Web業界は変化の激しい世界だと常々感じています。<br>色々なことにチャレンジし、技術をより突き詰めることでベストな対応を選択します。</p>
                        </div>
                    </section>
                </li>
                <li class="promise-item">
                    <section class="accordion">
                        <h3 class="accordion-title js-menu">事前テストで品質を確保</h3>
                        <div class="accordion-box">
                            <p class="accordion-text">ものづくりにおいて、品質管理は必須と考えています。<br>制作物に対して事前テストを行うことで、品質を確保します。</p>
                        </div>
                    </section>
                </li>
            </ul>
        </div>
    </section>
    <!-- /promise -->

    <section class="contact" id="contact">
        <div class="bgSection">
            <div class="bgSection-inner"></div>
        </div>
        <h2 class="contact-heading fadeIn">Contact<span>問い合わせ</span></h2>
        <?php echo apply_filters('the_content', '[contact-form-7 id="9" title="お問い合わせフォーム"]'); ?>
    </section><!-- /contact -->

</main>
<?php get_footer(); ?>
