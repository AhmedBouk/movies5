<?php
include('inc/pdo.php');
include('inc/fonctions.php');


$title = 'Home';

// Recuperation des donnes de la table movies_full
$sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 10 ";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchall();


//Recuperation  des catégories de la table movies_full
$sql ="SELECT genres FROM movies_full";
$query = $pdo -> prepare($sql);
$query -> execute();
$genres = $query -> fetchall();

// Tableau qui ne contient qu'une fois les differents genres
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
//soumission du formulaire
  if (!empty($_POST['submitted'])) {
    $actif = TRUE;

    $choixDate = explode("-", $_POST['year']);
    $sql = "SELECT * FROM movies_full WHERE year BETWEEN :annee1 AND :annee2";
    $query = $pdo -> prepare($sql);
    $query -> bindValue(':annee1', $choixDate[0], PDO::PARAM_STR);
    $query -> bindValue(':annee2', $choixDate[1], PDO::PARAM_STR);
    $query -> execute();
    $filmSelections = $query -> fetchAll();

// debug($genre);
  }
  else {
    $actif = FALSE;
  }



include('inc/header.php');

?>

<!-- Bouton film -->
<div class="more_films">
  <a href="index.php">Plus de films</a>
</div>


<!-- Formulaire -->
<form action="" method="post">
  <!-- Selection date -->
  <label for="selectionDate">Selectionner une periode</label>
  <select class="" name="year">
           <option value="none" selected="selected"></option>
           <option value="1880-1889">1880-1889</option>
           <option value="1890-1899">1890-1899</option>
           <option value="1900-1909">1900-1909</option>
           <option value="1910-1919">1910-1919</option>
           <option value="1920-1929">1920-1929</option>
           <option value="1930-1939">1930-1939</option>
           <option value="1940-1949">1940-1949</option>
           <option value="1950-1959">1950-1959</option>
           <option value="1960-1969">1960-1969</option>
           <option value="1970-1979">1970-1979</option>
           <option value="1980-1989">1980-1989</option>
           <option value="1990-1999">1990-1999</option>
           <option value="2000-2009">2000-2009</option>
           <option value="2010-2018">2010-2018</option>
</select>
  <!-- filtre catégories -->
  <div class="categories">
  <ul>
  <?php
    foreach ($tableau as $x) {
      echo '<li><input type="checkbox" name="" value="'.$x.'">'.$x.'</li>'
    ;}
    ?>
<!-- Bouton rechercher -->
      <input type="submit" name="submitted" value="Rechercher">
    </ul>
</form>

</div>
<div class="films">
  <?php if ($actif == false){
  foreach ($movies as $movie) {
    echo '<a href="detail.php?slug='. $movie['slug'] .'"><img src="posters/'.$movie['id'].'.jpg" alt="'.$movie['title'].'"></a><p> '.$movie['year'].'</p><p>'.$movie['title'].'</p><p>'.$movie['genres'].'</p>';
  }
}
  ?>
  <?php
  if ($actif == true){
  foreach ($filmSelections as $filmSelection) {
    echo '<a href="detail.php?slug='. $filmSelection['slug'] .'"><img src="posters/'.$filmSelection['id'].'.jpg" alt="'.$filmSelection['title'].'"></a><p> '.$filmSelection['year'].'</p><p>'.$filmSelection['title'].'</p><p>'.$filmSelection['genres'].'</p>';
  }
}
   ?>
</div>











<?php include('inc/footer.php');
