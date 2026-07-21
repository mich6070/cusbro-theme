<?php
/**
 * Reviews — demo provider
 *
 * Placeholder content for Phase 1 (build/design), used whenever the
 * Google provider isn't configured or returns nothing. No invented
 * names, cities, or vehicle types — those are exactly the fields the
 * real Google provider will supply on its own, and inventing them now
 * would just mean writing fake identities into review text today and
 * having nothing to swap out later. 'Клієнт CUSBRO' + a five-star
 * rating is honest about what this placeholder actually is.
 */

if (!defined('ABSPATH')) {
    exit;
}

function cusbro_reviews_provider_demo()
{
    $texts = [
        'Думав, що оформлення затягнеться мінімум на тиждень. Насправді машину оформили значно швидше. Постійно були на зв\'язку й повідомляли, що відбувається.',
        'Найбільше переживав, щоб не з\'явились якісь додаткові платежі. У підсумку заплатив саме ту суму, яку мені порахували на початку.',
        'До цього консультувався ще в двох місцях і всі називали різні суми. Тут пояснили, звідки береться кожен платіж, і після оформлення все співпало.',
        'Сподобалось, що відповідали дуже швидко. Не довелося самому розбиратися в документах — усе підготували й пояснили.',
        'Випадок був непростий, але все вирішили без зайвих нервів. Якщо ще доведеться оформляти транспорт — звертатимусь сюди.',
        'Це вже не перше моє оформлення через CUSBRO. Як і минулого разу — все швидко, зрозуміло і без несподіваних витрат.',
    ];

    $reviews = [];

    foreach ($texts as $text) {
        $reviews[] = [
            'author' => 'Клієнт CUSBRO',
            'avatar' => null,
            'rating' => 5,
            'text'   => $text,
            'date'   => null,
        ];
    }

    // same shape cusbro_reviews_provider_google() returns — the
    // orchestrator in helpers.php shouldn't need to know which
    // provider it's talking to
    return [
        'reviews'      => $reviews,
        'rating'       => 5.0,
        'review_count' => count($reviews),
    ];
}
