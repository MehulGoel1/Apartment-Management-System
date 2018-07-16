<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aptdb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$fname =  $_GET["fname"];
$lname =  $_GET["lname"];
$email =  $_GET["email"];
$phoneno =  $_GET["phoneno"];

$bedroom =  $_GET["bedroom"];
$bathroom =  $_GET["bathroom"];
$garage=  $_GET["garage"];

$monthlyrent =  $_GET["monthlyrent"];
$securitydeposit=$_GET["securitydeposit"];
$leasestartdate =  $_GET["leasestartdate"];
$leaseenddate =  $_GET["leaseenddate"];

$username = $_GET["username"];
$password = $_GET["password"];

echo  $query= "SELECT * FROM residentlogindetail WHERE username = '".$username."'";
	$exe_uery = mysqli_query($conn,$query);
	$arra = mysqli_fetch_array(	$exe_uery);
	

 
 if ($arra == null) 
  {
			$sql = "INSERT INTO resident(fname,lname,email,phoneno)VALUES('$fname','$lname','$email','$phoneno')";

			if(mysqli_query($conn,$sql))
			{
			  $row1=mysqli_insert_id($conn);
			}

			$a1=$row1;

			$sql2="INSERT INTO residentlogindetail(username,password,resid)VALUES('$username','$password','$a1')";
			$temp=mysqli_query($conn,$sql2);

			$sql3 = "INSERT INTO unit(bedroom,bathroom,garage)VALUES('$bedroom','$bathroom','$garage')";

			if(mysqli_query($conn,$sql3))
			{
			  $row2=mysqli_insert_id($conn);
			}

			$a2=$row2;



			$sql = "INSERT INTO lease (resid,unitno,mgrname,monthlyrent,securitydeposit,leasestartdate,leaseenddate) VALUES('$a1','$a2','Chauhan','$monthlyrent','$securitydeposit','$leasestartdate ','$leaseenddate')";
			$result= $conn->query($sql);

			header('location: insert_resident.php?st=Successfully_inserted');
  }
  else
  {
    header('location: insert_resident.php?st=Incorrect_password');
  }


$conn->close();

?>