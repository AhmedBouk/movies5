<?php
include('inc/pdo.php');
include('inc/fonctions.php');


$title = 'Detail';






$id = $_GET['id'];
$sql= "SELECT * FROM movies_full WHERE id=:id";
$query = $pdo -> prepare($sql);
$query->bindValue(':id',$id, PDO::PARAM_STR);
$query -> execute();
$movie = $query -> fetch();



include('inc/header.php');

?>
<ul>
  <li><?php echo '<img src="posters/'.$movie['id'].'.jpg" alt="">'?></li>
  <li><?php echo $movie['year'] ;?></li>
  <li><?php echo $movie['genres'] ;?></li>
  <li><?php echo $movie['plot'] ;?></li>
  <li><?php echo $movie['directors'] ;?></li>
  <li><?php echo $movie['cast'] ;?></li>
  <li><?php echo $movie['writers'] ;?></li>
  <li><?php echo $movie['runtime'] ;?></li>
</ul>




<?php include('inc/footer.php');
