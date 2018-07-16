<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "aptdb";
// Create connection
$conn       = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$workorderid = $_GET["work_order_id"];
$feedback    = $_GET["feedback"];

$sql = "SELECT * FROM EMPLOYEE";
$res = mysqli_query($conn, $sql);

$sql = "UPDATE WORKORDER SET feedback = '$feedback' WHERE workorderid='$workorderid'";
$conn->query($sql);

$conn->close();
?>