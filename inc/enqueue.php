<?php

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_enqueue_assets()
{
    wp_enqueue_style(
        'cusbro-style',
        get_stylesheet_uri(),
        [],
        CUSBRO_VERSION
    );

    $styles = [

        'main',
        'header',
        'hero',
        'services',
        'advantages',
        'about',
        'auto',
        'process',
        'calculator',
        'reviews',
        'stats',
        'recent-posts',
        'faq',
        'contact',
        'cta',
        'footer',
        'responsive'

    ];

    foreach ($styles as $style) {

        wp_enqueue_style(
            'cusbro-' . $style,
            get_template_directory_uri() . '/assets/css/' . $style . '.css',
            ['cusbro-style'],
            CUSBRO_VERSION
        );

    }

    wp_enqueue_script(
        'cusbro-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        CUSBRO_VERSION,
        true
    );

    wp_enqueue_script(
        'cusbro-calculator',
        get_template_directory_uri() . '/assets/js/calculator-auto.js',
        [],
        CUSBRO_VERSION,
        true
    );

}

add_action('wp_enqueue_scripts', 'cusbro_enqueue_assets');
