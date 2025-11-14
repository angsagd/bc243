<?php

// require necessary files
require_once 'inc/config.php';

// check if user is logged in
Utility::checkLogin();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Home</h1>
  </header>
  <?php Utility::showNav(); ?>
  <main>
    <section>
      <h2>Welcome to the Dashboard</h2>
      <p>This is your dashboard where you can manage your content. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, numquam illum dolor quia sapiente blanditiis possimus magnam fugiat beatae rerum. Nemo quae quas minus velit soluta aperiam aspernatur hic incidunt.</p>
      <p>Your data:
        <ul>
          <li>ID: <?= $_SESSION['user']['id'] ?? '-' ?></li>
          <li>Username: <?= $_SESSION['user']['username'] ?? '-' ?></li>
          <li>Name: <?= $_SESSION['user']['fullname'] ?? '-' ?></li>
          <li>City: <?= $_SESSION['user']['city'] ?? '-' ?></li>
          <li>Join Date: <?= $_SESSION['user']['created_at'] ?? '-' ?></li>
          <li>Last Login: <?= $_SESSION['user']['last_login'] ?? '-' ?></li>
        </ul>
      </p>
    </section>
  </main>
  
</body>
</html>