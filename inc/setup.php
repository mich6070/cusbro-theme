<?php
/**
 * Theme setup
 *
 * @package CUSBRO
 */

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_theme_setup(): void
{
    load_theme_textdomain('cusbro', get_template_directory() . '/languages');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support('responsive-embeds');

    add_theme_support('editor-styles');

    add_theme_support('wp-block-styles');

    add_theme_support('align-wide');

    register_nav_menus([
        'primary' => __('Головне меню', 'cusbro'),
        'footer'  => __('Меню футера', 'cusbro'),
    ]);

    add_image_size('hero', 1920, 900, true);
    add_image_size('service', 700, 500, true);
    add_image_size('team', 500, 600, true);
}

add_action('after_setup_theme', 'cusbro_theme_setup');