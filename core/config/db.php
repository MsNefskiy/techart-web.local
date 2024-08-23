<?php

define("DB_DRIVER", "mysql");
define("DB_HOST", "MySQL-8.2");
define("DB_NAME", "news");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_CHARSET", "utf8");
define("DB_OPTIONS", [
    PDO::ATTR_PERSISTENT => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
