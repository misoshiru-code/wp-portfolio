<?php get_header(); ?>

<div class="loading">
    <div class="loading-circle">Loading...</div>
</div><!-- /loading -->

<div class="topMain">
    <div class="topMain-text">
        <p class="topMain-name">Nishinoya-engineeringあ</p>
    </div>
    <p class="scrollText">SCROLL</p>
    <div class="scrollGuide"><i></i></div>
    <video class="video" autoplay loop muted poster="<?php echo get_template_directory_uri(); ?>/img/posterImage.jpg">
        <source src="<?php echo get_template_directory_uri(); ?>/mov/top-movie.mp4" type="video/mp4">
        <img src="<?php echo get_template_directory_uri(); ?>/img/posterImage.jpg">
    </video>
</div><!-- /TopMain -->

<main class="main">
    <div class="pageTop">
        <i class="fas fa-chevron-up pageTop-size"></i>
    </div><!-- /pageTop -->

    <section class="about" id="about">
        <h2 class="about-heading fadeIn">About Me</h2>
        <p class="about-text fadeIn">静岡在住 1982生まれのWeb制作コーダーです。<br>
            独学でWeb制作を学び、個人でWebサイトの制作や<br>コーディングを行っています。</p>
        <p class="about-text fadeIn">これからは、保守性に優れたコーディングや<br>多くの検証による的確なサイト運営が<br>できるようになりたいと思います。</p>
        <div class="about-inner fadeIn">
            <ul class="about-list">
                <li><a href="#" target="_blank"><i class="fab fa-twitter twitter"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-facebook facebook"></i></a></li>
                <li><a href="#" target="_blank"><i class="fab fa-github github"></i></a></li>
            </ul>
        </div>
        <div class="linkBox fadeIn">
            <p class="readMore">Read More</p>
            <p class="balloon">Coming Soon</p>
        </div>
    </section><!-- /about -->

    <section class="works" id="works">
        <h2 class="works-heading fadeIn">Works</h2>
        <div class="works-wrapper fadeIn">
        <?php
            $args = array(
                'post_type' => 'post', // 投稿タイプのスラッグを指定
                'post_status' => 'publish', // 公開済の投稿を指定
                'posts_per_page' => 4 // 投稿件数の指定
            );  // 投稿タイプ
            $the_query = new WP_Query($args);
            if ($the_query->have_posts()) :
                ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="works-box" id="post-<?php the_ID(); ?>">
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
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p>このカテゴリーにはまだ1件も記事がありません</p>
            <?php endif; ?>
        </div>
        <div class="linkBox fadeIn">
            <p class="readMore">Read More</p>
            <p class="balloon">Coming Soon</p>
        </div>
    </section><!-- /works -->

    <section class="works" id="works">
        <h2 class="works-heading fadeIn">Works</h2>
        <div class="works-wrapper fadeIn">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="works-box" id="post-<?php the_ID(); ?>">
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
                <?php endwhile; ?>
            <?php else : ?>
                <p>このカテゴリーにはまだ1件も記事がありません</p>
            <?php endif; ?>
        </div>
        <div class="linkBox fadeIn">
            <p class="readMore">Read More</p>
            <p class="balloon">Coming Soon</p>
        </div>
    </section><!-- /works -->

    <section class="skills" id="skills">
        <h2 class="skills-heading fadeIn">Skills</h2>
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
            <p class="skills-text">Adobe XD/Affinity Photo/Git(Sourcetree)/GitHub</p>
        </div>
        <div class="linkBox fadeIn">
            <p class="readMore">Read More</p>
            <p class="balloon">Coming Soon</p>
        </div>
    </section>
   <!-- /skills --> 

    <section class="promise" id="promise">
        <h2 class="promise-heading fadeIn">PROMISE</h2>
        <div class="promise-wrapper fadeIn">
            <ul class="promise-list">
                <li class="promise-item">
                    <section class="accordion">
                        <h3 class="accordion-title">当たり前のことを当たり前に</h3>
                        <div class="accordion-box">
                            <p class="accordion-text">仕事の関係以前に、人対人の関係を大事にしたいと考えています。</p>
                            <p class="accordion-text">「あいさつ」「報連相」「納期遵守」、当たり前のことを当たり前に行います。</p>
                        </div>
                    </section>
                </li>
                <li class="promise-item">
                    <section class="accordion">
                        <h3 class="accordion-title">学ぶ姿勢を持ち続ける</h3>
                        <div class="accordion-box">
                            <p class="accordion-text">Web業界は変化の激しい世界だと常々感じています。</p>
                            <p class="accordion-text">色々なことにチャレンジし、技術をより突き詰めることでベストな対応を選択します。</p>
                        </div>
                    </section>
                </li>
                <li class="promise-item">
                    <section class="accordion">
                        <h3 class="accordion-title">事前テストで品質を確保</h3>
                        <div class="accordion-box">
                            <p class="accordion-text">ものづくりにおいて、品質管理は必須と考えています。</p>
                            <p class="accordion-text">制作物に対して事前テストを行うことで、品質を確保します。</p>
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
        <h2 class="contact-heading fadeIn">Contact</h2>
        <?php echo apply_filters('the_content', '[contact-form-7 id="9" title="お問い合わせフォーム"]'); ?>
        <!-- <form class="contact-form fadeIn" action="index.html" method="post">
        <input class="input-name" type="text" name="name" placeholder="Name">
        <textarea class="input-text" name="message" placeholder="Message"></textarea>
        <input class="input-btn" type="submit" name="" value="Send">
    </form> -->
    </section><!-- /contact -->

</main>
<?php get_footer(); ?>