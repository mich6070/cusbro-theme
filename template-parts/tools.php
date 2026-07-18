<?php
/**
 * Useful tools section
 */

$tools = [
    [
        'icon'  => '<path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Калькулятор мита',
        'desc'  => 'Розрахуйте суму митних платежів для будь-якого товару або автомобіля онлайн.',
        'link'  => '#calculator',
        'cta'   => 'Розрахувати',
    ],
    [
        'icon'  => '<path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Пошук коду УКТ ЗЕД',
        'desc'  => 'Знайдіть правильний код товару в Українській класифікації зовнішньоекономічної діяльності.',
        'link'  => '/kod-ukt-zed/',
        'cta'   => 'Знайти код',
    ],
    [
        'icon'  => '<path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>',
        'title' => 'Ставки мита',
        'desc'  => 'Актуальні ставки ввізного мита, ПДВ та акцизу по кодах УКТ ЗЕД. Дані оновлюються.',
        'link'  => '/stavky-myta/',
        'cta'   => 'Переглянути',
    ],
];
?>

<section class="section tools">
    <div class="container">

        <div class="section__header">
            <p class="section__label">Інструменти</p>
            <h2 class="section__title">Корисні інструменти</h2>
            <p class="section__desc">Безкоштовні сервіси для розрахунку митних платежів і пошуку інформації</p>
        </div>

        <div class="tools__grid">
            <?php foreach ($tools as $tool) : ?>
            <div class="tool-card">
                <div class="tool-card__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <?php echo $tool['icon']; ?>
                    </svg>
                </div>
                <h3 class="tool-card__title"><?php echo esc_html($tool['title']); ?></h3>
                <p class="tool-card__desc"><?php echo esc_html($tool['desc']); ?></p>
                <a href="<?php echo esc_url($tool['link']); ?>" class="tool-card__link">
                    <?php echo esc_html($tool['cta']); ?>
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
