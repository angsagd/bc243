<?php

// require necessary files
require_once 'inc/config.php';

// check if user is logged in

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
          <li>ID: </li>
          <li>Username: </li>
          <li>Name: </li>
          <li>City: </li>
          <li>Join Date: </li>
          <li>Last Login: </li>
        </ul>
      </p>
    </section>
  </main>
  
</body>
</html>