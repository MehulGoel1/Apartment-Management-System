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

$type=$_GET["type"];
$name =  $_GET["name"];
$address =  $_GET["address"];
$phoneno =  $_GET["phoneno"];
$username = $_GET["username"];
$password = $_GET["password"];
echo $phonenolen = strlen($phoneno);

echo  $query= "SELECT * FROM emplogindetails WHERE username = '".$username."'";
	$exe_uery = mysqli_query($conn,$query);
	$arra = mysqli_fetch_array(	$exe_uery);
	
echo  $query= "SELECT * FROM employee WHERE type = '".$type."'";
	$exe_uery = mysqli_query($conn,$query);
	$arra2 = mysqli_fetch_array(	$exe_uery);
	
if($phonenolen!=10 && $phoneno>=7000000000)
{
	 header('location: insert_employee.php?st=num');
}
else
{
if($arra == null )
{	
 if ($arra2 ==null) 
  {
			
			$sql = "INSERT INTO employee(type,name,address,phoneno)VALUES('$type','$name','$address','$phoneno')";

			if(mysqli_query($conn,$sql))
			{
				$row=mysqli_insert_id($conn);
			}
	

			$sql="INSERT INTO emplogindetails(username,password,empid)VALUES('$username','$password','$row')";
			$temp=mysqli_query($conn,$sql);
			header('location: insert_employee.php?st=Successfully_inserted');
			

  }
  else
  {
	 header('location: insert_employee.php?st=type');
	}
}
 else
  {
     header('location: insert_employee.php?st=Incorrect_password');
  }

}
$conn->close();

?>