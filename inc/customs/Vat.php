<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Vat {
    public static function calculate(Vehicle $vehicle, float $priceInEur, float $duty, float $excise): float {
        $fuel = $vehicle->getFuel();
        $currentYear = (int)date('Y');

        // Electric cars are exempt from VAT in Ukraine until Jan 1, 2026.
        // From Jan 1, 2026, they pay 20% VAT, but remain exempt from duty.
        if ($fuel === 'electric') {
            if ($currentYear >= 2026) {
                return ($priceInEur + $duty + $excise) * 0.20;
            }
            return 0.0;
        }

        return ($priceInEur + $duty + $excise) * 0.20;
    }
}