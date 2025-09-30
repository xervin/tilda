<?php

namespace src\Services;

use Exception;
use MaxMind\Db\Reader;
use MaxMind\Db\Reader\InvalidDatabaseException;

class GeoChecker
{
    private readonly null|string $city;

    private readonly null|string $country;
    private readonly null|string $continent;
    private const string GEO_DATABASE = __DIR__ . '/../../geoip/GeoLite2-City.mmdb';

    private function __construct(string $ip)
    {
        try {
            $reader = new Reader(self::GEO_DATABASE);
            $record = $reader->get($ip);
            $reader->close();

            $this->city = $record['city']['names']['en'] ?? null;
            $this->country = $record['country']['names']['en'] ?? null;
            $this->continent = $record['continent']['names']['en'] ?? null;
        } catch (InvalidDatabaseException $e) {
            error_log("Database error: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("GeoIP error: " . $e->getMessage());
            return null;
        }
    }

    public static function init(string $ip): GeoDTO
    {
        $self = new self($ip);
        return new GeoDTO(
            city: $self->city,
            country: $self->country,
            continent: $self->continent
        );
    }
}