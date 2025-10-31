<?php

// require necessary files
require_once 'inc/config.php';

// check if user is logged in

// load all members

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Members</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Members</h1>
  </header>
  <?php Utility::showNav(); ?>
  <main>
    <section>
      <h2>Member Table</h2>
      <div class="row"></div>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>City</th>
            <th>Join Date</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
        <!-- Show members data -->
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
      