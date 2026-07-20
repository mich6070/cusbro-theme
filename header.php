<?php
/**
 * Header
 * @package CUSBRO
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo('charset'); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (is_front_page()) : ?>
<meta name="description" content="Митне оформлення автомобілів та вантажів без прихованих платежів. Точний розрахунок мита ще до початку оформлення. Працюємо по всій Україні.">
<?php else : ?>
<meta name="description" content="<?php bloginfo('description'); ?>">
<?php endif; ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header" id="site-header" role="banner">

    <div class="container">

        <div class="header-wrapper">

            <!-- Logo -->

            <div class="logo">

                <a href="<?php echo esc_url(home_url('/')); ?>">

                    <?php

                    if (has_custom_logo()) {

                        the_custom_logo();

                    } else {

                        echo '
<div class="logo-text">
    <span class="logo-title">CUSBRO</span>
    <span class="logo-subtitle">митний брокер</span>
</div>';

                    }

                    ?>

                </a>

            </div>

            <!-- Navigation -->

            <nav
    id="primary-navigation"
    class="main-navigation"
    aria-label="Головне меню">

                <?php

                wp_nav_menu(array(

                    'theme_location' => 'primary',

                    'container'      => false,

                    'menu_class'     => 'main-menu',

                    'fallback_cb'    => false

                ));

                ?>

                <div class="main-navigation__footer">

                    <a class="phone" href="tel:+380680070646">

                        <span class="phone-icon">📞</span>

                        <span class="phone-text">+38 (068) 007-06-46</span>

                    </a>

                    <a href="#contact" class="btn-header">

                        Замовити консультацію

                    </a>

                </div>

            </nav>

           <!-- Right -->

<div class="header-right">

    <a class="phone" href="tel:+380680070646">

        <span class="phone-icon">📞</span>

        <span class="phone-text">+38 (068) 007-06-46</span>

    </a>

    <div class="header-socials">

        <a href="https://t.me/USERNAME"
           class="social-link telegram"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Написати нам у Telegram">

            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                <path d="M21 4 2.6 11.3c-1 .4-1 1.7.1 2l4.6 1.4 1.8 5.6c.3.9 1.4 1.1 2 .4l2.6-2.8 4.7 3.4c.8.6 2 .2 2.2-.8l3-15.1c.2-1-.7-1.8-1.6-1.4Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8.4 15.2 18 8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </a>

        <a href="viber://chat?number=%2B380680070646"
           class="social-link viber"
           aria-label="Написати нам у Viber">

            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                <path d="M12 3c5 0 8.5 3 8.5 7.6 0 4.2-2.9 7.1-7.2 7.6-1 .1-1.6.5-2.3 1.3l-1.6 1.9v-2.9c-3.6-.9-6.1-3.7-6.1-7.9C3.3 6 6.9 3 12 3Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/>
                <path d="M9 10.2c0 3 2.3 5.2 5 5.4M9 10.2c0-1.7.5-2.9 1.3-3.7M9 10.2c1.7 0 2.9.5 3.7 1.3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </a>

        <a href="https://wa.me/380680070646"
           class="social-link whatsapp"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Написати нам у WhatsApp">

            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                <path d="M20 12a8 8 0 1 1-3.7-6.7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                <path d="M9 9.5c0 3.6 2.9 6.5 6.5 6.5.5 0 1-.6.8-1l-.5-1.3c-.1-.4-.6-.6-1-.4l-.8.4c-1-.6-1.9-1.5-2.5-2.5l.4-.8c.2-.4 0-.9-.4-1L10.5 9c-.4-.2-1 .3-1 .8Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
            </svg>

        </a>

    </div>

    <a href="#contact" class="btn-header">

        Замовити консультацію

    </a>

</div>

<button
    class="burger"
    type="button"
    aria-label="Відкрити меню"
    aria-expanded="false"
    aria-controls="primary-navigation">

    <span></span>

    <span></span>

    <span></span>

</button>

        </div>

    </div>

</header>

<main id="main">