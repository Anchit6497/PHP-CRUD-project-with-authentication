<?php
include 'db_connection.php';
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}

if(isset($_POST['add_student'])){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $batch = $_POST['batch'];

    if(empty($f_name)){
        header('Location: home.php?message=please enter first name!');
        exit();}
    if(empty($l_name)){
        header('Location: home.php?message=please enter last name!');
        exit();
    }
    elseif(empty($batch)){
        header('Location: home.php?message=please enter batch!');
        exit();
    }
     else {
        // Using prepared statements to prevent SQL injection
        $stmt = $connection->prepare("INSERT INTO `students`(`First_Name`, `Last_name`, `Batch`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $f_name, $l_name, $batch);
        $result = $stmt->execute();


        if(!$result){
            die("Query failed: " . $stmt->error);
        } else {
            header('Location: home.php?insert_msg=your data has been added successfully');
            exit();
        }
    }
}
?>
