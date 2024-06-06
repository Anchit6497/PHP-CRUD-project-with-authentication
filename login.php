<?php
include('db_connection.php');

  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql="select * from users where email='$email' AND password='$password'";
    $result=mysqli_query($connection,$sql);
    $num =mysqli_num_rows($result);
    if($num ==1){
        session_start();
        $_SESSION['loggedin']= true;

        header('Location: home.php?log_message=you have been loged in');
            

    }
    else{
        header('Location: login.php?log_message=Invalid credentials');
            exit();
    }
    }
   

    
 

   
 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container col-md-4">
        <h1 class="text-center">SignIn</h1>
        <br>
        <br>
        <?php
        if (isset($_GET['log_message'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['log_message']) . "</div>";
        }
        ?>
        <form action="login.php" method="post">
           
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:" required>
            </div>
           
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="add_student" value="Login ">
            </div>

            <div class="text-center mt-3">           
                 <a href="signup.php" id="logout">Don't have an account? signup</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+0nFBI5q6Y5gk6wrKD8jIBb7x5c8b" crossorigin="anonymous"></script>
</body>
</html>
