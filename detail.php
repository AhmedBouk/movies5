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

 <p><?php echo $movie['title'] ;?></p> 



<?php include('inc/footer.php');
