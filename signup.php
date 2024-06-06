<?php
include('db_connection.php');

  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $c_password = $_POST["c_password"];

    if (empty($fullname) || empty($email) || empty($password) || empty($c_password)) {
        header('Location: signup.php?log_message=All fields are required!');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: signup.php?log_message=Email is not valid!');
        exit();
    }

    if (strlen($password) < 8) {
        header('Location: signup.php?log_message=Password must be at least 8 characters long!');
        exit();
    }

    if ($password !== $c_password) {
        header('Location: signup.php?log_message=Passwords do not match!');
        exit();
    }

    // Add your database insert code here
    // For example: insert user into the database

    // Redirect to a success page (or any other page) after successful registration
 

    else {
        // Using prepared statements to prevent SQL injection
        $stmt = $connection->prepare("INSERT INTO `users`(`Full Name`, `Email`, `Password`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $password);
        $result = $stmt->execute();
        

        if(!$result){
            die("Query failed: " . $stmt->error);
        } else {
            header('Location: login.php?log_message=you account has been registered');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container col-md-4">
        <h1 class="text-center">Create your Account</h1>
        <br>
        <br>
        <?php
        if (isset($_GET['log_message'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['log_message']) . "</div>";
        }
        ?>
        <form action="signup.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="c_password" placeholder="Confirm Password:" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" name="add_student" value="Sign Up">
            </div>
            <div class="text-center mt-3">           
                 <a href="login.php" id="logout">Already have an account? Signin</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+0nFBI5q6Y5gk6wrKD8jIBb7x5c8b" crossorigin="anonymous"></script>
</body>
</html>
