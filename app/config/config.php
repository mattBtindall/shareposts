<?php
    // DB params lamp_docker
    define('DB_HOST', 'db'); // Tends to be localhost
    define('DB_USER', 'lamp_docker');
    define('DB_PASS', 'password');
    define('DB_NAME', 'lamp_docker');
    // test

    // DB params xampp
    // define('DB_HOST', 'localhost'); // Tends to be localhost
    // define('DB_USER', 'root');
    // define('DB_PASS', 'password');
    // define('DB_NAME', 'lamp_docker');

    // I use this as i can't create a new db so i have prefixed the table with what would be the DB name
    define('DB_PREFIX', 'shareposts_');

    // App root
    define('APP_ROOT', dirname(dirname(__FILE__)));
    // Url root
    define('URL_ROOT', 'http://localhost/shareposts');
    // Site name
    define('SITE_NAME', 'SharePosts');
    // App Version
    define('APP_VERSION', '1.0.0');

