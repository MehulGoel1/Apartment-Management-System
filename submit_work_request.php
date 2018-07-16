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
$unitno =  $_GET["unitno"];
$prob_type = $_GET["problem_type"];
$problem_description =  $_GET["problem_description"];

$sql = "SELECT * FROM EMPLOYEE";
$res = mysqli_query($conn,$sql);

while ($rows = $res->fetch_assoc()) {
	# code...
	if($_GET['problem_type'] == $rows['type']){
		$eid = $rows['employeeid'];
		break;
	}
}

$sql = "INSERT INTO WORKORDER(employeeid,status,unitno,description,startdate) VALUES('$eid',0,'$unitno','$problem_description',CURDATE())";
$result = $conn->query($sql);

$sql = "SELECT * FROM WORKORDER";
$result = $conn->query($sql);

while ($rows = $result->fetch_assoc()) {
	# code...
	$wo_id = $rows["workorderid"];
}

$sql = "INSERT INTO WORKORDERTYPE VALUES('$wo_id','$prob_type')";
$result = $conn->query($sql);

$conn->close();
?>