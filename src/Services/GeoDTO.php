<?php

namespace src\Services;

final readonly class GeoDTO
{
    public function __construct(
        public null|string $city,
        public null|string $country,
        public null|string $continent
    )
    {
    }
}