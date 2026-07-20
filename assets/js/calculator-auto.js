document.addEventListener("DOMContentLoaded", () => {

    const button = document.getElementById("calcButton");
    const fuelSelect = document.getElementById("fuel");
    const engineLabel = document.getElementById("engine_label");
    const engineInput = document.getElementById("engine");
    const vehicleTypeSelect = document.getElementById("vehicle_type");
    const truckWeightGroup = document.getElementById("truck_weight_group");

    if (!button) return;

    const FIELD_IDS = ["vehicle_type", "origin", "importer_type", "price", "currency", "year", "fuel", "engine", "truck_weight", "first_reg"];

    const LABELS = {
        vehicle_type: { car: "Легковий автомобіль", truck: "Вантажний автомобіль", moto: "Мотоцикл/мопед/моторолер", bus: "Автобус" },
        origin: { eu: "Країни ЄС", other: "Інші країни" },
        importer_type: { individual: "Фізична особа", company: "Юридична особа" },
        fuel: { petrol: "Бензин", diesel: "Дизель", hybrid: "Гібрид", electric: "Електро", gas: "Газ (LPG)" },
        first_reg: { yes: "Так", no: "Ні" }
    };

    let currentCalc = null;

    function getFormState() {
        const state = {};
        FIELD_IDS.forEach((id) => {
            const el = document.getElementById(id);
            if (el) state[id] = el.value;
        });
        return state;
    }

    function applyFormState(state) {
        FIELD_IDS.forEach((id) => {
            const el = document.getElementById(id);
            if (el && state[id] !== undefined) el.value = state[id];
        });
    }

    // Dynamic label and placeholder changes based on fuel type
    fuelSelect.addEventListener("change", () => {
        if (fuelSelect.value === "electric") {
            engineLabel.textContent = "Ємність батареї (кВт·год)";
            engineInput.placeholder = "60";
        } else {
            engineLabel.textContent = "Об'єм двигуна (см³)";
            engineInput.placeholder = "1998";
        }
    });

    // Dynamic form adjustments based on vehicle type
    vehicleTypeSelect.addEventListener("change", () => {
        const type = vehicleTypeSelect.value;
        if (type === "moto" && fuelSelect.value !== "electric") {
            engineLabel.textContent = "Об'єм двигуна (см³)";
            engineInput.placeholder = "650";
        }
        truckWeightGroup.style.display = type === "truck" ? "flex" : "none";
    });

    function runCalculation() {
        const vehicleType = vehicleTypeSelect.value;
        const origin = document.getElementById("origin").value;
        const importerType = document.getElementById("importer_type").value;
        const price = parseFloat(document.getElementById("price").value) || 0;
        const currency = document.getElementById("currency").value;
        const firstReg = document.getElementById("first_reg").value;
        const fuel = fuelSelect.value;
        const engine = parseFloat(engineInput.value) || 0;
        const year = parseInt(document.getElementById("year").value) || new Date().getFullYear();

        // Exchange rates (NBU)
        const EUR_TO_UAH = 45.00;
        const USD_TO_UAH = 41.50;
        const PLN_TO_UAH = 10.50;

        // Convert price to EUR and UAH
        let priceInEur = price;
        if (currency === "USD") {
            priceInEur = price * (USD_TO_UAH / EUR_TO_UAH);
        } else if (currency === "PLN") {
            priceInEur = price * (PLN_TO_UAH / EUR_TO_UAH);
        } else if (currency === "UAH") {
            priceInEur = price / EUR_TO_UAH;
        }
        const priceInUah = priceInEur * EUR_TO_UAH;

        // 1. Duty (Мито)
        let dutyRate = 10; // Default standard duty
        if (fuel === "electric") {
            dutyRate = 0;
        } else if (origin === "eu" && importerType === "company") {
            dutyRate = 5; // Reduced EU duty rate — only for legal entities
        }
        const duty = priceInEur * (dutyRate / 100);

        // 2. Excise (Акциз)
        let excise = 0;
        const currentYear = new Date().getFullYear();
        let age = currentYear - year - 1;
        if (age < 1) age = 1;
        if (age > 15) age = 15;

        if (vehicleType === "car") {
            if (fuel === "electric") {
                // Electric cars: 1 EUR per 1 kWh of battery capacity
                const batteryCapacity = engine > 0 ? engine : 60;
                excise = batteryCapacity * 1;
            } else if (fuel === "hybrid") {
                excise = 100;
            } else {
                // Petrol, Diesel, Gas
                let baseRate = 50; // Petrol <= 3000 cm³
                if (fuel === "petrol" || fuel === "gas") {
                    if (engine > 3000) {
                        baseRate = 100;
                    }
                } else if (fuel === "diesel") {
                    baseRate = engine > 3500 ? 150 : 75;
                }
                excise = baseRate * (engine / 1000) * age;
            }
        } else if (vehicleType === "moto") {
            // Мотоцикли, мопеди, моторолери (УКТ ЗЕД 8711, п.215.3.7 ПКУ) — фіксована ставка за см³, без вікового коефіцієнта
            if (fuel === "electric") {
                excise = 22; // Електричні мотоцикли/мопеди — 22 € за штуку
            } else if (engine <= 500) {
                excise = engine * 0.062;
            } else if (engine <= 800) {
                excise = engine * 0.443;
            } else {
                excise = engine * 0.447;
            }
        } else if (vehicleType === "truck") {
            // Акциз для вантажівок (УКТ ЗЕД 8704, п.215.3.5-2 ПКУ), ставки "вживані" — кінцеві, без вікового коефіцієнта
            const truckWeight = document.getElementById("truck_weight").value;
            let rate;
            if (fuel === "diesel") {
                if (truckWeight === "over20t") rate = 0.033;
                else if (truckWeight === "from5to20t") rate = 0.026;
                else rate = 0.02;
            } else {
                // Бензин/газ/гібрид/електро: підтверджені лише ставки для дизеля та бензину,
                // тому для інших типів палива застосовується бензинова шкала як найближче наближення
                rate = truckWeight === "under5t" ? 0.02 : 0.026;
            }
            excise = engine * rate;
        } else if (vehicleType === "bus") {
            // Автобуси, 10+ місць (УКТ ЗЕД 8702, п.215.3.5 ПКУ): 0.003 €/см³ нові, 0.007 €/см³ вживані
            const isNewVehicle = year >= currentYear;
            excise = engine * (isNewVehicle ? 0.003 : 0.007);
        }

        // 3. VAT (ПДВ)
        // Electric cars are exempt from VAT in Ukraine until Jan 1, 2026.
        // From Jan 1, 2026, they pay 20% VAT, but remain exempt from duty.
        let vat = 0;
        if (fuel !== "electric") {
            vat = (priceInEur + duty + excise) * 0.20;
        } else {
            if (currentYear >= 2026) {
                vat = (priceInEur + duty + excise) * 0.20;
            }
        }

        // 4. Pension Fund (Пенсійний фонд)
        let pension = 0;
        let pensionRate = 0;
        if (firstReg === "yes") {
            pensionRate = 3;
            if (priceInUah > 878120) {
                pensionRate = 5;
            } else if (priceInUah > 499620) {
                pensionRate = 4;
            }
            const pensionInUah = priceInUah * (pensionRate / 100);
            pension = pensionInUah / EUR_TO_UAH;
        }

        // 5. Totals
        const totalCustoms = duty + excise + vat;
        const totalCustomsUah = totalCustoms * EUR_TO_UAH;
        const grandTotal = priceInEur + totalCustoms + pension;

        // Update UI
        document.getElementById("customs_val").innerHTML = priceInEur.toFixed(2) + " €";
        document.getElementById("duty_rate").innerHTML = dutyRate;
        document.getElementById("duty").innerHTML = duty.toFixed(2) + " €";
        document.getElementById("excise").innerHTML = excise.toFixed(2) + " €";
        document.getElementById("vat").innerHTML = vat.toFixed(2) + " €";
        document.getElementById("pension_rate").innerHTML = pensionRate;
        document.getElementById("pension").innerHTML = pension.toFixed(2) + " €";
        document.getElementById("total").innerHTML = totalCustoms.toFixed(2) + " €";
        document.getElementById("total_uah").innerHTML = Math.round(totalCustomsUah).toLocaleString("uk-UA") + " ₴";
        document.getElementById("grand_total").innerHTML = grandTotal.toFixed(2) + " €";

        currentCalc = {
            form: getFormState(),
            priceInEur, dutyRate, duty, excise, vat, pensionRate, pension,
            totalCustoms, totalCustomsUah, grandTotal
        };
    }

    button.addEventListener("click", runCalculation);

    // Prefill from a shared link (?price=...&year=...&fuel=... etc.) and auto-calculate
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("price")) {
        const state = {};
        FIELD_IDS.forEach((id) => {
            if (urlParams.has(id)) state[id] = urlParams.get(id);
        });
        applyFormState(state);
        truckWeightGroup.style.display = vehicleTypeSelect.value === "truck" ? "flex" : "none";
        if (fuelSelect.value === "electric") {
            engineLabel.textContent = "Ємність батареї (кВт·год)";
            engineInput.placeholder = "60";
        }
        runCalculation();
    }

    // Share link
    const btnShareLink = document.getElementById("btnShareLink");
    if (btnShareLink) {
        btnShareLink.addEventListener("click", () => {
            const params = new URLSearchParams(getFormState());
            const url = window.location.origin + window.location.pathname + "?" + params.toString() + "#calculator";
            const box = document.getElementById("shareLinkBox");
            const input = document.getElementById("shareLinkInput");
            const copiedLabel = document.getElementById("shareLinkCopied");

            box.style.display = "flex";
            input.value = url;
            input.select();

            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(() => {
                    copiedLabel.style.display = "inline";
                    setTimeout(() => { copiedLabel.style.display = "none"; }, 2000);
                });
            }
        });
    }

    function buildPrintSummaryHtml(calc) {
        const f = calc.form;
        const dateStr = new Date().toLocaleString("uk-UA");

        return "<h1>Розрахунок митних платежів — CUSBRO</h1>"
            + "<p>Дата розрахунку: " + dateStr + "</p>"
            + "<h2>Параметри транспортного засобу</h2>"
            + "<table>"
            + "<tr><td>Тип ТЗ</td><td>" + (LABELS.vehicle_type[f.vehicle_type] || f.vehicle_type) + "</td></tr>"
            + "<tr><td>Походження</td><td>" + (LABELS.origin[f.origin] || f.origin) + "</td></tr>"
            + "<tr><td>Тип імпортера</td><td>" + (LABELS.importer_type[f.importer_type] || f.importer_type) + "</td></tr>"
            + "<tr><td>Вартість</td><td>" + f.price + " " + f.currency + "</td></tr>"
            + "<tr><td>Рік випуску</td><td>" + f.year + "</td></tr>"
            + "<tr><td>Паливо</td><td>" + (LABELS.fuel[f.fuel] || f.fuel) + "</td></tr>"
            + "<tr><td>Об'єм двигуна / ємність батареї</td><td>" + f.engine + "</td></tr>"
            + "<tr><td>Перша реєстрація в Україні</td><td>" + (LABELS.first_reg[f.first_reg] || f.first_reg) + "</td></tr>"
            + "</table>"
            + "<h2>Результати розрахунку</h2>"
            + "<table>"
            + "<tr><td>Митна вартість</td><td>" + calc.priceInEur.toFixed(2) + " €</td></tr>"
            + "<tr><td>Мито (" + calc.dutyRate + "%)</td><td>" + calc.duty.toFixed(2) + " €</td></tr>"
            + "<tr><td>Акцизний збір</td><td>" + calc.excise.toFixed(2) + " €</td></tr>"
            + "<tr><td>ПДВ (20%)</td><td>" + calc.vat.toFixed(2) + " €</td></tr>"
            + "<tr><td>Пенсійний фонд (" + calc.pensionRate + "%)</td><td>" + calc.pension.toFixed(2) + " €</td></tr>"
            + "<tr><td><strong>Всього платежів</strong></td><td><strong>" + calc.totalCustoms.toFixed(2) + " €</strong></td></tr>"
            + "<tr><td>Всього в гривнях</td><td>" + Math.round(calc.totalCustomsUah).toLocaleString("uk-UA") + " ₴</td></tr>"
            + "<tr><td>Вартість з розмитненням</td><td>" + calc.grandTotal.toFixed(2) + " €</td></tr>"
            + "</table>"
            + "<p>Орієнтовний розрахунок за методикою CUSBRO на основі ст. 215 Податкового кодексу України. Не є остаточною сумою до сплати.</p>";
    }

    // Save as PDF (via native browser print)
    const btnSavePdf = document.getElementById("btnSavePdf");
    if (btnSavePdf) {
        btnSavePdf.addEventListener("click", () => {
            if (!currentCalc) {
                alert("Спочатку натисніть «Розрахувати платежі»");
                return;
            }
            document.getElementById("printSummary").innerHTML = buildPrintSummaryHtml(currentCalc);
            window.print();
        });
    }

    // Order this exact car — pass data into the contact form
    const btnOrderThisCar = document.getElementById("btnOrderThisCar");
    if (btnOrderThisCar) {
        btnOrderThisCar.addEventListener("click", () => {
            if (!currentCalc) {
                alert("Спочатку натисніть «Розрахувати платежі»");
                return;
            }
            const f = currentCalc.form;
            const message = document.getElementById("contact-message");
            if (message) {
                message.value = "Прошу розрахувати/оформити авто:\n"
                    + "Тип ТЗ: " + (LABELS.vehicle_type[f.vehicle_type] || f.vehicle_type) + "\n"
                    + "Походження: " + (LABELS.origin[f.origin] || f.origin) + "\n"
                    + "Вартість: " + f.price + " " + f.currency + "\n"
                    + "Рік випуску: " + f.year + "\n"
                    + "Паливо: " + (LABELS.fuel[f.fuel] || f.fuel) + "\n"
                    + "Об'єм двигуна/батареї: " + f.engine + "\n"
                    + "Орієнтовна сума платежів: " + currentCalc.totalCustoms.toFixed(2) + " € ("
                    + Math.round(currentCalc.totalCustomsUah).toLocaleString("uk-UA") + " ₴)";
            }
            const contactSection = document.getElementById("contact");
            if (contactSection) {
                contactSection.scrollIntoView({ behavior: "smooth" });
            }
            const nameField = document.getElementById("contact-name");
            if (nameField) nameField.focus();
        });
    }

});
