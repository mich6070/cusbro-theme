<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Uktzed {
    public static function getCode(Vehicle $vehicle): string {
        $type = $vehicle->getType();
        $fuel = $vehicle->getFuel();

        if ($type === 'car') {
            if ($fuel === 'electric') return '8703 90 10 10';
            if ($fuel === 'hybrid') return '8703 80 10 10';
            return '8703 22 10 10';
        } elseif ($type === 'moto') {
            return '8711 20 90 00';
        } elseif ($type === 'truck') {
            return '8704 21 91 00';
        } elseif ($type === 'bus') {
            return '8702 10 11 10';
        }

        return '8703 00 00 00';
    }
}