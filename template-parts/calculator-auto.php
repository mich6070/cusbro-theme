<?php
/**
 * Calculator — preliminary customs cost estimate
 */

if (!defined('ABSPATH')) {
    exit;
}

$cusbro_nbu_rates = cusbro_get_nbu_rates();
?>
<section class="calculator" id="calculator" aria-labelledby="calculator-title">

    <div class="container">

        <div class="calculator__header">
            <h2 class="calculator__title" id="calculator-title">Попередній розрахунок вартості</h2>
            <p class="calculator__subtitle">
                Орієнтовний розрахунок митних платежів відповідно до чинного законодавства України.
            </p>
        </div>

        <div class="calculator__grid">

            <form class="calculator__form" id="autoCalculator">

                <div class="calculator__field">
                    <label for="vehicle_type">Тип транспортного засобу</label>
                    <select id="vehicle_type" name="vehicle_type">
                        <option value="car">Легковий автомобіль</option>
                        <option value="truck">Вантажний автомобіль</option>
                        <option value="moto">Мотоцикл</option>
                        <option value="bus">Автобус</option>
                    </select>
                </div>

                <div class="calculator__field calculator__field--price">
                    <label for="price">Вартість автомобіля</label>
                    <div class="calculator__price-row">
                        <input type="number" id="price" name="price" placeholder="10000" min="0" required>
                        <select id="currency" name="currency" aria-label="Валюта">
                            <option value="EUR">EUR (€)</option>
                            <option value="USD">USD ($)</option>
                            <option value="PLN">PLN (zł)</option>
                            <option value="UAH">UAH (₴)</option>
                        </select>
                    </div>
                </div>

                <div class="calculator__field" id="year_group">
                    <label id="year_label" for="year">Рік випуску</label>
                    <input type="number" id="year" name="year" placeholder="2020" min="1980" max="<?php echo esc_attr(current_time('Y')); ?>" required>
                </div>

                <div class="calculator__field">
                    <label id="fuel_label" for="fuel">Тип двигуна / Паливо</label>
                    <select id="fuel" name="fuel">
                        <option value="petrol">Бензин</option>
                        <option value="diesel">Дизель</option>
                        <option value="hybrid_petrol">Гібрид (бензин)</option>
                        <option value="hybrid_diesel">Гібрид (дизель)</option>
                        <option value="electric">Електро</option>
                        <option value="gas">Газ (LPG)</option>
                    </select>
                </div>

                <div class="calculator__field" id="engine_group">
                    <label id="engine_label" for="engine">Об'єм двигуна (см³)</label>
                    <input type="number" id="engine" name="engine" placeholder="1998" min="0" max="30000" required>
                </div>

                <div class="calculator__field calculator__field--wide" id="condition_group" hidden>
                    <label for="condition">Стан транспортного засобу</label>
                    <select id="condition" name="condition">
                        <option value="used" selected>Вживане (було зареєстроване)</option>
                        <option value="new">Нове (не реєструвалося)</option>
                    </select>
                </div>

                <div class="calculator__field calculator__field--wide" id="registration_date_group" hidden>
                    <label for="registration_date">Дата першої реєстрації</label>
                    <input type="date" id="registration_date" name="registration_date" max="<?php echo esc_attr(current_time('Y-m-d')); ?>">
                </div>

                <div class="calculator__field calculator__field--wide" id="truck_weight_group" hidden>
                    <label for="truck_weight">Повна маса транспортного засобу</label>
                    <select id="truck_weight" name="truck_weight">
                        <option value="under5t">До 5 т</option>
                        <option value="from5to20t">Від 5 до 20 т</option>
                        <option value="over20t">Понад 20 т</option>
                    </select>
                </div>

                <button type="button" id="calcButton" class="btn btn--primary btn--full calculator__submit">
                    Розрахувати
                </button>

            </form>

            <div class="calculator__result" id="calculatorResult">

                <p class="calculator__result-badge">
                    <span>Безкоштовно</span>
                    <span aria-hidden="true">·</span>
                    <span>За 30 секунд</span>
                </p>

                <div class="calculator__result-placeholder" id="resultPlaceholder">
                    <p>Заповніть форму зліва — і за 30 секунд дізнаєтесь орієнтовну вартість розмитнення.</p>
                </div>

                <div class="calculator__result-content" id="resultContent" hidden>

                    <p class="calculator__result-label">Орієнтовна вартість розмитнення</p>

                    <p class="calculator__result-amount">
                        <span id="grand_total">0</span> <span id="grand_total_currency">€</span>
                    </p>
                    <p class="calculator__result-amount-secondary">
                        ≈ <span id="grand_total_secondary_1">0</span> <span id="grand_total_secondary_1_currency">₴</span>
                    </p>
                    <p class="calculator__result-amount-secondary">
                        ≈ <span id="grand_total_secondary_2">0</span> <span id="grand_total_secondary_2_currency">$</span>
                    </p>

                    <ul class="calculator__result-checklist">
                        <li>мито</li>
                        <li>акциз</li>
                        <li>ПДВ</li>
                    </ul>

                    <div class="calculator__result-pension">
                        <span class="calculator__result-pension-label">Пенсійний збір (окремо)</span>
                        <span class="calculator__result-pension-amount">
                            <span class="calculator__result-pension-amount-primary"><span id="pension_total">0</span> <span id="pension_total_currency">€</span></span>
                            <span class="calculator__result-pension-amount-secondary">≈ <span id="pension_total_secondary">0</span> <span id="pension_total_secondary_currency">₴</span></span>
                        </span>
                    </div>

                    <p class="calculator__result-note">
                        Розрахунок виконано за стандартною ставкою. Якщо автомобіль має митні пільги
                        або походить з країни, з якою діють спеціальні умови, ми врахуємо це під час
                        безкоштовної консультації.
                    </p>

                    <p class="calculator__result-note">
                        Пенсійний збір показано окремо від вартості розмитнення. Під час консультації
                        ми перевіримо, чи застосовується він саме у вашому випадку.
                    </p>

                    <p class="calculator__result-rate">
                        <?php if (!empty($cusbro_nbu_rates['live']) && !empty($cusbro_nbu_rates['date'])) : ?>
                            Розрахунок виконано за курсом НБУ станом на <?php echo esc_html($cusbro_nbu_rates['date']); ?>.
                        <?php else : ?>
                            Розрахунок виконано за орієнтовним курсом — живий курс НБУ тимчасово недоступний.
                        <?php endif; ?>
                    </p>

                    <div class="calculator__reassure">
                        <p class="calculator__reassure-title">Хочете точну суму?</p>
                        <p class="calculator__reassure-desc">
                            Перевіримо документи безкоштовно та назвемо остаточну вартість до початку оформлення.
                        </p>
                        <a href="#contact" class="calculator__cta">
                            <span>Отримати точний розрахунок</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                                <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>

                </div>

            </div>

        </div>

        <div class="calculator__explainer">
            <details>
                <summary>Хочете дізнатися, як формується розрахунок?</summary>
                <div class="calculator__explainer-content">

                    <h3>Мито</h3>
                    <p>
                        10% від вартості транспортного засобу. Виняток — легкові електромобілі: 0%.
                        Електричні вантажівки, автобуси й мотоцикли оподатковуються за стандартною
                        ставкою 10%. Для юридичних осіб та автомобілів походженням з ЄС може
                        застосовуватись пільгова ставка 5% — це уточнюється на консультації.
                    </p>

                    <h3>Акцизний податок</h3>
                    <p>
                        Залежить від типу транспорту, об'єму двигуна, віку та стану автомобіля. Для легкових
                        авто з двигуном внутрішнього згоряння (включно з гібридами) враховується вік —
                        чим старше авто, тим вища ставка. Для електромобілів вік не враховується — ставка
                        фіксована за кожну кВт·год ємності акумулятора. Для вантажівок і автобусів,
                        що вже були зареєстровані, ставка різко зростає після 5 та 8 років експлуатації;
                        для нових (незареєстрованих) транспортних засобів діє окрема, нижча ставка.
                        Для мотоциклів з двигуном внутрішнього згоряння — фіксовані ставки за см³;
                        для електромотоциклів — окрема фіксована ставка незалежно від об'єму.
                    </p>

                    <h3>ПДВ</h3>
                    <p>
                        20% від суми вартості авто, мита та акцизу разом.
                    </p>

                    <h3>Пенсійний збір</h3>
                    <p>
                        Збір, що стягується при першій реєстрації транспортного засобу в Україні —
                        показаний окремо від вартості розмитнення вище. Ми перевіримо, чи застосовується
                        він саме у вашому випадку, під час консультації.
                    </p>

                    <p class="calculator__explainer-disclaimer">
                        Розрахунок орієнтовний і не є остаточною сумою до сплати. Для точної суми —
                        зверніться до нас за безкоштовною консультацією.
                    </p>

                </div>
            </details>
        </div>

    </div>

</section>
