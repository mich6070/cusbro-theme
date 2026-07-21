<?php
/**
 * Reviews — file cache
 *
 * Plain JSON file, not a WP transient — the site should keep serving
 * the last known-good reviews even if the database has issues, and a
 * file is trivial to inspect/clear by hand during setup.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('CUSBRO_REVIEWS_CACHE_FILE', CUSBRO_PATH . '/cache/reviews.json');

// freshness is entirely the cron's responsibility (see helpers.php,
// scheduled twicedaily) — a page request only ever reads whatever is
// here, however old, rather than falling back to demo content just
// because the cron happened to miss a run. A stale real review beats
// a generic placeholder on a live site.
function cusbro_reviews_cache_get()
{
    if (!file_exists(CUSBRO_REVIEWS_CACHE_FILE)) {
        return null;
    }

    $data = json_decode((string) file_get_contents(CUSBRO_REVIEWS_CACHE_FILE), true);

    return is_array($data) ? $data : null;
}

function cusbro_reviews_cache_set($data)
{
    $dir = dirname(CUSBRO_REVIEWS_CACHE_FILE);

    if (!is_dir($dir)) {
        wp_mkdir_p($dir);
    }

    file_put_contents(CUSBRO_REVIEWS_CACHE_FILE, wp_json_encode($data));
}
