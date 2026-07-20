document.addEventListener("DOMContentLoaded", () => {

    const button = document.getElementById("calcButton");
    if (!button) return;

    // Live NBU rates come from PHP (inc/helpers.php::cusbro_get_nbu_rates,
    // localized in inc/enqueue.php) — cached server-side, refreshed a few
    // times a day. These hardcoded values are only the last-resort
    // fallback if that localization is missing entirely
    const nbuRates = window.CusbroCalcRates || {};

    // Every rate, threshold, and coefficient the calculation depends on
    // lives here — nowhere else in this file. When the law changes,
    // this is the only block that needs editing.
    const CALC_CONFIG = {
        RATES_TO_UAH: {
            EUR: nbuRates.EUR || 45.00,
            USD: nbuRates.USD || 41.50,
            PLN: nbuRates.PLN || 10.50,
            UAH: 1
        },

        CURRENCY_SYMBOLS: { EUR: "€", USD: "$", PLN: "zł", UAH: "₴" },

        // the result always leads with whichever currency the visitor
        // priced the car in (freshest in their head), then shows these
        // as smaller reference lines — UAH first since that's what's
        // actually paid, then EUR as the calculator's own base currency
        // (or USD, if EUR was already the primary)
        SECONDARY_CURRENCIES: {
            EUR: ["UAH", "USD"],
            USD: ["UAH", "EUR"],
            PLN: ["UAH", "EUR"],
            UAH: ["EUR", "USD"]
        },

        DUTY: {
            STANDARD_PERCENT: 10,
            ELECTRIC_PERCENT: 0,
            // УКТ ЗЕД 8702 10 11 30 / 8702 10 19 90 / 8702 20 10 90: diesel
            // and diesel-hybrid buses over 5000cm³ carry 20%, not the
            // standard 10% — confirmed against the official Митний тариф.
            // Smaller diesel buses, all petrol/petrol-hybrid, and electric
            // (non-trolleybus) stay at the standard rate
            BUS_LARGE_DIESEL_PERCENT: 20,
            BUS_LARGE_DIESEL_THRESHOLD_CM3: 5000
        },

        VAT: { RATE: 0.20 },

        PENSION: {
            // checked top-down, first match wins
            TIERS: [
                { minUah: 878120, ratePercent: 5 },
                { minUah: 499620, ratePercent: 4 },
                { minUah: 0, ratePercent: 3 }
            ]
        },

        AGE: { MIN_YEARS: 1, MAX_YEARS: 15 },

        EXCISE: {
            car: {
                ELECTRIC_EUR_PER_KWH: 1,
                ELECTRIC_DEFAULT_KWH: 60,
                PETROL: { THRESHOLD_CM3: 3000, RATE_BELOW: 50, RATE_ABOVE: 100 },
                DIESEL: { THRESHOLD_CM3: 3500, RATE_BELOW: 75, RATE_ABOVE: 150 }
            },
            moto: {
                ELECTRIC_FLAT_EUR: 22,
                // checked in order, first tier whose maxCm3 fits wins
                TIERS: [
                    { maxCm3: 500, ratePerCm3: 0.062 },
                    { maxCm3: 800, ratePerCm3: 0.443 },
                    { maxCm3: Infinity, ratePerCm3: 0.447 }
                ]
            },
            truck: {
                // "new" = never registered, flat rate by weight, age is
                // irrelevant. "used" = registered at least once — base
                // rate by weight, multiplied by the age coefficient below
                WEIGHT_RATES: {
                    under5t: { NEW_PER_CM3: 0.01, USED_BASE_PER_CM3: 0.02 },
                    from5to20t: { NEW_PER_CM3: 0.013, USED_BASE_PER_CM3: 0.026 },
                    over20t: { NEW_PER_CM3: 0.016, USED_BASE_PER_CM3: 0.033 }
                },
                // checked in order, first tier whose maxYears fits wins
                // "до 5 років" is exclusive of 5 itself — a vehicle with
                // exactly 5 full years elapsed is already "від 5 до 8",
                // not "до 5". Only the lower bound of each tier is a firm
                // legal boundary; upper bounds just fill the gap to the
                // next tier's start
                USED_AGE_COEFFICIENTS: [
                    { minYears: 0, maxYears: 4, multiplier: 1 },
                    { minYears: 5, maxYears: 8, multiplier: 40 },
                    { minYears: 9, maxYears: Infinity, multiplier: 50 }
                ]
            },
            bus: {
                NEW_RATE_PER_CM3: 0.003,
                USED_RATE_PER_CM3: 0.007,
                USED_OVER_8_YEARS_MULTIPLIER: 50
            }
        }
    };

    const form = document.getElementById("autoCalculator");
    const fuelSelect = document.getElementById("fuel");
    const engineGroup = document.getElementById("engine_group");
    const engineLabel = document.getElementById("engine_label");
    const engineInput = document.getElementById("engine");
    const vehicleTypeSelect = document.getElementById("vehicle_type");
    const truckWeightGroup = document.getElementById("truck_weight_group");
    const truckWeightSelect = document.getElementById("truck_weight");
    const conditionGroup = document.getElementById("condition_group");
    const conditionSelect = document.getElementById("condition");
    const yearGroup = document.getElementById("year_group");
    const yearInput = document.getElementById("year");
    const registrationDateGroup = document.getElementById("registration_date_group");
    const registrationDateInput = document.getElementById("registration_date");
    const resultPanel = document.getElementById("calculatorResult");
    const resultPlaceholder = document.getElementById("resultPlaceholder");
    const resultContent = document.getElementById("resultContent");
    const grandTotalEl = document.getElementById("grand_total");
    const grandTotalCurrencyEl = document.getElementById("grand_total_currency");
    const grandTotalSecondary1El = document.getElementById("grand_total_secondary_1");
    const grandTotalSecondary1CurrencyEl = document.getElementById("grand_total_secondary_1_currency");
    const grandTotalSecondary2El = document.getElementById("grand_total_secondary_2");
    const grandTotalSecondary2CurrencyEl = document.getElementById("grand_total_secondary_2_currency");
    const pensionTotalEl = document.getElementById("pension_total");
    const pensionTotalCurrencyEl = document.getElementById("pension_total_currency");
    const pensionTotalSecondaryEl = document.getElementById("pension_total_secondary");
    const pensionTotalSecondaryCurrencyEl = document.getElementById("pension_total_secondary_currency");

    function updateEngineField() {
        // moto excise is a flat electric rate that never reads engine
        // volume — showing a required field the calculation ignores
        // would be a dead input, so it hides instead of just relabeling
        if (vehicleTypeSelect.value === "moto" && fuelSelect.value === "electric") {
            engineGroup.hidden = true;
            engineInput.required = false;
            return;
        }

        engineGroup.hidden = false;
        engineInput.required = true;

        if (fuelSelect.value === "electric") {
            engineLabel.textContent = "Ємність батареї (кВт·год)";
            engineInput.placeholder = String(CALC_CONFIG.EXCISE.car.ELECTRIC_DEFAULT_KWH);
        } else {
            engineLabel.textContent = "Об'єм двигуна (см³)";
            engineInput.placeholder = vehicleTypeSelect.value === "moto" ? "650" : "1998";
        }
    }

    // year never enters the electric-car formula (duty is flat 0%, excise
    // is battery kWh × rate, VAT checks today's calendar year, not the
    // vehicle's) — asking for it there is a dead field, not just unused.
    // moto excise is engine-volume-only regardless of fuel — never reads
    // year either. Trucks/buses don't use this field at all anymore —
    // see updateRegistrationDateField below
    function updateYearField() {
        const isElectricCar = vehicleTypeSelect.value === "car" && fuelSelect.value === "electric";
        const isTruckOrBus = vehicleTypeSelect.value === "truck" || vehicleTypeSelect.value === "bus";
        const isMoto = vehicleTypeSelect.value === "moto";
        const hide = isElectricCar || isTruckOrBus || isMoto;
        yearGroup.hidden = hide;
        yearInput.required = !hide;
    }

    // motorcycles physically don't come in diesel/hybrid/LPG variants —
    // only a petrol piston engine (крив.-шатунний механізм) or electric
    function updateFuelOptionsForVehicleType() {
        const isMoto = vehicleTypeSelect.value === "moto";
        const motoIncompatibleFuels = ["diesel", "hybrid_petrol", "hybrid_diesel", "gas"];

        motoIncompatibleFuels.forEach((value) => {
            const option = fuelSelect.querySelector(`option[value="${value}"]`);
            if (option) option.hidden = isMoto;
        });

        // don't silently keep an impossible combination if the current
        // selection just became invalid for this vehicle type
        if (isMoto && motoIncompatibleFuels.includes(fuelSelect.value)) {
            fuelSelect.value = "petrol";
        }
    }

    // trucks/buses age off the exact first-registration date, not a
    // calendar-year difference — only meaningful for "used" (a "new",
    // never-registered vehicle has no registration date to give)
    function updateRegistrationDateField() {
        const isTruckOrBus = vehicleTypeSelect.value === "truck" || vehicleTypeSelect.value === "bus";
        const show = isTruckOrBus && conditionSelect.value === "used";
        registrationDateGroup.hidden = !show;
        registrationDateInput.required = show;
    }

    fuelSelect.addEventListener("change", () => {
        updateEngineField();
        updateYearField();
    });

    conditionSelect.addEventListener("change", updateRegistrationDateField);

    vehicleTypeSelect.addEventListener("change", () => {
        const isTruck = vehicleTypeSelect.value === "truck";
        const isBus = vehicleTypeSelect.value === "bus";
        truckWeightGroup.hidden = !isTruck;
        conditionGroup.hidden = !(isTruck || isBus);
        updateFuelOptionsForVehicleType();
        updateEngineField();
        updateYearField();
        updateRegistrationDateField();
    });

    function priceToEur(price, currency) {
        const rates = CALC_CONFIG.RATES_TO_UAH;
        const priceInUah = price * rates[currency];
        return priceInUah / rates.EUR;
    }

    function calculateDuty(priceInEur, fuel, vehicleType, engine) {
        const cfg = CALC_CONFIG.DUTY;

        // the 0% electric exemption is specific to passenger cars
        // (8703 80) — electric trucks (8704 60 00 00), buses
        // (8702 40 00 90), and motorcycles (8711 60) all pay the
        // standard rate per the official Митний тариф, confirmed
        // against the full 8701-8716 table
        const isElectricCarExemption = fuel === "electric" && vehicleType === "car";
        let rate = isElectricCarExemption ? cfg.ELECTRIC_PERCENT : cfg.STANDARD_PERCENT;

        // "gas" (LPG) intentionally falls through to the spark-ignition
        // rate below — LPG is a conversion of a petrol engine, not its own
        // УКТ ЗЕД category, confirmed decision, not an oversight
        const isDieselLike = fuel === "diesel" || fuel === "hybrid_diesel";
        if (vehicleType === "bus" && isDieselLike && engine > cfg.BUS_LARGE_DIESEL_THRESHOLD_CM3) {
            rate = cfg.BUS_LARGE_DIESEL_PERCENT;
        }

        return priceInEur * (rate / 100);
    }

    function calculateVehicleAge(year) {
        const currentYear = new Date().getFullYear();
        const age = currentYear - year - 1;
        const { MIN_YEARS, MAX_YEARS } = CALC_CONFIG.AGE;
        return Math.min(Math.max(age, MIN_YEARS), MAX_YEARS);
    }

    function calculateCarExcise(fuel, engine, year) {
        const cfg = CALC_CONFIG.EXCISE.car;

        if (fuel === "electric") {
            const batteryCapacity = engine > 0 ? engine : cfg.ELECTRIC_DEFAULT_KWH;
            return batteryCapacity * cfg.ELECTRIC_EUR_PER_KWH;
        }

        // Law № 2611-VIII has no separate hybrid rate — a hybrid still has
        // a combustion engine and is taxed by its ignition type (petrol or
        // diesel), same as any other 8703 vehicle. "gas" (LPG) is the same
        // spark-ignition engine as petrol, just converted — confirmed, not
        // an oversight
        const isDieselLike = fuel === "diesel" || fuel === "hybrid_diesel";
        const scale = isDieselLike ? cfg.DIESEL : cfg.PETROL;
        const baseRate = engine > scale.THRESHOLD_CM3 ? scale.RATE_ABOVE : scale.RATE_BELOW;
        return baseRate * (engine / 1000) * calculateVehicleAge(year);
    }

    function calculateMotoExcise(fuel, engine) {
        const cfg = CALC_CONFIG.EXCISE.moto;
        if (fuel === "electric") return cfg.ELECTRIC_FLAT_EUR;
        const tier = cfg.TIERS.find((t) => engine <= t.maxCm3);
        return engine * tier.ratePerCm3;
    }

    // truck/bus age off the exact first-registration date — a calendar-
    // year subtraction (like calculateVehicleAge for cars) can be off by
    // almost a full year depending on the month, and the age bracket
    // (5/8-year thresholds) is exactly where that gap matters. Counts
    // full years actually elapsed, not just calendar years crossed
    function calculateFullYearsElapsed(dateString) {
        if (!dateString) return 0;

        const regDate = new Date(dateString);
        const today = new Date();

        let years = today.getFullYear() - regDate.getFullYear();
        const hadAnniversaryThisYear =
            today.getMonth() > regDate.getMonth() ||
            (today.getMonth() === regDate.getMonth() && today.getDate() >= regDate.getDate());

        if (!hadAnniversaryThisYear) {
            years -= 1;
        }

        return Math.max(years, 0);
    }

    function calculateTruckExcise(condition, engine, registrationDate, truckWeight) {
        const cfg = CALC_CONFIG.EXCISE.truck;
        const rates = cfg.WEIGHT_RATES[truckWeight];

        if (condition === "new") {
            return engine * rates.NEW_PER_CM3;
        }

        const age = calculateFullYearsElapsed(registrationDate);
        const tier = cfg.USED_AGE_COEFFICIENTS.find((t) => age >= t.minYears && age <= t.maxYears);
        return engine * rates.USED_BASE_PER_CM3 * tier.multiplier;
    }

    function calculateBusExcise(condition, engine, registrationDate) {
        const cfg = CALC_CONFIG.EXCISE.bus;

        if (condition === "new") {
            return engine * cfg.NEW_RATE_PER_CM3;
        }

        const age = calculateFullYearsElapsed(registrationDate);
        const multiplier = age > 8 ? cfg.USED_OVER_8_YEARS_MULTIPLIER : 1;
        return engine * cfg.USED_RATE_PER_CM3 * multiplier;
    }

    function calculateExcise(vehicleType, fuel, engine, year, truckWeight, condition, registrationDate) {
        switch (vehicleType) {
            case "car": return calculateCarExcise(fuel, engine, year);
            case "moto": return calculateMotoExcise(fuel, engine);
            case "truck": return calculateTruckExcise(condition, engine, registrationDate, truckWeight);
            case "bus": return calculateBusExcise(condition, engine, registrationDate);
            default: return 0;
        }
    }

    function calculateVat(priceInEur, duty, excise) {
        return (priceInEur + duty + excise) * CALC_CONFIG.VAT.RATE;
    }

    function calculatePension(priceInUah) {
        const tiers = CALC_CONFIG.PENSION.TIERS;
        const tier = tiers.find((t) => priceInUah > t.minUah) || tiers[tiers.length - 1];
        return priceInUah * (tier.ratePercent / 100);
    }

    function convertFromEur(amountInEur, targetCurrency) {
        const rates = CALC_CONFIG.RATES_TO_UAH;
        const amountInUah = amountInEur * rates.EUR;
        return amountInUah / rates[targetCurrency];
    }

    // renders one primary amount + N secondary reference amounts, all
    // converted from the same EUR figure — primaryCurrency is whatever
    // the visitor priced the car in, so the number they see first always
    // matches the currency already in their head
    function renderCurrencyAmounts(amountInEur, primaryCurrency, primaryValueEl, primaryCurrencyEl, secondaryEls) {
        const symbols = CALC_CONFIG.CURRENCY_SYMBOLS;

        primaryValueEl.textContent = Math.round(convertFromEur(amountInEur, primaryCurrency)).toLocaleString("uk-UA");
        primaryCurrencyEl.textContent = symbols[primaryCurrency];

        const secondaryCurrencies = CALC_CONFIG.SECONDARY_CURRENCIES[primaryCurrency] || CALC_CONFIG.SECONDARY_CURRENCIES.EUR;

        secondaryEls.forEach((els, i) => {
            const currency = secondaryCurrencies[i];
            if (!currency) return;
            els.valueEl.textContent = Math.round(convertFromEur(amountInEur, currency)).toLocaleString("uk-UA");
            els.currencyEl.textContent = symbols[currency];
        });
    }

    function runCalculation() {
        // calcButton is type="button" so the browser never runs native
        // required/min/max validation on its own — reportValidity()
        // triggers the same built-in bubbles manually and returns false
        // without submitting anything, so an empty form no longer
        // silently produces a "0 €" result
        if (!form.reportValidity()) return;

        const vehicleType = vehicleTypeSelect.value;
        const price = parseFloat(document.getElementById("price").value) || 0;
        const currency = document.getElementById("currency").value;
        const fuel = fuelSelect.value;
        const engine = parseFloat(engineInput.value) || 0;
        const year = parseInt(document.getElementById("year").value, 10) || new Date().getFullYear();
        const truckWeight = truckWeightSelect.value;
        const condition = conditionSelect.value;
        const registrationDate = registrationDateInput.value;

        const priceInEur = priceToEur(price, currency);
        const priceInUah = priceInEur * CALC_CONFIG.RATES_TO_UAH.EUR;

        const duty = calculateDuty(priceInEur, fuel, vehicleType, engine);
        const excise = calculateExcise(vehicleType, fuel, engine, year, truckWeight, condition, registrationDate);
        const vat = calculateVat(priceInEur, duty, excise);
        const pensionInEur = calculatePension(priceInUah) / CALC_CONFIG.RATES_TO_UAH.EUR;

        // pension fund fee is shown separately, not folded into the
        // customs clearance total — the two are legally distinct payments
        const clearanceCost = duty + excise + vat;

        renderCurrencyAmounts(clearanceCost, currency, grandTotalEl, grandTotalCurrencyEl, [
            { valueEl: grandTotalSecondary1El, currencyEl: grandTotalSecondary1CurrencyEl },
            { valueEl: grandTotalSecondary2El, currencyEl: grandTotalSecondary2CurrencyEl }
        ]);

        renderCurrencyAmounts(pensionInEur, currency, pensionTotalEl, pensionTotalCurrencyEl, [
            { valueEl: pensionTotalSecondaryEl, currencyEl: pensionTotalSecondaryCurrencyEl }
        ]);

        resultPlaceholder.hidden = true;
        resultContent.hidden = false;

        // on mobile the result sits below the form and is off-screen
        // after clicking; on desktop it's already visible beside the
        // form, so "nearest" only moves the page when it actually needs to
        resultPanel.scrollIntoView({ behavior: "smooth", block: "nearest" });
    }

    button.addEventListener("click", runCalculation);

});
