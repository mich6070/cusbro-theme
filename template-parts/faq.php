<?php
/**
 * FAQ — grouped accordion with FAQPage schema
 */

if (!defined('ABSPATH')) {
    exit;
}

$faq_groups = [
    [
        'title' => 'Загальне',
        'items' => [
            [
                'q' => 'З ким працює CUSBRO?',
                'a' => 'Ми допомагаємо фізичним особам, ФОП та юридичним особам з митним оформленням автомобілів і товарів.',
            ],
        ],
    ],
    [
        'title' => 'Автомобілі',
        'items' => [
            [
                'q' => 'Які документи потрібні для розмитнення автомобіля?',
                'a' => 'Договір купівлі-продажу або інвойс, свідоцтво про реєстрацію з країни придбання, паспорт та ідентифікаційний код власника. Для точного розрахунку потрібні VIN-код, рік випуску та тип двигуна — уточнюємо індивідуально на консультації.',
            ],
            [
                'q' => 'Скільки часу займає митне оформлення?',
                'a' => 'Стандартно — до 4 годин з моменту подачі повного пакету документів. Складніші випадки можуть зайняти довше — про це попереджаємо заздалегідь, а не в останній момент.',
            ],
            [
                'q' => 'Як розраховується вартість розмитнення?',
                'a' => 'Остаточна сума залежить від вартості автомобіля, року випуску, типу транспорту, двигуна та чинного законодавства. Скористайтесь калькулятором вище, щоб побачити орієнтовну суму за 30 секунд.',
            ],
            [
                'q' => 'Чи можна оформити автомобіль дистанційно?',
                'a' => 'Етап підготовки та оформлення попередньої декларації для кордону проходить 100% онлайн. Ви передаєте документи дистанційно, а ми повністю супроводжуємо процес. Однак завершальний етап — випуск автомобіля у вільний обіг — потребує фізичної присутності транспортного засобу та документів у зоні митного контролю.',
            ],
        ],
    ],
    [
        'title' => 'Товари',
        'items' => [
            [
                'q' => 'Які документи потрібні для митного оформлення товарів?',
                'a' => 'Інвойс, пакувальний лист, транспортна накладна (CMR, авіа- чи морський коносамент), договір купівлі-продажу. Залежно від товару можуть знадобитись сертифікати чи дозволи — перевіримо перелік на консультації.',
            ],
            [
                'q' => 'Чи допомагаєте ви з визначенням коду УКТ ЗЕД?',
                'a' => 'Так, це один з перших кроків будь-якого оформлення. Помилка у коді може призвести до неправильного нарахування митних платежів або затримки оформлення — визначаємо код і перевіряємо його коректність до подання декларації.',
            ],
            [
                'q' => 'Чи можна оформити вантаж без особистої присутності?',
                'a' => 'Так, оформлення проходить за довіреністю. Ви надсилаєте документи, ми готуємо декларацію, супроводжуємо на митниці й повідомляємо про кожен етап.',
            ],
            [
                'q' => 'Які строки митного оформлення імпортних товарів?',
                'a' => 'Стандартно — до 4 годин з моменту отримання повного пакету документів. Затримки трапляються лише якщо митниця призначає додатковий огляд вантажу, що буває нечасто при правильно підготовлених документах.',
            ],
        ],
    ],
];

// flat list for the schema — one FAQPage, regardless of visual grouping
$faq_flat = [];
foreach ($faq_groups as $group) {
    foreach ($group['items'] as $item) {
        $faq_flat[] = $item;
    }
}
?>
<section class="faq" id="faq">

    <div class="container">

        <div class="section-heading">
            <h2>Відповіді на найпоширеніші запитання</h2>
            <p>Відповідаємо на найпоширеніші запитання про розмитнення автомобілів, вантажівок, автобусів, мотоциклів та митне оформлення товарів в Україні.</p>
        </div>

        <div class="faq__groups">
            <?php
            $faq_index = 0;
            foreach ($faq_groups as $group) :
            ?>
            <div class="faq__group">

                <h3 class="faq__group-title"><?php echo esc_html($group['title']); ?></h3>

                <div class="faq__list">
                    <?php foreach ($group['items'] as $item) : ?>
                    <div class="faq__item">
                        <button
                            class="faq__question"
                            type="button"
                            aria-expanded="false"
                            aria-controls="faq-answer-<?php echo esc_attr($faq_index); ?>"
                            id="faq-question-<?php echo esc_attr($faq_index); ?>"
                        >
                            <span><?php echo esc_html($item['q']); ?></span>
                            <svg class="faq__question-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true" focusable="false">
                                <path d="M4.5 6.75L9 11.25L13.5 6.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div
                            class="faq__answer"
                            id="faq-answer-<?php echo esc_attr($faq_index); ?>"
                            role="region"
                            aria-labelledby="faq-question-<?php echo esc_attr($faq_index); ?>"
                            hidden
                        >
                            <p><?php echo esc_html($item['a']); ?></p>
                        </div>
                    </div>
                    <?php $faq_index++; endforeach; ?>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

        <div class="faq__cta">
            <p>Не знайшли відповідь на своє запитання? Наші спеціалісти безкоштовно проконсультують саме щодо вашої ситуації.</p>
            <a href="#contact" class="btn">Отримати консультацію</a>
        </div>

    </div>

</section>
<?php
$faq_schema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map(
        function ($item) {
            return [
                '@type'          => 'Question',
                'name'           => $item['q'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text'  => $item['a'],
                ],
            ];
        },
        $faq_flat
    ),
];
?>
<script type="application/ld+json"><?php echo wp_json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?></script>
