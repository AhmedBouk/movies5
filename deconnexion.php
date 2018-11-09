<?php
// Deconnecte a session
session_start();
$_SESSION = array();
session_destroy();
header('location: index.php');
