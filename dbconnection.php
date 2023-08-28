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
// database name => studentsdbs
$conn = mysqli_connect("localhost", "root", "", "end_project");

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Taking all values from the form data (input)
$email = $_REQUEST['email'];
$username = $_REQUEST['username'];
$password = $_REQUEST['pass'];

// Performing insert query execution
// here our table name is contentdbs
$sql = "INSERT INTO records (email, username, pass) VALUES ('$email', '$username', '$password')";

if (mysqli_query($conn, $sql)) {
    header("Location: home.html");
    
} else {
    echo "ERROR: Unable to execute $sql. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
</body>
</html>