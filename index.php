<?php
include('inc/pdo.php');
include('inc/fonctions.php');


$title = 'Home';




$sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 50 ";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchall();
// debug($movies);


include('inc/header.php');

?>
<!-- Il y a une div id container autour du body  -->

<!-- <a href="detail.php?id= -->

<div class="films">
  <?php
    foreach ($movies as $movie) {
      echo '<a href="detail.php?slug='. $movie['slug'] .'"><img src="posters/'.$movie['id'].'.jpg" alt="'.$movie['title'].'"></a>';
    }

   ?>
</div>


<?php



  ?>









<?php include('inc/footer.php');
