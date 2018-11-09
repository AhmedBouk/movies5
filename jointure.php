<?php
include('inc/pdo.php');
include('inc/fonctions.php');

$sql = "SELECT p.id AS id, p.post_title AS title, c.name AS name FROM post AS p, category AS c WHERE p.category_id= c.id";

$sqlInner= "SELECT * FROM post AS p INNER JOIN category AS c ON p.category_id = c.id";


$sqlLJOIN= "SELECT * FROM post AS p LEFT JOIN category AS c ON p.category_id = c.id";

$sqlRJOIN= "SELECT * FROM post AS p RIGHT JOIN category AS c ON p.category_id= c.id";

$query = $pdo -> prepare($sqlInner);
$query -> execute();
$jointure = $query -> fetchall();

debug($jointure);



 ?>
