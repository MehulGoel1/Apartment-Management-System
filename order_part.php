<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aptdb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$parttype = $_GET["part_type"];
$cnt = $_GET["part_count"];
$workid = $_GET["work_id"];

$sql = "SELECT * FROM PART WHERE name='$parttype'";
$result = $conn->query($sql);

while ($rows = $result->fetch_assoc()) {
	if($parttype == $rows['name']){
		$value1 = $cnt*$rows['cost'];
		$partno = $rows['partno'];
		break;
	}
}

$sql = "UPDATE WORKORDER SET cost = '$value1', status = 1 , enddate = CURDATE() WHERE workorderid='$workid'";
$conn->query($sql);

$sql = "INSERT INTO WORKORDERPART(workorderid,partno,quantity) VALUES('$workid','$ipartno','$cnt')";
$result = $conn->query($sql);

$conn->close();
?>