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
        cusbro_asset_version('/style.css')
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
            cusbro_asset_version('/assets/css/' . $style . '.css')
        );

    }

    wp_enqueue_script(
        'cusbro-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        cusbro_asset_version('/assets/js/main.js'),
        true
    );

    wp_enqueue_script(
        'cusbro-calculator',
        get_template_directory_uri() . '/assets/js/calculator-auto.js',
        [],
        cusbro_asset_version('/assets/js/calculator-auto.js'),
        true
    );

    wp_localize_script('cusbro-calculator', 'CusbroCalcRates', cusbro_get_nbu_rates());

}

add_action('wp_enqueue_scripts', 'cusbro_enqueue_assets');
