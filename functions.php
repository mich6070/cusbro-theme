<?php
/**
 * CUSBRO Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CUSBRO_VERSION', wp_get_theme()->get('Version'));
define('CUSBRO_PATH', get_template_directory());
define('CUSBRO_URI', get_template_directory_uri());

$includes = [
    '/inc/setup.php',
    '/inc/enqueue.php',
    '/inc/menus.php',
    '/inc/security.php',
    '/inc/cleanup.php',
    '/inc/helpers.php',
    '/inc/schema.php',
    '/inc/customs.php',
];

foreach ($includes as $file) {

    $path = CUSBRO_PATH . $file;

    if (file_exists($path)) {
        require_once $path;
    }
}
