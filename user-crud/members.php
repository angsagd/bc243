<?php

// require necessary files
require_once 'inc/config.php';

// check if user is logged in
Utility::checkLogin();

// load all members
$user = new User();
$members = $user->getAll();

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
<?php
if (empty($members)) {
    echo '<tr><td colspan="6">Belum ada data user.</td></tr>';
}
foreach ($members as $member) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($member['id']) . '</td>';
    echo '<td>' . htmlspecialchars($member['username']) . '</td>';
    echo '<td>' . htmlspecialchars($member['fullname']) . '</td>';
    echo '<td>' . htmlspecialchars($member['city']) . '</td>';
    echo '<td>' . htmlspecialchars($member['created_at']) . '</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
}
?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
      