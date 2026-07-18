<?php
/**
 * CTA + Contact section
 */
?>

<section class="section cta-section" id="contact">
    <div class="container">
        <div class="cta__inner">

            <div class="cta__content">
                <p class="section__label">Зв'язатись</p>
                <h2 class="cta__title">Залиште заявку —<br>відповімо протягом години</h2>
                <p class="cta__desc">Розрахуємо митні платежі, перевіримо документи та запропонуємо оптимальний шлях оформлення. Безкоштовна консультація.</p>

                <ul class="cta__contacts">
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M3.31 1.33A1.33 1.33 0 0 0 2 2.67C2 9.4 7.6 15 14.33 15a1.33 1.33 0 0 0 1.34-1.33v-2.1a1.33 1.33 0 0 0-1.1-1.31l-2.41-.48a1.33 1.33 0 0 0-1.3.46l-.73.9A9.5 9.5 0 0 1 5.86 6.9l.9-.74a1.33 1.33 0 0 0 .46-1.3L6.74 2.4A1.33 1.33 0 0 0 5.43 1.3H3.31Z" fill="currentColor"/>
                        </svg>
                        <a href="tel:+380XXXXXXXXX">+38 (0XX) XXX-XX-XX</a>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <a href="mailto:info@cusbro.pro">info@cusbro.pro</a>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                        </svg>
                        <span>Вінниця, Україна</span>
                    </li>
                </ul>
            </div>

            <form class="cta__form" method="post" action="" novalidate>
                <?php wp_nonce_field('cusbro_contact', 'cusbro_nonce'); ?>

                <div class="form-group">
                    <label for="contact-name" class="form-label">Ваше ім'я</label>
                    <input
                        type="text"
                        id="contact-name"
                        name="contact_name"
                        class="form-input"
                        placeholder="Іван Петренко"
                        required
                        autocomplete="name"
                    >
                </div>

                <div class="form-group">
                    <label for="contact-phone" class="form-label">Телефон або Telegram</label>
                    <input
                        type="tel"
                        id="contact-phone"
                        name="contact_phone"
                        class="form-input"
                        placeholder="+38 (0XX) XXX-XX-XX"
                        required
                        autocomplete="tel"
                    >
                </div>

                <div class="form-group">
                    <label for="contact-message" class="form-label">Опишіть вашу ситуацію</label>
                    <textarea
                        id="contact-message"
                        name="contact_message"
                        class="form-input form-textarea"
                        placeholder="Везу товар з Китаю, потрібно оформити імпорт..."
                        rows="4"
                    ></textarea>
                </div>

                <button type="submit" class="btn btn--primary btn--full btn--lg">
                    Надіслати заявку
                </button>

                <p class="cta__form-note">
                    Натискаючи кнопку, ви погоджуєтесь з <a href="/polityka-konfidentsiynosti/">політикою конфіденційності</a>
                </p>
            </form>

        </div>
    </div>
</section>
