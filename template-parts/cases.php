<?php
/**
 * Cases — customs clearance examples
 */

if (!defined('ABSPATH')) {
    exit;
}

$cases = [
    [
        'badge'  => 'Найпопулярніший запит',
        'icon'   => '<path d="M4 16h1a2 2 0 1 0 4 0h6a2 2 0 1 0 4 0h1a1 1 0 0 0 1-1v-2.5a2 2 0 0 0-.6-1.4l-2.5-2.5A2 2 0 0 0 16.5 8H14V6a1 1 0 0 0-1-1H8.4a2 2 0 0 0-1.8 1.1L5 9.5 3.4 10.2A1 1 0 0 0 3 11.1V15a1 1 0 0 0 1 1Z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="7.5" cy="16" r="1.6" stroke="currentColor" stroke-width="2.2"/><circle cx="16.5" cy="16" r="1.6" stroke="currentColor" stroke-width="2.2"/>',
        'title'  => 'Volkswagen Golf 2020',
        'list'   => ['Бензин 1.5 TSI', 'Польща', 'Попередній розрахунок до покупки'],
        'price'  => '≈ 4 820 €',
        'result' => 'Попередній розрахунок підтвердився під час оформлення.',
    ],
    [
        'badge'  => 'Преміум-сегмент',
        'icon'   => '<path d="M4 16h1a2 2 0 1 0 4 0h6a2 2 0 1 0 4 0h1a1 1 0 0 0 1-1v-2.5a2 2 0 0 0-.6-1.4l-2.5-2.5A2 2 0 0 0 16.5 8H14V6a1 1 0 0 0-1-1H8.4a2 2 0 0 0-1.8 1.1L5 9.5 3.4 10.2A1 1 0 0 0 3 11.1V15a1 1 0 0 0 1 1Z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="7.5" cy="16" r="1.6" stroke="currentColor" stroke-width="2.2"/><circle cx="16.5" cy="16" r="1.6" stroke="currentColor" stroke-width="2.2"/>',
        'title'  => 'Audi A4 2019',
        'list'   => ['Дизель 2.0 TDI', 'Німеччина', 'Перевірка на арешти та застави'],
        'price'  => '≈ 6 340 €',
        'result' => 'Оформлення до 2 годин.',
    ],
    [
        'badge'  => 'Електромобіль',
        'icon'   => '<path d="M13 2 4 14h6l-1 8 9-12h-6l1-8Z" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>',
        'title'  => 'Tesla Model 3 2021',
        'list'   => ['Акумулятор 75 кВт·год', 'США', 'Мито 0% для електромобіля'],
        'price'  => '≈ 3 690 €',
        'result' => 'Без додаткових платежів.',
    ],
    [
        'badge'  => 'Комерційний транспорт',
        'icon'   => '<rect x="3" y="7" width="10" height="8" rx="1" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/><path d="M13 11h3.3a1 1 0 0 1 .7.29l2 2a1 1 0 0 1 .3.71V15H13v-4Z" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/><circle cx="7" cy="17" r="1.6" stroke="currentColor" stroke-width="2.2"/><circle cx="16.5" cy="17" r="1.6" stroke="currentColor" stroke-width="2.2"/>',
        'title'  => 'Mercedes-Benz Atego 2016',
        'list'   => ['Дизель, повна маса 12 т', 'Вживаний, зареєстрований у 2016', 'Попередній розрахунок усіх платежів'],
        'price'  => '≈ 10 200 €',
        'result' => 'Без затримок на митниці.',
    ],
    [
        'badge'  => 'Пасажирські перевезення',
        'icon'   => '<rect x="3" y="6" width="18" height="9" rx="2" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/><path d="M3 11h18M8 6v5M14 6v5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><circle cx="7.5" cy="17" r="1.6" stroke="currentColor" stroke-width="2.2"/><circle cx="16.5" cy="17" r="1.6" stroke="currentColor" stroke-width="2.2"/>',
        'title'  => 'Mercedes-Benz Sprinter 2015',
        'list'   => ['Дизель, до 19 місць', 'Вживаний, понад 8 років експлуатації', 'Усі платежі відомі до початку оформлення'],
        'price'  => '≈ 7 240 €',
        'result' => 'Документи підготовлено до реєстрації.',
    ],
    [
        'badge'  => 'Мотоцикл',
        'icon'   => '<circle cx="5.5" cy="17.5" r="2.3" stroke="currentColor" stroke-width="2.2"/><circle cx="18.5" cy="17.5" r="2.3" stroke="currentColor" stroke-width="2.2"/><path d="M7.5 17.5h4l2.5-5h4.5M12 12.5h2.5l2 2.5M9 17.5h7.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>',
        'title'  => 'BMW R1250GS 2020',
        'list'   => ['Бензин, 1254 см³', 'Німеччина', 'Враховано всі обов\'язкові платежі'],
        'price'  => '≈ 3 230 €',
        'result' => 'Оформлено за один візит.',
    ],
];
?>
<section class="cases" id="cases">

    <div class="container">

        <div class="section-heading">
            <h2>Приклади митного оформлення</h2>
            <p>Приклади митного оформлення автомобілів, вантажівок, автобусів та мотоциклів із орієнтовною вартістю розмитнення.</p>
        </div>

        <div class="cases__grid">
            <?php foreach ($cases as $case) : ?>
            <article class="case-card">

                <span class="case-card__badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                        <?php echo $case['icon']; ?>
                    </svg>
                    <?php echo esc_html($case['badge']); ?>
                </span>

                <h3 class="case-card__title"><?php echo esc_html($case['title']); ?></h3>

                <ul class="case-card__list">
                    <?php foreach ($case['list'] as $item) : ?>
                    <li><?php echo esc_html($item); ?></li>
                    <?php endforeach; ?>
                </ul>

                <div class="case-card__price"><?php echo esc_html($case['price']); ?></div>

                <div class="case-card__result"><?php echo esc_html($case['result']); ?></div>

            </article>
            <?php endforeach; ?>
        </div>

        <div class="cases__cta">
            <p>Хочете дізнатися точну вартість саме для вашого транспорту?</p>
            <a href="#contact" class="btn">Отримати точний розрахунок</a>
        </div>

    </div>

</section>
