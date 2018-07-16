<!DOCTYPE html>
<html>
<head>
    <title>
        Insert Resident
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
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

 $st=$_GET['st'];

    if($st == 'Incorrect_password')
{
  echo "Username already taken";
}
elseif($st == 'Successfully_inserted')
{
    echo "";
}


                 echo"   <div class='col-sm-6' >
                            <h2>
                                Insert New Resident
                            </h2>

                            <form id='form' class='col-sm-6' method='get' action='res_into_db.php'>

                                <div class='form-group'>
                                    <label for='fname'>Resident first name:</label>
                                    <input name='fname' type='text' class='form-control' id='fname' required>
                                </div>

                                 <div class='form-group'>
                                    <label for='lname'>Resident last name:</label>
                                    <input name='lname' type='text' class='form-control' id='lname' required>
                                </div>

								  <div class='form-group'>
                                    <label for='username'>Username:</label>
                                    <input name='username' type='text' class='form-control' id='username' required>
                                </div>

								<div class='form-group'>
                                    <label for='password'>Password:</label>
                                    <input name='password' type='password' class='form-control' id='password' required>
                                </div>

                                <div class='form-group'>
                                    <label for='email'>Email id:</label>
                                    <input name='email' type='email' class='form-control' id='email' required>
                                </div>

                                 <div class='form-group'>
                                    <label for='phoneno'>Phone No.:</label>
                                    <input name='phoneno' type='tel' pattern='[0-9]{10,10}' class='form-control' id='phoneno' required>
                                </div>

                                 <div class='form-group'>
                                    <label for='monthlyrent'>Monthly Rent:</label>
                                    <input name='monthlyrent' type='number' class='form-control' id='monthlyrent' required>
                                </div>


								<div class='form-group'>
                                    <label for='securitydeposit'>Security Deposit:</label>
                                    <input name='securitydeposit' type='number' class='form-control' id='securitydeposit' required>
                                </div>

                                <div class='form-group'>
                                    <label for='leasestartdate'>Lease Start Date:</label>
                                    <input name='leasestartdate' type='date' class='form-control' id='leasestartdate' required>
                                </div>
                                <div class='form-group'>
                                    <label for='leaseenddate'>Lease End Date</label>
                                    <input name='leaseenddate' type='date' class='form-control' id='leaseenddate' required>
                                </div>
                                  <div class='form-group'>
                                    <label for='bedroom'>No. of bedrooms</label>
                                    <input name='bedroom' type='number' class='form-control' id='bedroom' required>
                                </div>
                                   <div class='form-group'>
                                    <label for='bathroom'>No. of bathrooms</label>
                                    <input name='bathroom' type='number' class='form-control' id='bathroom' required>
                                </div>
                                   <div class='form-group'>
                                    <label for='garage'>No. of garage</label>
                                    <input name='garage' type='number' class='form-control' id='garage' required>
                                </div>

                                


                                <input type='submit' value='Submit' class='btn btn-primary'>
                                <br>
                                <br>
                                <div id='error'></div>
                            </form>

                        </div>

                        <br>


                </body>
                </html>

				";


$conn->close();
?>