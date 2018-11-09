<?php
include('inc/pdo.php');
include('inc/fonctions.php');


$title = 'Detail';






$slug = $_GET['slug'];
$sql= "SELECT * FROM movies_full WHERE slug=:slug";
$query = $pdo -> prepare($sql);
$query->bindValue(':slug',$slug, PDO::PARAM_STR);
$query -> execute();
$movie = $query -> fetch();



include('inc/header.php');

?>
<ul class= "description" >
  <li>  <?php echo '<img src="posters/'.$movie['id'].'.jpg" alt="">'?></li>
  <li> <p> Titre : <?php echo $movie['title'] ;?></p> </li>
  <li> <p> Date de sortie : <?php echo $movie['year'] ;?><p></li>
  <li> <p> Genre : <?php echo $movie['genres'] ;?> <p></li>
  <li> <p> De : <?php echo $movie['directors'] ;?> <p></li>
  <li> <p> Avec : <?php echo $movie['cast'] ;?><p></li>
  <li> <p> Durée : <?php echo $movie['runtime'] ;?> min<p></li>
  <li> <p> Classification des films : <?php echo $movie['mpaa'] ;?> <p></li>
  <li> <p> Note : <?php echo $movie['rating'] ;?> notes <p></li>
  <li> <p> Popularité : <?php echo $movie['popularity'] ;?><p></li>
  <li> <h2>SYNOPSIS ET DÉTAILS </h2><br> <?php echo $movie['plot'] ;?></li>

</ul>

<form class="favorisfilm" action="" method="post">
  <label for="ajouté"></label>
  <input type="button" name="ajouté" value="à regarder">

</form>


<form method="post" action="">
<input type="hidden" name="" value="''">
<select name="rating">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
</select>
<input type="submit" value="Note">
</form>

<?php include('inc/footer.php');
