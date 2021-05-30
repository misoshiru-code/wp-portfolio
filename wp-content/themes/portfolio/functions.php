<?php

// Adding Theme Support

function addMyInit()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support(
        'html5',
        array('comment-list', 'comment-form', 'search-form')
    );
}

add_action('after_setup_theme', 'addMyInit');

// adding the CSS and JS files

function addMyFiles()
{
    wp_register_style('google-fonts', '//fonts.googleapis.com/css2?family=Alata&display=swap');
    wp_register_style('fontawesome', '//use.fontawesome.com/releases/v5.15.3/css/all.css');
    wp_register_style('reset', '//cdn.jsdelivr.net/gh/krishdevdb/reseter.css/css/reseter.min.css');
    wp_register_style('swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.min.css');
    wp_enqueue_style('css', get_template_directory_uri() . '/custom-css/custom-style.css', array('google-fonts', 'fontawesome', 'reset', 'swiper'), '1.0.0', 'all');

    if (is_front_page()) {
        wp_register_script('swiper', '//cdnjs.cloudflare.com/ajax/libs/Swiper/6.5.8/swiper-bundle.min.js');
        wp_enqueue_script('js-main', get_template_directory_uri() . '/js/main.js', array('swiper'), '1.0.0', true);
    } else {
        wp_enqueue_script('js-sub', get_template_directory_uri() . '/js/sub.js', array(), '1.0.0', true);
    }
}

add_action('wp_enqueue_scripts', 'addMyFiles');

/**
 * WP-SCSS：ページをロードするたびにscssファイルを強制的にコンパイル.
 */
define('WP_SCSS_ALWAYS_RECOMPILE', true);
/* ================================================================================ */


add_action('init', function () {
    register_post_type('skills', [ //パラメータ
        'label' => 'スキル', //ラベル名
        'public' => true, // 公開
        'menu_position' => 5, //投稿の下に表示
        'menu_icon' => 'dashicons-universal-access',
        'supports' => ['thumbnail', 'title', 'editor']
    ]);
});