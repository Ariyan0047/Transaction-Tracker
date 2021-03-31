<?php

($connection = new mysqli("localhost", "root", "", "crud")) or
  die(mysqli_error($connection));

// GETTING ID FROM URL
$id = $_GET["id"];

// DELETING THE MATCHED ID
$deleteSql = "DELETE FROM user_data WHERE id = $id";

if (mysqli_query($connection, $deleteSql)) {
  header("Location: ../index.php");
}
?>