<?php
$meals = [];

if(isset($_GET['l'])) {
  $l = $_GET['l'];
  $url = 'https://www.themealdb.com/api/json/v1/1/search.php?f=' . $l;

  // Inisialisasi cURL
  $ch = curl_init($url);

  // Atur opsi cURL
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Eksekusi
  $json = curl_exec($ch);

  // $json = file_get_contents($url);
  $response = json_decode($json);
  $meals = $response->meals;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meals</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Meals</h1>
  </header>
  <main>
    <section>
      <div class="meal-letter">
<?php
for ($i=65;$i<=90;$i++) {
  echo '<a href="index.php?l=' . chr($i+32) . '">' . chr($i) . '</a>';
}
?>
      </div>
      <div class="meal-container">
<?php
if($meals) {
  foreach ($meals as $meal) {
    echo '<div class="meal-box">';
    echo '<img src="' . $meal->strMealThumb . '" alt="' . $meal->strMeal . '" class="meal-picture">';
    echo '<div class="meal-title"><a href="receipt.php?id=' . $meal->idMeal . '">' . $meal->strMeal . '</a></div>';
    echo '</div>';
  }
} else {
  echo '<p class="meal-letter">Click a letter above to show the meals</p>';
}
?>
    </section>
  </main>
</body>
</html>
      