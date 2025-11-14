<?php

// require necessary files
require_once 'inc/config.php';

// check if user is logged in
Utility::checkLogin();

// get prefill data

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Member</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>New Member</h1>
  </header>
  <?php Utility::showNav(); ?>
  <main>
    <section>
      <form action="save.php" method="post" id="form-user">
        <div class="row"></div>
        <div class="row">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" value="" required>
        </div>
        <div class="row">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="row">
          <label for="confirm">Confirm:</label>
          <input type="password" id="confirm" name="confirm" required>
        </div>
        <hr>
        <div class="row">
          <label for="fullname">Full Name:</label>
          <input type="text" id="fullname" name="fullname" value="" required>
        </div>
        <div class="row">
          <label for="city">City:</label>
          <input type="text" id="city" name="city" value="" required>
        </div>
        <hr>
        <div class="row">
          <button type="submit">Create Member</button>
        </div>
      </form>
    </section>
  </main>
</body>
</html>
