<?php

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_setup() {

    load_theme_textdomain('cusbro');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('custom-logo',[
        'height'=>80,
        'width'=>240,
        'flex-width'=>true,
        'flex-height'=>true
    ]);

    add_theme_support('html5',[
        'search-form',
        'gallery',
        'caption',
        'script',
        'style'
    ]);

    add_theme_support('align-wide');

    add_theme_support('responsive-embeds');

    register_nav_menus([
        'primary'=>'Головне меню',
        'footer'=>'Меню футера'
    ]);

}

add_action('after_setup_theme','cusbro_setup');