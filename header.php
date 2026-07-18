<?php
/**
 * Header template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="container">
        <div class="header__inner">

            <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo" aria-label="CUSBRO — на головну">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="header__logo-text">CUS<span>BRO</span></span>
                <?php endif; ?>
            </a>

            <nav class="header__nav" aria-label="<?php esc_attr_e('Головне меню', 'cusbro'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'header__menu',
                    'container'      => false,
                    'walker'         => new Cusbro_Nav_Walker(),
                    'fallback_cb'    => false,
                ]);
                ?>
            </nav>

            <div class="header__actions">
                <a href="tel:+380XXXXXXXXX" class="header__phone">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3.31 1.33A1.33 1.33 0 0 0 2 2.67C2 9.4 7.6 15 14.33 15a1.33 1.33 0 0 0 1.34-1.33v-2.1a1.33 1.33 0 0 0-1.1-1.31l-2.41-.48a1.33 1.33 0 0 0-1.3.46l-.73.9A9.5 9.5 0 0 1 5.86 6.9l.9-.74a1.33 1.33 0 0 0 .46-1.3L6.74 2.4A1.33 1.33 0 0 0 5.43 1.3H3.31Z" fill="currentColor"/>
                    </svg>
                    +38 (0XX) XXX-XX-XX
                </a>
                <a href="#contact" class="btn btn--primary btn--sm">Консультація</a>
            </div>

            <button class="header__burger" id="burger-btn" aria-label="Відкрити меню" aria-expanded="false" aria-controls="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>

<div class="mobile-menu" id="mobile-menu" aria-hidden="true" role="dialog" aria-label="Мобільне меню">
    <div class="mobile-menu__inner">
        <nav aria-label="Мобільне меню">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'mobile-menu__list',
                'container'      => false,
                'walker'         => new Cusbro_Nav_Walker(),
                'fallback_cb'    => false,
            ]);
            ?>
        </nav>
        <div class="mobile-menu__footer">
            <a href="tel:+380XXXXXXXXX" class="mobile-menu__phone">+38 (0XX) XXX-XX-XX</a>
            <a href="#contact" class="btn btn--primary btn--full">Отримати консультацію</a>
        </div>
    </div>
</div>
<div class="mobile-menu__overlay" id="mobile-overlay" aria-hidden="true"></div>
