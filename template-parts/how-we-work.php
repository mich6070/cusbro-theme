<?php
/**
 * "Як ми працюємо" section
 */

$steps = [
    [
        'num'   => '1',
        'title' => 'Заявка або дзвінок',
        'desc'  => 'Зв\'яжіться з нами будь-яким зручним способом. Розкажіть про ваш вантаж або ситуацію.',
    ],
    [
        'num'   => '2',
        'title' => 'Безкоштовна консультація',
        'desc'  => 'Аналізуємо документи, визначаємо код УКТ ЗЕД, розраховуємо точну суму митних платежів.',
    ],
    [
        'num'   => '3',
        'title' => 'Підготовка документів',
        'desc'  => 'Готуємо митну декларацію та весь пакет супровідних документів. Ви отримуєте перевірений комплект.',
    ],
    [
        'num'   => '4',
        'title' => 'Подача на митницю',
        'desc'  => 'Подаємо електронну декларацію, взаємодіємо з митними інспекторами, контролюємо процес.',
    ],
    [
        'num'   => '5',
        'title' => 'Товар у вас',
        'desc'  => 'Ви отримуєте оформлений вантаж і всі документи. Після завершення — завжди на зв\'язку для консультацій.',
    ],
];
?>

<section class="section how-we-work">
    <div class="container">

        <div class="section__header">
            <p class="section__label">Процес</p>
            <h2 class="section__title">Як ми працюємо</h2>
            <p class="section__desc">П'ять кроків від звернення до отримання товару</p>
        </div>

        <div class="steps__list">
            <?php foreach ($steps as $i => $step) : ?>
            <div class="step">
                <div class="step__left">
                    <div class="step__num"><?php echo esc_html($step['num']); ?></div>
                    <?php if ($i < count($steps) - 1) : ?>
                    <div class="step__line" aria-hidden="true"></div>
                    <?php endif; ?>
                </div>
                <div class="step__content">
                    <h3 class="step__title"><?php echo esc_html($step['title']); ?></h3>
                    <p class="step__desc"><?php echo esc_html($step['desc']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
