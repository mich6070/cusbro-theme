<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Result {
    private Vehicle $vehicle;
    private float $priceInEur;
    private float $priceInUah;
    private array $duty;
    private float $excise;
    private float $vat;
    private array $pension;
    private string $uktzed;

    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
        $this->priceInEur = Currency::convertToEur($vehicle->getPrice(), $vehicle->getCurrency());
        $this->priceInUah = Currency::convertEurToUah($this->priceInEur);

        $this->duty = Duty::calculate($vehicle, $this->priceInEur);
        $this->excise = Excise::calculate($vehicle);
        $this->vat = Vat::calculate($vehicle, $this->priceInEur, $this->duty['amount'], $this->excise);
        $this->pension = Pension::calculate($vehicle, $this->priceInUah);
        $this->uktzed = Uktzed::getCode($vehicle);
    }

    public function toArray(): array {
        $totalCustoms = $this->duty['amount'] + $this->excise + $this->vat;
        $totalCustomsUah = Currency::convertEurToUah($totalCustoms);
        $pensionEur = $this->pension['amount'] / 45.00; // Convert back to EUR for display
        $grandTotal = $this->priceInEur + $totalCustoms + $pensionEur;

        return [
            'customs_val_eur' => round($this->priceInEur, 2),
            'customs_val_uah' => round($this->priceInUah, 2),
            'uktzed'          => $this->uktzed,
            'duty_rate'       => $this->duty['rate'],
            'duty_amount_eur' => round($this->duty['amount'], 2),
            'duty_amount_uah' => round(Currency::convertEurToUah($this->duty['amount']), 2),
            'excise_amount_eur' => round($this->excise, 2),
            'excise_amount_uah' => round(Currency::convertEurToUah($this->excise), 2),
            'vat_amount_eur'  => round($this->vat, 2),
            'vat_amount_uah'  => round(Currency::convertEurToUah($this->vat), 2),
            'pension_rate'    => $this->pension['rate'],
            'pension_amount_eur' => round($pensionEur, 2),
            'pension_amount_uah' => round($this->pension['amount'], 2),
            'total_customs_eur' => round($totalCustoms, 2),
            'total_customs_uah' => round($totalCustomsUah, 2),
            'grand_total_eur' => round($grandTotal, 2),
            'grand_total_uah' => round($grandTotal * 45.00, 2)
        ];
    }
}