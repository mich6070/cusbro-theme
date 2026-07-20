<?php
namespace Cusbro\Customs;

if (!defined('ABSPATH')) {
    exit;
}

class Validation {
    public static function validate(array $data): array {
        $errors = [];

        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
            $errors['price'] = 'Будь ласка, вкажіть коректну вартість автомобіля.';
        }

        if (empty($data['year']) || !is_numeric($data['year']) || $data['year'] < 1980 || $data['year'] > (int)date('Y') + 1) {
            $errors['year'] = 'Будь ласка, вкажіть коректний рік випуску.';
        }

        if (isset($data['engine']) && (!is_numeric($data['engine']) || $data['engine'] < 0)) {
            $errors['engine'] = 'Будь ласка, вкажіть коректний об\'єм двигуна або ємність батареї.';
        }

        return [
            'is_valid' => empty($errors),
            'errors' => $errors
        ];
    }
}