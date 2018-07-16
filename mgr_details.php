<!DOCTYPE html>
<html>
<head>
    <title>
        Manager Details
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

$sql = "SELECT * FROM mgrlogindetails";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    // output data of each rowup
    while($row = $result->fetch_assoc()) 
	{
        if($row["username"] == $_POST["usern"])
		{
            if ($_POST["pwd"] != $row["password"])
			{
                echo ("NO");
                die();
            }
        
        $sql = "SELECT * FROM manager";
        $finalres = $conn->query($sql);
        
        while ($row1 = $finalres->fetch_assoc()) 
		{
            # code...
            if($row1["name"] == $row["mgrname"])
			{
                //start html page here

                echo("        <body>
                    <h1 class='jumbotron text-center'>
                        WELCOME ");
                echo strtoupper($row1['name']);
                echo ("</h1>
                        <div class='col-sm-12'>
                    <a href='FrontPage.html' style='text-decoration: none'>
                    <input type='submit' class='btn btn-success btn-block' value='Log out'/>
             </a>
             </div>
             ");

                echo ("<div class='col-sm-6' >
                <h2>
                    Your details
                </h2>");

                $sql = "SHOW COLUMNS FROM manager";
                $res = mysqli_query($conn,$sql);

                while($col = mysqli_fetch_array($res)){
                    echo "<div class='col-sm-5'>
                                ".$col['Field'].": 
                            </div>";

                    echo "<div class='col-sm-5'>
                            ".$row1[$col['Field']]."
                        </div><br>";
                }

                echo "</div>";
			
					echo ("<br><br><a href='insert_resident.php?st=0'>
              <input type='submit' class='btn btn-success ' value='Add New Resident' />
              </form><br><br></a>");
               
				echo ("<a href='insert_employee.php?'>
                    <input type='submit' class='btn btn-success ' value='Add New Employee'/>
              </form></a>");

                $sql     = "SELECT * FROM WORKORDER";
                    $workres = $conn->query($sql);
                    
                    echo "


                <div class='col-sm-12' >
        <h2>
            All Work Requests
        </h2>
                    <table class='table table-striped'>
                                <thead>
                                  <tr>
                                    <th>WorkOrderId</th>
                                    <th>EmployeeId</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                    <th>Unit Number</th>
                                    <th>Description</th>
                                    <th>Feedback</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                  </tr>
                                </thead>

                                <tbody>
                                ";
                    $sql = "SHOW COLUMNS FROM WORKORDER";
                    $res = mysqli_query($conn, $sql);
                    
                    while ($row_work = $workres->fetch_assoc()) {
                        
                        echo "<tr>";
                        $res = mysqli_query($conn, $sql);
                        while ($col = mysqli_fetch_array($res)) {
                            echo "<td>";
                            echo $row_work[$col['Field']];
                            echo "</td>";
                        }
                        echo "</tr>";
                        
                    }
                    
                    
                    echo "  </tbody>

                            </table>
                            </div>
                ";
				
				echo "
                </body>
                </html>";
				
				}
	}

}
}
}	