<?php
session_start();

$error = ""; // Initialize error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection details
    $servername = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbname = "end_project";

    // Create a new MySQLi object and establish the connection
    $conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to retrieve the user from the database
    $stmt = $conn->prepare("SELECT * FROM records WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user was found
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['pass'];

        // Verify the password
        if ($password === $storedPassword) {
            // Successful login
            $_SESSION['usr_id'] = $row['id'];
            $_SESSION['username'] = $username;
            header("Location: home.html");
            exit;
        } else {
            // Invalid password
            $error = "Invalid password";
        }
    } else {
        // Invalid username
        $error = "Invalid username";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>