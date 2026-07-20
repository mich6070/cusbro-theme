<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Engine {
    private string $fuel;
    private float $volume;

    public function __construct(string $fuel, float $volume) {
        $this->fuel = $fuel;
        $this->volume = $volume;
    }

    public function getFuel(): string {
        return $this->fuel;
    }

    public function getVolume(): float {
        return $this->volume;
    }

    public function isElectric(): bool {
        return $this->fuel === 'electric';
    }

    public function isHybrid(): bool {
        return $this->fuel === 'hybrid';
    }

    public function isGas(): bool {
        return $this->fuel === 'gas';
    }
}