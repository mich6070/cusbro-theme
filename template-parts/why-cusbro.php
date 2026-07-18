<?php
/**
 * "Чому звертаються до CUSBRO" section
 */

$advantages = [
    [
        'num'   => '01',
        'title' => 'Жодних затримок',
        'desc'  => 'Знаємо процедури митниці зсередини. Документи подаємо правильно з першого разу — товар не затримується на кордоні.',
    ],
    [
        'num'   => '02',
        'title' => 'Прозора вартість',
        'desc'  => 'Розраховуємо всі витрати наперед: мито, ПДВ, акциз, збори. Ніяких прихованих платежів і сюрпризів.',
    ],
    [
        'num'   => '03',
        'title' => 'Досвід 10+ років',
        'desc'  => 'Оформили понад 500 клієнтів. Знаємо специфіку кожного виду товарів і кожного митного посту.',
    ],
    [
        'num'   => '04',
        'title' => 'Особистий підхід',
        'desc'  => 'Один менеджер веде ваше оформлення від початку до кінця. Завжди на зв\'язку — телефон, Telegram, Viber.',
    ],
    [
        'num'   => '05',
        'title' => 'Вся Україна',
        'desc'  => 'Оформляємо на будь-якому митному посту України. Базуємось у Вінниці, але клієнти — по всій країні.',
    ],
    [
        'num'   => '06',
        'title' => 'Повний супровід',
        'desc'  => 'Від першої консультації до отримання товару. За потреби допомагаємо з логістикою і зберіганням.',
    ],
];
?>

<section class="section why-cusbro">
    <div class="container">

        <div class="why-cusbro__inner">
            <div class="why-cusbro__left">
                <p class="section__label">Чому CUSBRO</p>
                <h2 class="section__title">Чому клієнти<br>обирають нас</h2>
                <p class="section__desc">Ми не просто оформляємо документи — ми несемо відповідальність за результат.</p>

                <div class="why-cusbro__stats">
                    <div class="why-stat">
                        <strong class="why-stat__num">500+</strong>
                        <span class="why-stat__label">задоволених клієнтів</span>
                    </div>
                    <div class="why-stat">
                        <strong class="why-stat__num">98%</strong>
                        <span class="why-stat__label">вантажів без затримок</span>
                    </div>
                </div>

                <a href="#contact" class="btn btn--primary">Задати питання</a>
            </div>

            <div class="why-cusbro__grid">
                <?php foreach ($advantages as $item) : ?>
                <div class="advantage-card">
                    <span class="advantage-card__num"><?php echo esc_html($item['num']); ?></span>
                    <h3 class="advantage-card__title"><?php echo esc_html($item['title']); ?></h3>
                    <p class="advantage-card__desc"><?php echo esc_html($item['desc']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
