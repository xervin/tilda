<?php

namespace src\Models;

use src\Services\GeoDTO;

/**
 * Представим, что здесь лежит настоящая модель
 * А массив PHONES - это база данных
 *
 * Создано просто для примера, что "не сервисами едиными" :)
 */
class Phone
{
    private const array PHONES = [
        "Petrozavodsk" => '555-65-65',
        "Gul'kevichi" => '555-15-15',
        "St Petersburg" => '700-15-15',
        "Weifang" => '700-00-10',
        "Oakland" => '212-00-12',
    ];

    private const string FALLBACK_PHONE = '666-99-66';

    public static function getByCity(GeoDTO $geo): string
    {
        return self::PHONES[$geo->city] ?? self::FALLBACK_PHONE;
    }
}