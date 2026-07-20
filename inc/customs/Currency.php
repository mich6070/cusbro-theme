<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Currency {
    private static array $rates = [
        'EUR' => 1.0,
        'USD' => 0.922, // 41.50 / 45.00
        'PLN' => 0.233, // 10.50 / 45.00
        'UAH' => 0.0222 // 1.0 / 45.00
    ];

    private static array $ratesToUah = [
        'EUR' => 45.00,
        'USD' => 41.50,
        'PLN' => 10.50,
        'UAH' => 1.0
    ];

    public static function convertToEur(float $amount, string $fromCurrency): float {
        $fromCurrency = strtoupper($fromCurrency);
        if (!isset(self::$rates[$fromCurrency])) {
            return $amount;
        }
        if ($fromCurrency === 'EUR') {
            return $amount;
        }
        return $amount * self::$rates[$fromCurrency];
    }

    public static function convertEurToUah(float $amount): float {
        return $amount * self::$ratesToUah['EUR'];
    }

    public static function convertEurTo(float $amount, string $toCurrency): float {
        $toCurrency = strtoupper($toCurrency);
        if ($toCurrency === 'EUR') {
            return $amount;
        }
        if ($toCurrency === 'UAH') {
            return self::convertEurToUah($amount);
        }
        return $amount / self::$rates[$toCurrency];
    }

    public static function getRates(): array {
        return self::$ratesToUah;
    }
}