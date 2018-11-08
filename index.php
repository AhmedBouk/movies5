<?php
include('inc/pdo.php');
include('inc/fonctions.php');


$title = 'Home';

$sql ="SELECT genres FROM movies_full";
$query = $pdo -> prepare($sql);
$query -> execute();
$genres = $query -> fetchall();

// debug($genres);
$tableau = array();
foreach ($genres as $genre) {
  $g = $genre['genres'];
  $explode = explode( ',',$g);
  foreach ($explode as $ex) {
    $ex = trim($ex);
    if(!in_array($ex,$tableau)){
      if(!empty($ex)){
        $tableau[] = $ex;
      }
    }
  }
}

debug($tableau);


$sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 50 ";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchall();
// debug($movies);


include('inc/header.php');

?>
<!-- Il y a une div id container autour du body  -->

<!-- Bouton film -->
<div class="more_films">
  <a href="index.php">Plus de films</a>
</div>
<!-- filtre catégories -->

<div class="categories">
<form action="" method="post">

  <ul><?php
    foreach ($tableau as $x) {
      echo '<li><input type="text" name="" value=""></li>'
    ;}
?></ul>

</form>

</div>
<div class="films">
  <?php
    foreach ($movies as $movie) {
      echo '<a href="detail.php?id='. $movie['id'] .'"><img src="posters/'.$movie['id'].'.jpg" alt="'.$movie['title'].'"></a>';
    }

   ?>
</div>


<?php



  ?>









<?php include('inc/footer.php');
