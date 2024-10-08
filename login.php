<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Define default admin credentials
    $adminEmail = 'admin@gmail.com';
    $adminPassword = password_hash('admin@123', PASSWORD_DEFAULT);

    // Check if the entered credentials match the admin credentials
    if ($email === $adminEmail && password_verify($password, $adminPassword)) {
        // Admin login successful, redirect to admin.php
        $_SESSION['user_id'] = 'admin';
        header("Location: admin.php");
        exit();
    }

    // If not admin credentials, proceed with checking against regular users
    $query = "SELECT id, password FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_email'] = $email;
            header("Location: index.php");
            exit();
        } else {
            echo "<script>
                alert('Invalid Email or Password');
                window.location.href = '../login.html';
                </script>";
        }
    } else {
        echo "<script>
            alert('User Not Found');
            window.location.href = '../login.html';
            </script>";
    }

    $stmt->close();
}
?>
