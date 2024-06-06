<?php include ('db_connection.php'); ?>
<?php include('header.php'); ?>
<?php
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}


if(isset($_GET['id'])){
    $id=$_GET['id'];


$querry ="select  * from `students` where id='$id'";
             $result = mysqli_query($connection, $querry);
            if(!$result){
                die("querry failed");
            }
            else{
               $row =mysqli_fetch_assoc($result);
            }
        }
?>

<?php
if(isset($_POST['update_students'])){

    if(isset($_GET['id_new'])){
        $idnew=$_GET['id_new'];
    }
    $f_name=$_POST['f_name'];
    $l_name=$_POST['l_name'];
    $batch=$_POST['batch'];

    $query ="update `students`set `First_Name`='$f_name',`Last_Name`='$l_name',`Batch`='$batch' where `Id`='$idnew'";
    $result = mysqli_query($connection, $query);
            if(!$result){
                die("querry failed");
            }

            else{
                header('location:home.php? update_msg= Succesfully updated data');
            }
}

?>

<form action="update_page.php? id_new=<?php echo $id; ?>" method="post">
<div class="form-group">
            <label for ="first_name">First Name</label>
            <input type="text" name ="f_name"class="form-control" value="<?php echo $row['First_Name']?>">
        </div>
        <div class="form-group">
            <label for ="last_name">Last Name</label> 
            <input type="text" name ="l_name" class="form-control" value="<?php echo $row['Last_Name']?>">
        </div>
        <div class="form-group">
            <label for ="batch">Batch</label>
            <input type="number" name ="batch" class="form-control" value="<?php echo $row['Batch']?>">
        </div>
        <input type="submit" class="btn btn-success" name= "update_students" value="Update">

</form>



<?php include('footer.php'); ?>