<?php
/**
 * Front page template
 */

get_header();
?>

<main id="main" class="site-main" role="main">

    <?php get_template_part('template-parts/hero'); ?>

    <?php get_template_part('template-parts/what-we-help'); ?>

    <?php get_template_part('template-parts/popular-services'); ?>

    <?php get_template_part('template-parts/stats'); ?>

    <?php get_template_part('template-parts/why-cusbro'); ?>

    <?php get_template_part('template-parts/recent-posts'); ?>

    <?php get_template_part('template-parts/faq'); ?>

    <?php get_template_part('template-parts/cta'); ?>

</main>

<?php get_footer(); ?>
