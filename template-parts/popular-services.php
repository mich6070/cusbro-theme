<?php
/**
 * Popular services grid
 */

$services = [
    [
        'icon'  => 'M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM1 3h22M1 21h22',
        'title' => 'Митне оформлення імпорту',
        'desc'  => 'Ввезення товарів з будь-якої країни під ключ',
        'link'  => '/import/',
    ],
    [
        'icon'  => 'M12 19V5M5 12l7-7 7 7',
        'title' => 'Митне оформлення експорту',
        'desc'  => 'Вивезення товарів за кордон без затримок',
        'link'  => '/export/',
    ],
    [
        'icon'  => 'M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 17H9m10 0h-2V5H1v12h2m0-12h14l2 4H1',
        'title' => 'Розмитнення авто',
        'desc'  => 'Точний розрахунок і швидке оформлення',
        'link'  => '/rozmytnennya-avto/',
    ],
    [
        'icon'  => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
        'title' => 'Код УКТ ЗЕД',
        'desc'  => 'Правильна класифікація будь-якого товару',
        'link'  => '/kod-ukt-zed/',
    ],
    [
        'icon'  => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'title' => 'Сертифікат EUR.1',
        'desc'  => 'Оформлення для пільгового ввезення до ЄС',
        'link'  => '/eur1/',
    ],
    [
        'icon'  => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'title' => 'Митна вартість',
        'desc'  => 'Захист від безпідставних донарахувань',
        'link'  => '/mytna-vartist/',
    ],
    [
        'icon'  => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
        'title' => 'Акредитація підприємства',
        'desc'  => 'Реєстрація в митному органі для ЗЕД',
        'link'  => '/akredytatsiya/',
    ],
    [
        'icon'  => 'M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z',
        'title' => 'Консультації ЗЕД',
        'desc'  => 'Відповіді на митні та зовнішньоекономічні питання',
        'link'  => '/konsultatsii/',
    ],
];
?>

<section class="section popular-services" id="popular-services">
    <div class="container">

        <div class="section__header">
            <p class="section__label">Що ми робимо</p>
            <h2 class="section__title">Популярні послуги</h2>
        </div>

        <div class="services__grid">
            <?php foreach ($services as $service) : ?>
            <a href="<?php echo esc_url($service['link']); ?>" class="service-card">
                <div class="service-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="<?php echo esc_attr($service['icon']); ?>" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="service-card__title"><?php echo esc_html($service['title']); ?></h3>
                <p class="service-card__desc"><?php echo esc_html($service['desc']); ?></p>
                <span class="service-card__arrow" aria-hidden="true">→</span>
            </a>
            <?php endforeach; ?>
        </div>

    </div>
</section>
