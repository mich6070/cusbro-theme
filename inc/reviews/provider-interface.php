<?php
/**
 * Reviews — provider contract
 *
 * Every provider is a plain function that takes no arguments and
 * returns either a result array (see shape below), or null if it has
 * nothing to offer right now (not configured, API failed, etc.) —
 * never throws, never dies. cusbro_get_reviews() in helpers.php is the
 * only thing that decides which provider wins; nothing else in the
 * theme calls a provider function directly.
 *
 * Result shape (identical for every provider, so the orchestrator and
 * every template never need to know which one actually answered):
 *
 *   [
 *       'reviews'      => [
 *           [
 *               'author' => string,       // 'Клієнт CUSBRO' if unknown
 *               'avatar' => string|null,  // profile photo URL, or null
 *               'rating' => int,          // 1-5
 *               'text'   => string,       // trimmed review text
 *               'date'   => string|null,  // ISO 8601, or null
 *           ],
 *           ...
 *       ],
 *       'rating'       => float|null,  // aggregate, e.g. 4.9
 *       'review_count' => int|null,    // total review count
 *   ]
 *
 * Swapping the live source (Google Places today, Business Profile API
 * or Trustpilot tomorrow) means writing one new provider-*.php file
 * and pointing cusbro_get_reviews() at it — the cache layer, the
 * schema output, and every template that reads cusbro_get_reviews()
 * stay untouched.
 */

if (!defined('ABSPATH')) {
    exit;
}
