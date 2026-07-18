<?php
/**
 * Real cases section
 * TODO: підключити CPT "cases" коли буде створено
 */

$cases = [
    [
        'tag'    => 'Імпорт',
        'title'  => 'Промислове обладнання з Китаю',
        'result' => 'Оформили за 2 дні замість очікуваних 7. Заощадили клієнту 15% на митній вартості завдяки правильній класифікації.',
        'nums'   => ['48 год', '15%', '€120 000'],
        'labels' => ['термін оформлення', 'економія', 'вартість вантажу'],
    ],
    [
        'tag'    => 'Авто',
        'title'  => 'BMW X5 з Польщі',
        'result' => 'Розрахували точну суму мита до ввезення. Жодних сюрпризів на кордоні. Оформили за 1 день.',
        'nums'   => ['1 день', '0 ₴', '€28 000'],
        'labels' => ['термін оформлення', 'непередбачених витрат', 'вартість авто'],
    ],
    [
        'tag'    => 'Експорт',
        'title'  => 'Сільгосппродукція до ЄС',
        'result' => 'Оформили EUR.1 і митну декларацію на регулярні поставки зерна. Тепер клієнт оформляє 2 рази на місяць.',
        'nums'   => ['2×/міс', 'EUR.1', '40 т'],
        'labels' => ['регулярність', 'тип документу', 'об\'єм'],
    ],
];
?>

<section class="section cases">
    <div class="container">

        <div class="section__header">
            <p class="section__label">Кейси</p>
            <h2 class="section__title">Реальні результати клієнтів</h2>
            <p class="section__desc">Не слова — цифри. Ось що ми зробили для наших клієнтів</p>
        </div>

        <div class="cases__grid">
            <?php foreach ($cases as $case) : ?>
            <div class="case-card">
                <span class="case-card__tag"><?php echo esc_html($case['tag']); ?></span>
                <h3 class="case-card__title"><?php echo esc_html($case['title']); ?></h3>
                <p class="case-card__result"><?php echo esc_html($case['result']); ?></p>
                <div class="case-card__nums">
                    <?php foreach ($case['nums'] as $i => $num) : ?>
                    <div class="case-num">
                        <strong><?php echo esc_html($num); ?></strong>
                        <span><?php echo esc_html($case['labels'][$i]); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
