<?php

// require necessary files
require_once 'inc/config.php';

// process login form submission
if($_SERVER['REQUEST_METHOD']==='POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $user = new User;
  if($user->authenticate($username, $password)) {
    // redirect to members page on success
    header('Location: index.php');
    exit;
  }
}

// redirect back to login when accessed directly
header('Location: login.php');
exit();
