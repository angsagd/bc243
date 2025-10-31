<?php

// require necessary files
require_once 'inc/config.php';

// check if user is logged in

// get prefill data

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Login User</h1>
  </header>
  <main>
    <form action="authenticate.php" method="POST" id="form-login">
      <div class="row"></div>
      <div class="row">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" autofocus required>
      </div>
      <div class="row">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="row">
        <button type="submit">Login</button>
      </div>
    </form>
  </main>
</body>
</html>