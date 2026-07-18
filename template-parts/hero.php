<?php
/**
 * Hero section — dark background with photo
 */
?>

<section class="hero">
    <div class="container">
        <div class="hero__inner">

            <div class="hero__content">
                <div class="hero__badge">
                    <span class="hero__badge-dot"></span>
                    Офіційний митний брокер · Вінниця
                </div>

                <h1 class="hero__title">
                    Митне оформлення<br>
                    імпорту та експорту<br>
                    <span class="hero__title-accent">для вашого бізнесу</span>
                </h1>

                <p class="hero__desc">
                    Супроводжуємо від консультації до отримання товару. Жодних затримок, жодних прихованих платежів.
                </p>

                <div class="hero__actions">
                    <a href="#contact" class="btn btn--primary btn--lg">Замовити консультацію</a>
                    <a href="#popular-services" class="btn btn--hero-outline btn--lg">Наші послуги</a>
                </div>

                <div class="hero__trust">
                    <div class="hero__trust-item">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="#0C5ADB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Без передоплати
                    </div>
                    <div class="hero__trust-item">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="#0C5ADB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Фіксована вартість
                    </div>
                    <div class="hero__trust-item">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                            <path d="M13.3 4.7L6 12 2.7 8.7" stroke="#0C5ADB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Відповідь за 1 годину
                    </div>
                </div>
            </div>

            <div class="hero__photo-wrap">
                <div class="hero__photo">
                    <?php
                    // TODO: замінити на реальне фото: assets/img/hero-person.webp
                    if (file_exists(get_template_directory() . '/assets/img/hero-person.webp')) :
                    ?>
                        <img
                            src="<?php echo esc_url(CUSBRO_URI . '/assets/img/hero-person.webp'); ?>"
                            alt="Митний брокер CUSBRO"
                            width="480"
                            height="560"
                            loading="eager"
                        >
                    <?php else : ?>
                        <div class="hero__photo-placeholder">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" aria-hidden="true">
                                <circle cx="40" cy="30" r="18" stroke="rgba(255,255,255,.2)" stroke-width="2"/>
                                <path d="M10 70c0-16.57 13.43-30 30-30s30 13.43 30 30" stroke="rgba(255,255,255,.2)" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <p>Додайте фото<br>assets/img/hero-person.webp</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="hero__card hero__card--stat">
                    <strong>10+</strong>
                    <span>років досвіду</span>
                </div>

                <div class="hero__card hero__card--badge">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <path d="M9 12l2 2 4-4" stroke="#0C5ADB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 1.5l2.39 1.79 2.97-.38 1.02 2.79 2.49 1.55-.56 3.01L19.83 13l-2.49 1.55-1.02 2.79-2.97-.38L10 18.5l-2.39-1.54-2.97.38-1.02-2.79L1.13 13l.56-3.01L1.17 7.25l2.49-1.55 1.02-2.79 2.97.38L10 1.5z" stroke="#0C5ADB" stroke-width="1.5"/>
                    </svg>
                    <span>Ліцензований брокер</span>
                </div>
            </div>

        </div>
    </div>
</section>
