<?php
/**
 * Reviews — social proof (data-source-agnostic, see inc/reviews/)
 */

if (!defined('ABSPATH')) {
    exit;
}

$cusbro_reviews_data = cusbro_get_reviews();
$cusbro_reviews_list = $cusbro_reviews_data['reviews'] ?? [];

if (empty($cusbro_reviews_list)) {
    return;
}

// derived from the given "leave a review" short link (…/r/{id}/review)
// by dropping the /review suffix — that's Google's own pattern for the
// listing page a review short link is generated from
$cusbro_google_review_url = 'https://g.page/r/CSnkYi2iudoYEAI/review';
$cusbro_google_listing_url = 'https://g.page/r/CSnkYi2iudoYEAI';
?>
<section class="reviews" id="reviews">

    <div class="container">

        <div class="section-heading">
            <h2>Відгуки наших клієнтів</h2>
            <?php if (!empty($cusbro_reviews_data['rating']) && !empty($cusbro_reviews_data['review_count'])) : ?>
            <p class="reviews__rating">
                <span aria-hidden="true"><?php echo cusbro_render_stars(round($cusbro_reviews_data['rating'])); ?></span>
                <strong><?php echo esc_html(number_format((float) $cusbro_reviews_data['rating'], 1)); ?></strong>
                на основі <?php echo esc_html($cusbro_reviews_data['review_count']); ?> відгуків Google
            </p>
            <?php endif; ?>
        </div>

        <div class="reviews__grid">
            <?php foreach ($cusbro_reviews_list as $review) : ?>
            <article class="review-card">

                <span class="review-card__stars" aria-hidden="true"><?php echo cusbro_render_stars($review['rating']); ?></span>

                <p class="review-card__text"><?php echo esc_html($review['text']); ?></p>

                <span class="review-card__author"><?php echo esc_html($review['author']); ?></span>

            </article>
            <?php endforeach; ?>
        </div>

        <div class="reviews__cta">
            <a href="<?php echo esc_url($cusbro_google_listing_url); ?>" class="reviews__cta-link" target="_blank" rel="noopener noreferrer">Переглянути всі відгуки</a>
            <a href="<?php echo esc_url($cusbro_google_review_url); ?>" class="btn" target="_blank" rel="noopener noreferrer">Залишити відгук</a>
        </div>

    </div>

    <?php cusbro_render_reviews_schema($cusbro_reviews_data); ?>

</section>
