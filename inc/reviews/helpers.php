<?php
/**
 * Reviews — orchestrator + cron
 *
 * cusbro_get_reviews() is the only function anything outside this
 * folder should call. It never touches the network — it reads
 * cache/reviews.json if present, falling back to the demo provider
 * otherwise. The only thing that ever calls the Google provider is
 * the twicedaily cron below, so a normal page request never blocks on
 * a live API call.
 */

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_get_reviews()
{
    $cached = cusbro_reviews_cache_get();

    if ($cached !== null) {
        return $cached;
    }

    return cusbro_reviews_provider_demo();
}

function cusbro_reviews_refresh_cache()
{
    $result = cusbro_reviews_provider_google();

    // only overwrite the cache on a genuine success — if Google is
    // down or not configured, keep serving whatever's already cached
    // rather than wiping it back to nothing
    if ($result !== null) {
        cusbro_reviews_cache_set($result);
    }
}
add_action('cusbro_refresh_reviews_cache', 'cusbro_reviews_refresh_cache');

function cusbro_reviews_schedule_cron()
{
    if (!wp_next_scheduled('cusbro_refresh_reviews_cache')) {
        wp_schedule_event(time(), 'twicedaily', 'cusbro_refresh_reviews_cache');
    }
}
add_action('wp', 'cusbro_reviews_schedule_cron');

function cusbro_reviews_unschedule_cron()
{
    wp_clear_scheduled_hook('cusbro_refresh_reviews_cache');
}
add_action('switch_theme', 'cusbro_reviews_unschedule_cron');

function cusbro_render_stars($rating)
{
    $rating = max(0, min(5, (int) $rating));
    return str_repeat('⭐', $rating) . str_repeat('☆', 5 - $rating);
}
