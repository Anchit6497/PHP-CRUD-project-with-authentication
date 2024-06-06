<?php
include('db_connection.php');
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = "DELETE FROM `students` WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die("Query Failed: " . mysqli_error($connection));
    } else {
        header('location:home.php?delete_msg= Deleted Data succesfully');
    }
}
?>

