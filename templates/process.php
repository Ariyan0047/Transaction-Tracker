<?php

($connection = new mysqli("localhost", "root", "", "crud")) or
  die(mysqli_error($connection));

if (isset($_POST["submit"])) {
  $date = $_POST["date"];
  $amount = $_POST["amount"];
  $category = $_POST["category"];

  $insertSql = "INSERT INTO data(amount,category,created_at) VALUES('$amount','$category','$date')";
  if (mysqli_query($connection, $insertSql)) {
    header("Location: ../index.php");
  }
}

// DELETING ITEMS
if (isset($_GET["delete"])) {
  $id = $_GET["delete"];

  // DELETING THE MATCHED ID
  $deleteSql = "DELETE FROM data WHERE id = $id";
  if (mysqli_query($connection, $deleteSql)) {
    header("Location: ../index.php");
  }
}
?>