<?php
session_start();
// Assuming your database connection file is named db.php and is in the same directory as this file
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = isset($_POST['first_name']) ? stripslashes($_POST['first_name']) : '';
    $firstName = mysqli_real_escape_string($conn, $firstName);

    $lastName = isset($_POST['last_name']) ? stripslashes($_POST['last_name']) : '';
    $lastName = mysqli_real_escape_string($conn, $lastName);

    $email = isset($_POST['email']) ? stripslashes($_POST['email']) : '';
    $email = mysqli_real_escape_string($conn, $email);

    $password = isset($_POST['password']) ? stripslashes($_POST['password']) : '';
    $password = mysqli_real_escape_string($conn, $password);

    // Check if required fields are not empty before executing the query
    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // The query to insert the user data into the database
        $query = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$hashed_password')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            // Registration successful
            echo "<script>
                alert('Registration Successful');
                window.location.href = '../login.html';
            </script>";
        } else {
            // If an error occurs during the execution of the query
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>
        alert('Error: Required fields are empty.');
        window.location.href = '../register.html';
    </script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>