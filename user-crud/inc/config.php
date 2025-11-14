<?php

// Start session
session_start();

// simple autoload
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});

// database config
const DB_HOST = 'localhost';
const DB_USER = 'webuser';       // sesuaikan dengan user MySQL Anda
const DB_PASS = 'webuser';       // sesuaikan dengan password MySQL Anda
const DB_NAME = 'bc243';         // sesuaikan dengan nama database yang sudah dibuat

// Define base URL
const BASE_URL = 'http://localhost:8000/user-crud/'; // sesuaikan dengan nama folder

// navigasi config
const NAV_PAGES = [
    ['title' => 'Home',    'url' => 'index.php'],
    ['title' => 'Members', 'url' => 'members.php'],
    ['title' => 'New',     'url' => 'create.php'],
    ['title' => 'Profile', 'url' => 'profile.php'],
    ['title' => 'Logout',  'url' => 'logout.php']
];
