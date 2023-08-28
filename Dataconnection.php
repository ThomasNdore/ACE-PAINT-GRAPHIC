<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
</head>
<body>
    <?php
// servername => localhost
// username => root
// password => empty
// database name => end_project
$conn = mysqli_connect("localhost", "root", "", "end_project");

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Taking all values from the form data (input)
$email = $_REQUEST['email'];
$username = $_REQUEST['username'];
$message = $_REQUEST['message'];

// Performing insert query execution
// here our table name is contacts
$sql = "INSERT INTO contacts (email, username, messsage) VALUES ('$email', '$username', '$message')";

if (mysqli_query($conn, $sql)) {
    header("Location: services.html");
    
} else {
    echo "ERROR: Unable to execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
</body>
</html>