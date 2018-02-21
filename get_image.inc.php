<?php
require_once('DB_Functions.php');
$db = new DB_Functions();

$category = $_POST['category'];
$id = $_POST['id'];

$image = $db->getImage($category,$id);
echo "http://35.187.246.235/Map/php/".$image;
?>
