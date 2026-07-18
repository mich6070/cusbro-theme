<?php
/**
 * Footer template
 */
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer__top">

            <div class="footer__brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo" aria-label="CUSBRO — на головну">
                    CUS<span>BRO</span>
                </a>
                <p class="footer__desc">
                    Митний брокер у Вінниці. Оформлення імпорту, експорту та розмитнення авто по всій Україні.
                </p>
                <div class="footer__social">
                    <a href="#" aria-label="Telegram" rel="noopener noreferrer" target="_blank">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2Zm4.93 7.03-1.9 8.96c-.14.62-.5.78-.99.48l-2.74-2.02-1.32 1.27c-.15.14-.27.26-.55.26l.2-2.8 5.1-4.6c.22-.2-.05-.3-.34-.1L8.36 14.4l-2.72-.85c-.59-.19-.6-.59.12-.87l10.64-4.1c.5-.18.93.12.73.85Z" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Viber" rel="noopener noreferrer" target="_blank">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M11.4 1.5C8.5 1.6 4.9 2.8 3.3 6.2 2.5 8 2.4 10 2.4 11.9c-.1 2.4.2 7.6 5.4 9h.1v2.4c0 .5.6.8 1 .4l2.5-2.5h.8c3.1 0 5.3-.8 6.8-2.4 2-2.2 2-5.4 2-7.4-.1-4.8-2.3-8.4-9.6-8.9h-.4Zm-.2 1.8h.3c6.1.4 7.9 3.4 8 7.3 0 1.9-.1 4.5-1.6 6.2-1.2 1.3-3.1 2-5.7 2h-1.1L9.5 21v-2.3C5.3 17.7 4.2 13.5 4.3 12c.1-1.8.2-3.5.9-5.1 1.2-2.9 4.2-3.7 6.6-3.7Zm.3 3.5c-.2 0-.5.1-.5.4v1c0 .3.2.4.5.4h.1c1.8.1 2.7 1 2.7 2.9v.1c0 .3.1.5.4.5h1c.3 0 .5-.2.5-.5v-.1c0-2.7-1.6-4.3-4.3-4.4l-.4-.3Zm-3.6.6c-.5 0-.9.2-1.3.6-.4.3-.7.7-.9 1.1-.2.5-.1 1 .2 1.4 1 1.5 2.2 2.7 3.7 3.7.5.3.9.4 1.4.2.4-.2.8-.5 1.1-.9l.2-.3c.3-.4.3-1-.1-1.4L11.5 11c-.2-.2-.5-.3-.8-.2-.2.1-.4.2-.5.4l-.3.3c-.1.1-.2.1-.3 0-.7-.5-1.3-1.1-1.8-1.8-.1-.1-.1-.2 0-.3l.3-.3c.2-.2.3-.3.4-.5.1-.3 0-.6-.2-.9L7.5 8c-.2-.4-.5-.6-.7-.6Zm4.8 1.5c-.2 0-.5.1-.5.4v1c0 .2.1.4.4.4 1.2.1 1.7.6 1.8 1.8 0 .3.2.4.4.4h1c.3 0 .5-.2.5-.4-.1-1.9-1-2.8-3-2.7 0-.1-.3.1-.6.1Z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="footer__col">
                <h4 class="footer__heading">Послуги</h4>
                <ul class="footer__links">
                    <li><a href="/mytne-oformlennya/">Митне оформлення</a></li>
                    <li><a href="/import/">Імпорт</a></li>
                    <li><a href="/export/">Експорт</a></li>
                    <li><a href="/rozmytnennya-avto/">Розмитнення авто</a></li>
                    <li><a href="/kod-ukt-zed/">Код УКТ ЗЕД</a></li>
                    <li><a href="/eur1/">Сертифікат EUR.1</a></li>
                    <li><a href="/mytna-vartist/">Митна вартість</a></li>
                    <li><a href="/akredytatsiya/">Акредитація</a></li>
                </ul>
            </div>

            <div class="footer__col">
                <h4 class="footer__heading">Компанія</h4>
                <ul class="footer__links">
                    <li><a href="/pro-nas/">Про нас</a></li>
                    <li><a href="/blog/">Блог</a></li>
                    <li><a href="/faq/">FAQ</a></li>
                    <li><a href="/kontakty/">Контакти</a></li>
                </ul>

                <h4 class="footer__heading" style="margin-top:32px;">Контакти</h4>
                <ul class="footer__links">
                    <li><a href="tel:+380XXXXXXXXX">+38 (0XX) XXX-XX-XX</a></li>
                    <li><a href="mailto:info@cusbro.pro">info@cusbro.pro</a></li>
                    <li>Вінниця, Україна</li>
                </ul>
            </div>

        </div>

        <div class="footer__bottom">
            <p>&copy; <?php echo esc_html(date('Y')); ?> CUSBRO. Всі права захищені.</p>
            <a href="/polityka-konfidentsiynosti/">Політика конфіденційності</a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
