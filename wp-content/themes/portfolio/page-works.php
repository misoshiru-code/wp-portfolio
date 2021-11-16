<?php get_header(); ?>

<div class="loading js-loading">
    <div class="loading-anime js-loading-anime">
        <div class="loading-circle"></div>
        <div class="loading-text js-loading-text">Now Loading</div>
    </div>
</div><!--loading-->

<main class="main">

    <div class="pageTop js-pageTop">
        <i class="fas fa-chevron-up pageTop-size"></i>
    </div><!--pageTop-->

    <section class="pageWorks">
        <h2 class="pageWorks-heading">Works<span>制作例</span></h2>
        <div class="pageWorks-wrapper">
            <?php
            $args = array(
                'posts_per_page' => 50 // 表示件数の指定
            );
            $posts = get_posts($args);
            foreach ($posts as $post) : // ループの開始
                setup_postdata($post); // 記事データの取得
            ?>
                <div class="pageWorks-box" id="post-<?php the_ID(); ?>">
                    <a href="<?php the_permalink(); ?>">
                        <div class="pageWorks-img">
                            <div class="pageWorks-eff">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
                            </div>
                        </div>
                    </a>
                    <div class="pageWorks-descOuter">
                        <h3 class="pageWorks-descHeading"><?php the_title(); ?></h3>
                        <div class="pageWorks-desc"><?php the_field('言語'); ?></div>
                        <div class="pageWorks-desc"><?php the_content(); ?></div>
                    </div>
                </div>
            <?php
            endforeach; // ループの終了
            wp_reset_postdata(); // 直前のクエリを復元する
            ?>
        </div>
        <div class="linkBox">
            <a class="readMore" href="<?php echo home_url(); ?>">Back to Top</a>
        </div>
    </section><!-- /works -->

    <div class="bgSection">
        <div class="bgSection-inner"></div>
    </div>

</main>
<?php get_footer(); ?>
