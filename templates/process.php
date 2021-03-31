<?php
session_start();

($connection = new mysqli("localhost", "root", "", "crud")) or
  die(mysqli_error($connection));

$id = 0;
$dateObj = "";
$amountObj = 0;
$update = false;
$categoryObj = "";

// INSERTING DATA IN THE DATAVASE TABLE DATA
if (isset($_POST["submit"])) {
  $date = $_POST["date"];
  $amount = $_POST["amount"];
  $category = $_POST["category"];

  $insertSql = "INSERT INTO data(amount,category,created_at) VALUES('$amount','$category','$date')";
  if (mysqli_query($connection, $insertSql)) {
    $_SESSION["message"] = "RECORD HAS BEEN SAVED";
    $_SESSION["msg_type"] = "success";
    header("Location: ../index.php");
  }
}

// DELETING ITEMS FROM DATA IN THE DATAVASE TABLE DATA
if (isset($_GET["delete"])) {
  $id = $_GET["delete"];

  // DELETING THE MATCHED ID
  $deleteSql = "DELETE FROM data WHERE id = $id";
  if (mysqli_query($connection, $deleteSql)) {
    $_SESSION["message"] = "RECORD HAS BEEN DELETED";
    $_SESSION["msg_type"] = "danger";
    header("Location: ../index.php");
  }
}

// UPDATING EXSITING VALUES
if (isset($_GET["edit"])) {
  $id = $_GET["edit"];
  $update = true;
  $sql = "SELECT * FROM data WHERE id=$id";
  $result = mysqli_query($connection, $sql);
  $datalist = mysqli_fetch_all($result, MYSQLI_ASSOC);
  foreach ($datalist as $data) {
    $update = true;
    $dateObj = $data["created_at"];
    $amountObj = $data["amount"];
    $categoryObj = $data["category"];
  }
}

// UPDATE DATA IN DATABASE
if (isset($_POST["update"])) {
  $id = $_POST["id"];
  $date = $_POST["date"];
  $amount = $_POST["amount"];
  $category = $_POST["category"];

  $updateSql = "UPDATE data SET amount='$amount',category='$category',created_at='$date' WHERE id=$id";
  if (mysqli_query($connection, $updateSql)) {
    $_SESSION["message"] = "RECORD HAS BEEN UPDATED";
    $_SESSION["msg_type"] = "success";
    header("Location: ../index.php");
  }
}
?>