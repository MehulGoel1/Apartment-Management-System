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


$sql = "SELECT * FROM residentlogindetail";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if($row["username"] == $_GET["username"]){
    		if ($_GET["password"] != $row["password"]) {
    			echo ("NO");
   	 			die();
			 }
        echo ("YES");
        die();
        }
	}
    echo "NO";
}

$conn->close();
?>