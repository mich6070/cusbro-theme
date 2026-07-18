<?php
/**
 * "Що потрібно оформити?" section
 */

$scenarios = [
    [
        'icon'  => '<path d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM1 3h22M1 21h22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Везу товар з-за кордону',
        'desc'  => 'Оформлення імпорту під ключ — від перевірки документів до отримання товару на складі.',
        'link'  => '/import/',
        'label' => 'Імпорт',
    ],
    [
        'icon'  => '<path d="M12 19V5M5 12l7-7 7 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Відправляю товар за кордон',
        'desc'  => 'Митне оформлення експорту, підготовка ЗЕД-документів, класифікація товарів.',
        'link'  => '/export/',
        'label' => 'Експорт',
    ],
    [
        'icon'  => '<path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" stroke="currentColor" stroke-width="1.5"/><path d="M13 17H9m10 0h-2V5H1v12h2m0-12h14l2 4H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Купив авто за кордоном',
        'desc'  => 'Розрахуємо точну суму митних платежів і оформимо автомобіль швидко і без переплат.',
        'link'  => '/rozmytnennya-avto/',
        'label' => 'Авто',
    ],
    [
        'icon'  => '<path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Потрібен код УКТ ЗЕД',
        'desc'  => 'Визначимо правильний код товару для декларації, щоб уникнути суперечок з митницею.',
        'link'  => '/kod-ukt-zed/',
        'label' => 'УКТ ЗЕД',
    ],
    [
        'icon'  => '<path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Оформлюю EUR.1',
        'desc'  => 'Підготуємо сертифікат походження EUR.1 для пільгового ввезення товарів до ЄС.',
        'link'  => '/eur1/',
        'label' => 'EUR.1',
    ],
    [
        'icon'  => '<path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Акредитація підприємства',
        'desc'  => 'Акредитуємо підприємство на митниці для самостійного оформлення ЗЕД-операцій.',
        'link'  => '/akredytatsiya/',
        'label' => 'Акредитація',
    ],
];
?>

<section class="section what-to-process" id="what-to-process">
    <div class="container">

        <div class="section__header">
            <p class="section__label">Ваша ситуація</p>
            <h2 class="section__title">Що потрібно оформити?</h2>
            <p class="section__desc">Оберіть свою ситуацію — розкажемо як це працює і що потрібно зробити</p>
        </div>

        <div class="scenarios__grid">
            <?php foreach ($scenarios as $item) : ?>
            <a href="<?php echo esc_url($item['link']); ?>" class="scenario-card">
                <div class="scenario-card__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <?php echo $item['icon']; ?>
                    </svg>
                </div>
                <span class="scenario-card__label"><?php echo esc_html($item['label']); ?></span>
                <h3 class="scenario-card__title"><?php echo esc_html($item['title']); ?></h3>
                <p class="scenario-card__desc"><?php echo esc_html($item['desc']); ?></p>
                <span class="scenario-card__arrow">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>
