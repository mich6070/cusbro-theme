<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Duty {
    public static function calculate(Vehicle $vehicle, float $priceInEur): array {
        $fuel = $vehicle->getFuel();
        $origin = $vehicle->getOrigin();

        // Electric vehicles have 0% duty
        if ($fuel === 'electric') {
            return [
                'rate' => 0,
                'amount' => 0.0
            ];
        }

        // EU origin has reduced duty (5%), others have standard 10%
        $rate = ($origin === 'eu') ? 5 : 10;
        $amount = $priceInEur * ($rate / 100);

        return [
            'rate' => $rate,
            'amount' => $amount
        ];
    }
}