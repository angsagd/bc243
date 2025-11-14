<?php

// require necessary files
require_once 'inc/config.php';

// testing code

$user = new User;

$members = $user->getAll();

print_r($members);
