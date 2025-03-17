<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Check if passwords match
    if ($password === $password2) {
        exit;
        // Add user to the database (this part is not implemented in your code)
        try {
            $db = new PDO('mysql:host=localhost;dbname=dbgast', 'gastenboek', 'gastenboek');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        $username = $db->real_escape_string($username);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if ($db->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }

        $db->close();

        // Redirect to login page
        header("Location: login.php");
        exit();
    } else {
        echo "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

<h1>Register</h1>
<form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password2" placeholder="Retype Password" required>
    <button type="submit" name="submit">Register</button>
</form>

</body>
</html>