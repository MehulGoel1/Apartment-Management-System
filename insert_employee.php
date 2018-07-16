<!DOCTYPE html>
<html>
<head>
    <title>
        Insert Employee
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Vollkorn+SC:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <style type="text/css">
        h1{
            font-family: 'Vollkorn SC', serif;
        }
        .col-sm-6{
            font-family: 'Ubuntu', sans-serif;
            font-size: 105%;
        }
        .col-sm-12{
            font-family: 'Ubuntu', sans-serif;
            
        }

    </style>

</head>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aptdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
	
}



 if(isset($_GET['st']))
 {
	 $st=$_GET['st'];
	 
    if($st == 'Incorrect_password')
{
  echo "Username already present.";
}
elseif($st == 'Successfully_inserted')
{
    echo "Successfully Inserted";
}
elseif($st == 'type')
{
    echo "type already present";
}
elseif($st=='num')
{
	 echo "Invalid phone number";
}


 }
    echo "
                    <div class='col-sm-6' >
                            <h2>
                                Insert New Employee
                            </h2>

                            <form id='form' class='col-sm-6' action='emp_into_db.php'>
                            
                                 <div class='form-group'>
                                    <label for='type'>Type of Employee</label>
									<input name='type' type='text' class='form-control' id='type' required>
                                </div>
                                                                
                                <div class='form-group'>
                                    <label for='name'>Employee name:</label>
                                    <input name='name' type='text' class='form-control' id='name' required>
                                </div>
                                                                
                                <div class='form-group'>
                                    <label for='address'>Address:</label>
                                    <input name='address' type='text' class='form-control' id='address' required>
                                </div>
                                                                                             
                                 <div class='form-group'>
                                    <label for='phoneno'>Phone No.: (should start from 7,8 or 9. Should be of 10 digits)</label>
                                    <input name='phoneno' type='tel' pattern='[7-9]{1}[0-9]{9}' class='form-control' id='phoneno' required>
                                </div>
								
								
								  <div class='form-group'>
                                    <label for='username'>Username:</label>
                                    <input name='username' type='text' class='form-control' id='username' required>
                                </div>
								
								<div class='form-group'>
                                    <label for='password'>Password:</label>
                                    <input name='password' type='password' class='form-control' id='password' required>
                                </div>
                                                         
                                 <input type='submit' value='Submit' class='btn btn-primary'>
                                <br>
                                <br>
                                <div id='error'></div>
								
                            </form>

                        </div>

                        <br>
                ";


echo "

                </body>
                </html>";
                
$conn->close();
?>