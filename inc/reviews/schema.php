<?php
/**
 * Reviews — Schema.org output
 *
 * Scoped to LocalBusiness (customs broker is a local service business)
 * with aggregateRating + individual review entries. Kept separate from
 * inc/schema.php (currently empty, likely for site-wide Organization
 * markup later) so this block's schema travels with the block itself.
 *
 * Worth checking once Rank Math's own schema settings are configured:
 * if Rank Math already outputs a LocalBusiness/Organization block
 * site-wide, having two independent "@type": "LocalBusiness" blocks
 * on the same page can look like duplicate/conflicting entities to
 * Google — may need combining rather than running both as-is.
 */

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_render_reviews_schema($data)
{
    if (empty($data['reviews'])) {
        return;
    }

    $schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'LocalBusiness',
        'name'     => get_bloginfo('name'),
        'url'      => home_url('/'),
    ];

    if (!empty($data['rating']) && !empty($data['review_count'])) {
        $schema['aggregateRating'] = [
            '@type'       => 'AggregateRating',
            'ratingValue' => (string) $data['rating'],
            'reviewCount' => (string) $data['review_count'],
        ];
    }

    $schema['review'] = array_map(
        function ($review) {
            $entry = [
                '@type'        => 'Review',
                'author'       => [
                    '@type' => 'Person',
                    'name'  => $review['author'],
                ],
                'reviewRating' => [
                    '@type'       => 'Rating',
                    'ratingValue' => (string) $review['rating'],
                    'bestRating'  => '5',
                ],
                'reviewBody'   => $review['text'],
            ];

            if (!empty($review['date'])) {
                $entry['datePublished'] = $review['date'];
            }

            return $entry;
        },
        $data['reviews']
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
