<?php include('header.php'); ?>
<?php include('db_connection.php'); ?>
<?php 
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
  header("location: login.php");
  exit;
}

?>

<div class="box1">
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
  Add Student
</button>
</div>
<br>
        <table class="table table -hover table-bordered table-stripe">
            <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Batch</th>
            <th>Update</th>
            <th>Delete</th>
            </tr>
            <?php 
            $querry ="select  * from `students`";
             $result = mysqli_query($connection, $querry);
            if(!$result){
                die("querry failed");
            }
            else{
               while($row= mysqli_fetch_assoc($result)){
                ?>
                     <tr>
                <td><?php echo $row['Id'];?></td>
                <td><?php echo $row['First_Name'];?></td>
                <td><?php echo $row['Last_Name'];?></td>
                <td><?php echo $row['Batch'];?></td>
                <td> <a href="Update_page.php?id=<?php echo $row['Id'];?>" class="btn btn-success"> Update</a></td>
                <td> <a href="delete_page.php? id=<?php echo $row['Id'];?>" class="btn btn-danger"> Delete</a></td>
            </tr>
                <?php
               }
            }

            ?>
           
        </table>
        <?php
        if(isset($_GET['message'])){
            echo"<h6>".$_GET['message']."</h6>";
        }
        ?>

<?php
        if(isset($_GET['insert_msg'])){
            echo"<h6>".$_GET['insert_msg']."</h6>";
        }
        ?>

<?php
        if(isset($_GET['update_msg'])){
            echo"<h6>".$_GET['update_msg']."</h6>";
        }
        ?>


<?php
        if(isset($_GET['delete_msg'])){
            echo"<h6>".$_GET['delete_msg']."</h6>";
        }
        ?>

        <form action ="insert_data.php" method="post">
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Students</h5>
        
          
       
      </div>
      <div class="modal-body">
 
        <div class="form-group">
            <label for ="first_name">First Name</label>
            <input type="text" name ="f_name"class="form-control">
        </div>
        <div class="form-group">
            <label for ="last_name">Last Name</label> 
            <input type="text" name ="l_name" class="form-control">
        </div>
        <div class="form-group">
            <label for ="batch">Batch</label>
            <input type="number" name ="batch" class="form-control">
        </div>
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success" name= "add student" value="Add Student">
      </div>
    </div>
  </div>
</div>
</form>

<a href="logout.php" class="btn btn-warning" id="logout">Logout</a>
        <?php include('footer.php'); ?>
    