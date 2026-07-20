<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Vehicle {
    private string $type;
    private float $price;
    private string $currency;
    private int $year;
    private string $fuel;
    private float $engine;
    private string $origin;
    private bool $firstReg;

    public function __construct(array $data) {
        $this->type = $data['vehicle_type'] ?? 'car';
        $this->price = (float)($data['price'] ?? 0);
        $this->currency = strtoupper($data['currency'] ?? 'EUR');
        $this->year = (int)($data['year'] ?? date('Y'));
        $this->fuel = $data['fuel'] ?? 'petrol';
        $this->engine = (float)($data['engine'] ?? 0);
        $this->origin = $data['origin'] ?? 'other';
        $this->firstReg = ($data['first_reg'] ?? 'no') === 'yes';
    }

    public function getType(): string { return $this->type; }
    public function getPrice(): float { return $this->price; }
    public function getCurrency(): string { return $this->currency; }
    public function getYear(): int { return $this->year; }
    public function getFuel(): string { return $this->fuel; }
    public function getEngine(): float { return $this->engine; }
    public function getOrigin(): string { return $this->origin; }
    public function isFirstReg(): bool { return $this->firstReg; }

    public function getAge(): int {
        $age = (int)date('Y') - $this->year - 1;
        if ($age < 1) $age = 1;
        if ($age > 15) $age = 15;
        return $age;
    }
}