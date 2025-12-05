<?php
session_start();

session_regenerate_id();

$content = '';
$uts = time();
$status = 'Tuliskan isi cookie, kemudian tekan tombol simpan.';
$latihan = '';

if($_SERVER['REQUEST_METHOD']==='POST') {
  if($content = $_POST['content']) {
    setcookie('latihan', $content, time()+(60*60*24));
    $status = 'Cookie sudah tersimpan.';
  } else {
    setcookie('latihan', '');
    $status = 'Cookie sudah dihapus.';
  }
}

if(isset($_COOKIE['latihan'])) {
  $latihan = $_COOKIE['latihan'];
}

?><!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cookie Demo</title>
</head>
<body>
  <header>
    <h1>Cookie Demo</h1>
  </header>
  <main>
    <form method="post">
      <label for="input-content">Cookie [latihan] =</label>
      <input type="text" id="input-content" name="content">
      <button type="submit">Simpan Cookie</button>
    </form>
    <hr>
    <p><?= $status ?> <a href="">Refresh</a></p>
    <hr>
    <p>Cookie Latihan = <?= $latihan ?></p>
    <hr>
    <p><?= $uts ?></p>
  </main>
</body>
</html>