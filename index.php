<?php
include('inc/pdo.php');
include('inc/fonctions.php');


$title = 'Home';
include('inc/header.php');



$sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 50 ";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchall();
// debug($movies);




?>
<!-- Il y a une div id container autour du body  -->

<!-- <a href="detail.php?id= -->

<div class="films">
  <?php
    foreach ($movies as $movie) {
      echo '<a href="detail.php?id="'.$movie['id'].'"><img src="posters/'.$movie['id'].'.jpg" alt="'.$movie['title'].'"></a>';
    }

   ?>
</div>


<?php



  ?>









<?php include('inc/footer.php');
