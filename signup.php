<?php
if (isset($_POST['signup'])) {
    $name = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $password = $_POST['pw'];

    if (empty($name) || empty($email) || empty($password)) {
        echo "Please fill in all the fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "todo";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (nom, email, pw) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
        $conn->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List - SignUp</title>
    <link rel="stylesheet" href="style_index.css">
</head>
<body>
    <form method="POST" action="">
    <div class="container">
        <section>
            <h2>USER SIGNUP</h2>
            <div class="input-container">
                <input type="text"  name="nom" id="mail" class="nom" placeholder="Saisir votre Nom" required style="padding-left:59px; border-radius:8px"><br>
            </div>
            <div class="input-container">
                <input type="email" name="email" id="mail" class="mail" placeholder="Saisir votre Email" style="padding-left:59px; border-radius:8px" required><br>
            </div>
            <div class="input-container">
                <input type="password" id="pw" class="pw" placeholder="Saisir votre mot de pass" style="padding-left:59px; border-radius:8px" name="pw" required><br>
            </div>
            <a href=""></a>
            <input type="submit" id="submit" name="signup" value="Sign Up" style="height:50px; width:150px; border-radius:10px; background-color: #ccc; font-weight: bold;">
        </section>
    </div>
    <img src="assets\index_background.jpg" alt="">
    </form>
</body>
</html>
