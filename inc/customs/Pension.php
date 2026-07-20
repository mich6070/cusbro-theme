<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Pension {
    public static function calculate(Vehicle $vehicle, float $priceInUah): array {
        if (!$vehicle->isFirstReg()) {
            return [
                'rate' => 0,
                'amount' => 0.0
            ];
        }

        // Pension Fund thresholds for 2024
        $rate = 3;
        if ($priceInUah > 878120) {
            $rate = 5;
        } elseif ($priceInUah > 499620) {
            $rate = 4;
        }

        $amount = $priceInUah * ($rate / 100);

        return [
            'rate' => $rate,
            'amount' => $amount
        ];
    }
}