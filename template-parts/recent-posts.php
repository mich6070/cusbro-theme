<?php
/**
 * Recent blog posts section
 */

$recent_posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
]);

if (!$recent_posts->have_posts()) {
    return;
}
?>

<section class="section recent-posts">
    <div class="container">

        <div class="section__header section__header--row">
            <div>
                <p class="section__label">Блог</p>
                <h2 class="section__title">Останні статті</h2>
            </div>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="btn btn--outline">
                Всі статті
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>

        <div class="posts__grid">
            <?php while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <article class="post-card">
                <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" class="post-card__thumb" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'alt' => '']); ?>
                </a>
                <?php endif; ?>
                <div class="post-card__body">
                    <time class="post-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                    <h3 class="post-card__title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="post-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 18); ?></p>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

    </div>
</section>
