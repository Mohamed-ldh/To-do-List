<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pw'];

    if (empty($email) || empty($password)) {
        echo "Please enter your email and password";
    } else {
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "todo";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query1 = "SELECT nom, pw FROM users WHERE email = '$email'";
        $result = $conn->query($query1);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['pw'];

            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['nom'] = $row['nom'];
                header("location: todo.php");
                exit();
            } else {
                $error_message = "Invalid email or password";
            }
        } else {
            $error_message = "User not found";
        }

        $conn->close();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List - Login</title>
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    <form action="login.php" method="POST">
    <div class="container">
        <section>
            <h2>USER LOGIN</h2>
            <div class="input-container">
                <i class='fas fa-user-alt' id="user" style="font-size:24px;"></i>
                <input type="email" name="email" id="mail" class="mail" style="padding-left:59px; border-radius:8px" placeholder="Saisir votre Email"><br>
            </div>
            <div class="input-container">
                <i class="fa fa-lock" id="lock" style="font-size:24px;"></i>
                <input type="password" name="pw" id="pw" class="pw" style="padding-left:59px; border-radius:8px" placeholder="Saisir votre mot de pass"><br>
            </div>
            <input type="submit" name="login"  value="Login" style="height:50px; width:150px; border-radius:10px; background-color: #ccc; font-weight: bold;">
        </section>
    </div>
    <img src="assets\index_background.jpg" alt="">
    </form>
</body>
</html>