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
        <a href="index.php?l=a">A</a>
        <a href="index.php?l=b">B</a>
        <a href="index.php?l=c">C</a>
        <a href="index.php?l=d">D</a>
        <a href="index.php?l=e">E</a>
        <a href="index.php?l=f">F</a>
        <a href="index.php?l=g">G</a>
        <a href="index.php?l=h">H</a>
        <a href="index.php?l=i">I</a>
        <a href="index.php?l=j">J</a>
        <a href="index.php?l=k">K</a>
        <a href="index.php?l=l">L</a>
        <a href="index.php?l=m">M</a>
        <a href="index.php?l=n">N</a>
        <a href="index.php?l=o">O</a>
        <a href="index.php?l=p">P</a>
        <a href="index.php?l=q">Q</a>
        <a href="index.php?l=r">R</a>
        <a href="index.php?l=s">S</a>
        <a href="index.php?l=t">T</a>
        <a href="index.php?l=u">U</a>
        <a href="index.php?l=v">V</a>
        <a href="index.php?l=w">W</a>
        <a href="index.php?l=x">X</a>
        <a href="index.php?l=y">Y</a>
        <a href="index.php?l=z">Z</a>
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
      