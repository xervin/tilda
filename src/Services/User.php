<?php

namespace src\Services;

class User
{
    private const array IPS_POOL = [
        '78.36.41.137',
        '78.36.41.52',
        '78.36.41.155',
        '78.36.41.32',
        '109.59.91.158',
        '113.120.132.202',
        '97.206.84.244',
        '178.68.89.192',
        '217.66.159.158',
        '217.66.154.72',
        '193.242.105.33',
        '144.15.147.10',
        '151.91.158.71',
        '44.196.150.83',
        '96.171.81.202',
        '228.215.167.108',
        '217.66.159.125',
        '217.66.159.87',
    ];

    private static null|self $instance = null;
    private readonly string $ip;
    public function __construct()
    {
        $this->ip = self::IPS_POOL[rand(0, count(self::IPS_POOL) - 1)];
    }

    /**
     * Получение IP пользователя можно реализовать как-то так
     *
     * $userIP = $_SERVER['HTTP_X_REAL_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '';
     *
     * Но, т.к. мы в контейнере (и просто для упрощения), я сделаю пул адресов, который будет присваиваться пользователю случайным образом
     */
    public static function getIp(): string
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance->ip;
    }

}