<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Excise {
    public static function calculate(Vehicle $vehicle): float {
        $type = $vehicle->getType();
        $fuel = $vehicle->getFuel();
        $engine = $vehicle->getEngine();
        $age = $vehicle->getAge();

        if ($type === 'car') {
            if ($fuel === 'electric') {
                // Electric cars: 1 EUR per 1 kWh of battery capacity
                $batteryCapacity = $engine > 0 ? $engine : 60;
                return $batteryCapacity * 1.0;
            } elseif ($fuel === 'hybrid') {
                return 100.0;
            } else {
                // Petrol, Diesel, Gas
                $baseRate = 50; // Petrol <= 3000 cm³
                if ($fuel === 'petrol' || $fuel === 'gas') {
                    if ($engine > 3000) {
                        $baseRate = 100;
                    }
                } elseif ($fuel === 'diesel') {
                    $baseRate = ($engine > 3500) ? 150 : 75;
                }
                return $baseRate * ($engine / 1000) * $age;
            }
        } elseif ($type === 'moto') {
            if ($engine <= 150) {
                return $engine * 0.062;
            } elseif ($engine <= 500) {
                return $engine * 0.15;
            } elseif ($engine <= 800) {
                return $engine * 0.293;
            } else {
                return $engine * 0.447;
            }
        } elseif ($type === 'truck') {
            $rate = 0.02;
            if ($age > 8) {
                $rate = 1.0;
            } elseif ($age > 5) {
                $rate = 0.5;
            }
            return $engine * $rate;
        } elseif ($type === 'bus') {
            $rate = 0.05;
            if ($age > 5) {
                $rate = 0.5;
            }
            return $engine * $rate;
        }

        return 0.0;
    }
}