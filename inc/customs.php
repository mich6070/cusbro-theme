<?php
/**
 * Customs Calculator OOP Classes Loader
 */

if (!defined('ABSPATH')) {
    exit;
}

// Require all customs classes
require_once CUSBRO_PATH . '/inc/customs/Vehicle.php';
require_once CUSBRO_PATH . '/inc/customs/Engine.php';
require_once CUSBRO_PATH . '/inc/customs/Currency.php';
require_once CUSBRO_PATH . '/inc/customs/Uktzed.php';
require_once CUSBRO_PATH . '/inc/customs/Duty.php';
require_once CUSBRO_PATH . '/inc/customs/Excise.php';
require_once CUSBRO_PATH . '/inc/customs/Vat.php';
require_once CUSBRO_PATH . '/inc/customs/Pension.php';
require_once CUSBRO_PATH . '/inc/customs/Result.php';
require_once CUSBRO_PATH . '/inc/customs/Validation.php';
