<?php
if (!defined('ABSPATH')) {
    exit;
}

define('CUSBRO_VERSION', '1.0.0');
define('CUSBRO_PATH', get_template_directory());
define('CUSBRO_URI', get_template_directory_uri());

$includes = [
    '/inc/setup.php',
    '/inc/theme-support.php',
    '/inc/enqueue.php',
    '/inc/menus.php',
    '/inc/widgets.php',
    '/inc/security.php',
    '/inc/cleanup.php',
    '/inc/schema.php',
];

foreach ($includes as $file) {

    $path = CUSBRO_PATH . $file;

    if (file_exists($path)) {
        require_once $path;
    }

}