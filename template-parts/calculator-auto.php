<section class="calculator" id="calculator">

    <div class="container">

        <div class="section-title">

            <span class="section-subtitle">Професійний інструмент</span>

            <h2>Калькулятор розмитнення авто CUSBRO</h2>

            <p>Точний розрахунок усіх митних платежів, акцизу, ПДВ та збору до Пенсійного фонду за методикою MDOffice.</p>

        </div>

        <div class="calculator-wrapper">

            <form id="autoCalculator" class="calculator-form">

                <div class="form-grid">

                    <div class="form-group">
                        <label for="vehicle_type">Тип транспортного засобу</label>
                        <select id="vehicle_type">
                            <option value="car">Легковий автомобіль</option>
                            <option value="truck">Вантажний автомобіль</option>
                            <option value="moto">Мотоцикл</option>
                            <option value="bus">Автобус</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="origin">Походження ТЗ</label>
                        <select id="origin">
                            <option value="eu">Країни ЄС</option>
                            <option value="other">Інші країни</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="importer_type">Тип імпортера</label>
                        <select id="importer_type">
                            <option value="individual">Фізична особа</option>
                            <option value="company">Юридична особа (пільгове мито з ЄС)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Вартість автомобіля</label>
                        <input type="number" id="price" placeholder="10000" min="0" required>
                    </div>

                    <div class="form-group">
                        <label for="currency">Валюта</label>
                        <select id="currency">
                            <option value="EUR">EUR (€)</option>
                            <option value="USD">USD ($)</option>
                            <option value="PLN">PLN (zł)</option>
                            <option value="UAH">UAH (₴)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="year">Рік випуску</label>
                        <input type="number" id="year" placeholder="2020" min="1980" max="2026" required>
                    </div>

                    <div class="form-group">
                        <label id="fuel_label" for="fuel">Тип двигуна / Паливо</label>
                        <select id="fuel">
                            <option value="petrol">Бензин</option>
                            <option value="diesel">Дизель</option>
                            <option value="hybrid">Гібрид</option>
                            <option value="electric">Електро</option>
                            <option value="gas">Газ (LPG)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label id="engine_label" for="engine">Об'єм двигуна (см³)</label>
                        <input type="number" id="engine" placeholder="1998" min="0" required>
                    </div>

                    <div class="form-group" id="truck_weight_group" style="display:none;">
                        <label for="truck_weight">Повна маса ТЗ</label>
                        <select id="truck_weight">
                            <option value="under5t">До 5 т</option>
                            <option value="from5to20t">Від 5 до 20 т</option>
                            <option value="over20t">Понад 20 т</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="first_reg">Перша реєстрація в Україні</label>
                        <select id="first_reg">
                            <option value="yes">Так (нараховувати Пенсійний фонд)</option>
                            <option value="no">Ні (вже зареєстроване в Україні)</option>
                        </select>
                    </div>

                </div>

                <button type="button" id="calcButton" class="btn btn--primary btn--full">

                    Розрахувати платежі

                </button>

            </form>

            <div class="calculator-result">

                <h3>Результати розрахунку</h3>

                <div class="rates-info" style="font-size: 13px; opacity: 0.8; margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.15); padding-bottom: 10px;">
                    Курси НБУ: 1 € = <span id="rate_eur">45.00</span> ₴ | 1 $ = <span id="rate_usd">41.50</span> ₴ | 1 zł = <span id="rate_pln">10.50</span> ₴
                </div>

                <div class="result-item">

                    <span>Митна вартість ТЗ</span>

                    <strong id="customs_val">0.00 €</strong>

                </div>

                <div class="result-item">

                    <span>Мито (<span id="duty_rate">10</span>%)</span>

                    <strong id="duty">0.00 €</strong>

                </div>

                <div class="result-item">

                    <span>Акцизний збір</span>

                    <strong id="excise">0.00 €</strong>

                </div>

                <div class="result-item">

                    <span>ПДВ (20%)</span>

                    <strong id="vat">0.00 €</strong>

                </div>

                <div class="result-item">

                    <span>Пенсійний фонд (<span id="pension_rate">0</span>%)</span>

                    <strong id="pension">0.00 €</strong>

                </div>

                <div class="result-total" style="margin-top: 20px; padding-top: 20px; border-top: 2px solid rgba(255,255,255,0.3);">

                    <span>Всього платежів</span>

                    <strong id="total">0.00 €</strong>

                </div>

                <div class="result-total-uah" style="display: flex; justify-content: space-between; font-size: 18px; margin-top: 10px; opacity: 0.9;">

                    <span>Всього в гривнях</span>

                    <strong id="total_uah">0 ₴</strong>

                </div>

                <div class="result-grand-total" style="display: flex; justify-content: space-between; font-size: 16px; margin-top: 15px; padding-top: 15px; border-top: 1px dashed rgba(255,255,255,0.2); opacity: 0.85;">

                    <span>Вартість з розмитненням</span>

                    <strong id="grand_total">0.00 €</strong>

                </div>

                <div class="calculator-actions">

                    <button type="button" id="btnSavePdf" class="btn btn--hero-outline">Зберегти в PDF</button>

                    <button type="button" id="btnShareLink" class="btn btn--hero-outline">Отримати посилання</button>

                    <button type="button" id="btnOrderThisCar" class="btn btn--primary">Замовити оформлення цього автомобіля</button>

                    <div id="shareLinkBox" class="share-link-box" style="display:none;">
                        <input type="text" id="shareLinkInput" readonly>
                        <span id="shareLinkCopied" class="share-link-copied" style="display:none;">Скопійовано!</span>
                    </div>

                </div>

            </div>

        </div>

        <div class="calculator-explainer">

            <details>
                <summary>Як рахуються платежі та на які норми ми спираємось</summary>

                <div class="explainer-content">

                    <h4>Мито</h4>
                    <p>10% від митної вартості транспортного засобу (Митний кодекс України). Ставка 5% для товарів походженням з ЄС застосовується лише для юридичних осіб. Електромобілі — мито 0%.</p>

                    <h4>Акцизний податок (ст. 215 Податкового кодексу України)</h4>
                    <ul>
                        <li><strong>Легкові авто (УКТ ЗЕД 8703):</strong> базова ставка (50€ бензин ≤3000см³, 100€ бензин &gt;3000см³, 75€ дизель ≤3500см³, 150€ дизель &gt;3500см³, 100€ гібрид, 1€/кВт·год електро) × (об'єм двигуна ÷ 1000) × віковий коефіцієнт (1 для нового авто, до 15 для авто старших 15 років).</li>
                        <li><strong>Вантажівки (УКТ ЗЕД 8704, п. 215.3.5-2):</strong> від 0,01 до 0,033 €/см³ залежно від маси ТЗ і типу палива (наведено ставки для вживаних ТЗ — вони кінцеві, без додаткового вікового коефіцієнта).</li>
                        <li><strong>Автобуси (УКТ ЗЕД 8702):</strong> 0,003 €/см³ для нових, 0,007 €/см³ для вживаних.</li>
                        <li><strong>Мотоцикли, мопеди, моторолери (УКТ ЗЕД 8711, п. 215.3.7):</strong> 0,062 €/см³ (до 500см³), 0,443 €/см³ (500–800см³), 0,447 €/см³ (понад 800см³); електро — 22€ за одиницю.</li>
                    </ul>

                    <h4>ПДВ</h4>
                    <p>20% від суми (митна вартість + мито + акциз). Електромобілі звільнені від ПДВ до 1 січня 2026 року, з цієї дати оподатковуються на загальних підставах.</p>

                    <h4>Збір до Пенсійного фонду</h4>
                    <p>Нараховується лише при першій реєстрації ТЗ в Україні: 3% від вартості авто в гривнях, 4% — якщо вартість перевищує 499 620 грн, 5% — якщо перевищує 878 120 грн.</p>

                    <p class="explainer-disclaimer">Розрахунок орієнтовний і не є остаточною сумою до сплати. Для точного розрахунку — зверніться до нас за безкоштовною консультацією.</p>

                </div>
            </details>

        </div>

        <div id="printSummary" class="print-only"></div>

    </div>

</section>