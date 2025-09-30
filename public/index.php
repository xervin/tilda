<?php
require_once __DIR__ . '/../vendor/autoload.php';

use src\Models\Phone;
use src\Services\GeoChecker;
use src\Services\User;

$userIp = User::getIp();
$geo = GeoChecker::init($userIp);
$companyPhone = Phone::getByCity($geo);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Очень красивый маркетинговый сайт</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <div class="header-content">
        <a href="#" class="logo">JoyStore</a>
        <nav>
            <ul class="nav-links">
                <li><a href="#products">Продукты</a></li>
                <li><a href="#about">О нас</a></li>
                <li><a href="#reviews">Отзывы</a></li>
                <li><a href="#contact">Контакты</a></li>
            </ul>
        </nav>
        <div class="phone-wrapper">
            <div class="phone-label">Бесплатная консультация</div>
            <a href="tel:8-800-<?php echo $companyPhone; ?>" class="phone-number">8-800-<?php echo $companyPhone; ?></a>
        </div>
    </div>
</header>

<main>
    <section>
        <h1>Мы продаем радость!</h1>
        <p class="subtitle">Инновационные решения для вашего счастья и благополучия</p>

        <div class="image-wrapper">
            <img class="image" src="assets/images/001.png" alt="Радость 1">
            <img class="image" src="assets/images/002.png" alt="Радость 2">
            <img class="image" src="assets/images/003.png" alt="Радость 3">
        </div>

        <div class="cta-section">
            <h2 class="cta-title">Готовы стать счастливее?</h2>
            <p class="cta-description">Позвоните нам прямо сейчас!</p>
            <a href="tel:<?php echo $companyPhone; ?>" class="cta-phone">8-800-<?php echo $companyPhone; ?></a>
        </div>
    </section>
</main>

<footer>
    <div class="footer-content">
        <div class="footer-info">
            <div class="footer-logo">JoyStore</div>
            <p class="footer-description">Мы создаем продукты, которые приносят радость в вашу жизнь с 2020 года</p>
        </div>
        <div class="footer-phone">
            <div class="phone-label">Круглосуточная поддержка</div>
            <a href="tel:8-800-<?php echo $companyPhone; ?>" class="phone-number">8-800-<?php echo $companyPhone; ?></a>
        </div>
    </div>
</footer>
</body>
</html>
