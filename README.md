## Запуск

Для запуска необходим docker и docker compose

```
docker compose up --build
```

Доступ к веб части через браузер, http://localhost

Тестировалось на связке Windows 11 + wsl2 (Ubuntu 24.04)

* Задача 1: Запускать можно из веб (http://localhost/ladder.php) или из cli (php public/ladder.php)
* Задача 2: Запускать можно из веб (http://localhost/arrays.php) или из cli (php public/arrays.php)
* Задача 3: Запускать можно только из веб (http://localhost)

## Нюансы

Изначально планировалось, что гео данные будут устанавливаться из базы MaxMind (локальной) на 
этапе запроса (на уровне nginx) и помещаться в переменную окружения. <br>
(Сам модуль nginx и скачивание базы MaxMind в контейнер nginx оставил, все расписано в nginx.Dockerfile).

Но, при написании задачи, оказалось, что прокинуть реальный ip пользователя из WSL2 в докер контейнер довольно затруднительно,<br>
поэтому я решил ограничиться запросами к локальной базе MaxMind на уровне PHP.<br>

Для этого была использована библиотека geoip2/geoip2:~2.0, установлена из официальной документации MaxMind (https://dev.maxmind.com/geoip/geolocate-an-ip/databases/) с помощью composer.
