<?php
// $con = mysqli_connect("localhost", "root", "", "restaurentms");

// if (mysqli_connect_error()) {
//     echo "<script>alert('Cannot Connect');</script>";
//     exit();
// }

?>

<?php
$servername = "localhost";
$username = "root";
$password = ""; // If you set a password, enter it here
$database = "restaurentms";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
