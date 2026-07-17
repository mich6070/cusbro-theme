<?php
/**
 * Enqueue scripts and styles
 */

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_enqueue_assets(): void
{
    wp_enqueue_style(
        'cusbro-style',
        get_stylesheet_uri(),
        [],
        CUSBRO_VERSION
    );

    wp_enqueue_style(
        'cusbro-main',
        CUSBRO_URI . '/assets/css/main.css',
        ['cusbro-style'],
        CUSBRO_VERSION
    );

    wp_enqueue_script(
        'cusbro-main',
        CUSBRO_URI . '/assets/js/main.js',
        [],
        CUSBRO_VERSION,
        true
    );
}

add_action('wp_enqueue_scripts', 'cusbro_enqueue_assets');