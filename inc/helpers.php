<?php
/**
 * Theme helpers
 */

if (!defined('ABSPATH')) {
    exit;
}

// filemtime-based version per file so browsers re-fetch the moment a file
// actually changes, instead of every asset sharing the one static theme
// version string and risking a stale cache after an edit
function cusbro_asset_version($relative_path)
{
    $path = CUSBRO_PATH . $relative_path;
    return file_exists($path) ? filemtime($path) : CUSBRO_VERSION;
}

// Live NBU exchange rates for the calculator, cached in a transient so we
// hit bank.gov.ua at most a couple of times a day instead of on every
// page load. Falls back to a fixed rate (cached briefly, so a temporary
// NBU outage doesn't hammer the API on every request) if the API is
// unreachable or returns something we don't recognize — the calculator
// must keep working even when the live source doesn't
function cusbro_get_nbu_rates()
{
    $cached = get_transient('cusbro_nbu_rates_v2');

    if ($cached !== false) {
        return $cached;
    }

    $fallback = [
        'EUR'  => 45.00,
        'USD'  => 41.50,
        'PLN'  => 10.50,
        'date' => '',
        'live' => false,
    ];

    // NBU's endpoint without an explicit date sometimes returns a rate it
    // has already published in advance for the next business day, not
    // today's official rate — pinning the date avoids that off-by-one-day
    // mismatch against every other source that quotes "today's" rate
    $response = wp_remote_get(
        'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date=' . current_time('Ymd') . '&json',
        ['timeout' => 5]
    );

    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        set_transient('cusbro_nbu_rates_v2', $fallback, 30 * MINUTE_IN_SECONDS);
        return $fallback;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    if (!is_array($data)) {
        set_transient('cusbro_nbu_rates_v2', $fallback, 30 * MINUTE_IN_SECONDS);
        return $fallback;
    }

    $rates = $fallback;
    $rates['live'] = false;

    foreach ($data as $entry) {
        if (!isset($entry['cc'], $entry['rate']) || !in_array($entry['cc'], ['EUR', 'USD', 'PLN'], true)) {
            continue;
        }
        $rates[$entry['cc']] = (float) $entry['rate'];
        $rates['date'] = $entry['exchangedate'] ?? '';
        $rates['live'] = true;
    }

    set_transient('cusbro_nbu_rates_v2', $rates, 12 * HOUR_IN_SECONDS);

    return $rates;
}
