<?php
/**
 * Reviews — Google Places provider
 *
 * Inert until both GOOGLE_PLACES_API_KEY and GOOGLE_PLACE_ID are
 * defined (wp-config.php, never in the theme/git) — until then this
 * always returns null and cusbro_get_reviews() falls back to the demo
 * provider automatically. Google returns at most 5 reviews, chosen by
 * Google's own relevance ranking, not by us — that's the API's
 * behavior, not a bug here.
 *
 * NOTE for whoever wires up the real credentials: this targets the
 * long-standing Places API "Place Details" endpoint. Google has been
 * migrating toward "Places API (New)", which uses different endpoints
 * and a different JSON response shape entirely. Confirm which one is
 * actually active on the Google Cloud project before assuming this
 * works unmodified — check the response for a "status" field; if it's
 * missing/unexpected, the API version has likely moved and this
 * parsing needs updating to match.
 */

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_reviews_provider_google()
{
    if (!defined('GOOGLE_PLACES_API_KEY') || !defined('GOOGLE_PLACE_ID')) {
        return null;
    }

    $url = add_query_arg(
        [
            'place_id' => GOOGLE_PLACE_ID,
            'fields'   => 'rating,user_ratings_total,reviews',
            'language' => 'uk',
            'key'      => GOOGLE_PLACES_API_KEY,
        ],
        'https://maps.googleapis.com/maps/api/place/details/json'
    );

    $response = wp_remote_get($url, ['timeout' => 8]);

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        return null;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!is_array($data) || ($data['status'] ?? '') !== 'OK' || empty($data['result']['reviews'])) {
        return null;
    }

    $reviews = [];

    foreach ($data['result']['reviews'] as $entry) {
        if (empty($entry['text']) || empty($entry['rating'])) {
            continue;
        }

        $reviews[] = [
            'author' => $entry['author_name'] ?? 'Клієнт CUSBRO',
            'avatar' => $entry['profile_photo_url'] ?? null,
            'rating' => (int) $entry['rating'],
            'text'   => trim($entry['text']),
            'date'   => isset($entry['time']) ? gmdate('c', (int) $entry['time']) : null,
        ];
    }

    if (empty($reviews)) {
        return null;
    }

    return [
        'reviews'      => $reviews,
        'rating'       => isset($data['result']['rating']) ? (float) $data['result']['rating'] : null,
        'review_count' => isset($data['result']['user_ratings_total']) ? (int) $data['result']['user_ratings_total'] : null,
    ];
}
