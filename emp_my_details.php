<!DOCTYPE html>
<html>
<head>
    <title>
        Employee Details
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
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }

    </style>
</head>

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

$sql    = "SELECT * FROM emplogindetails";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["username"] == $_POST["usern"]) {
            if ($_POST["pwd"] != $row["password"]) {
                echo ("NO");
                die();
            }
            
            $sql      = "SELECT * FROM employee";
            $finalres = $conn->query($sql);
            
            while ($row1 = $finalres->fetch_assoc()) {
                # code...
                if ($row1["employeeid"] == $row["employeeid"]) {
                    //start html page here
                    
                    echo ("        <body>
                        

                    <h1 class='jumbotron text-center'>
                        WELCOME ");
                    echo strtoupper($row1['name']);
                    echo ("</h1>");
                    
                    echo ("
                        <div id='mySidenav' class='sidenav'>
                          <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>&times;</a>

                          
                          <form action='employee_details.php' method='POST'>  
                          <input name='usern' type='hidden' id='usern' value='".$_POST["usern"]."'>
                          <input name='pwd' type='hidden' id='pwd' value='".$_POST["pwd"]."'>
                          <button type='submit' class='btn btn-success btn-block' onclick='fdb()'>Dashboard</button>
                          </form>
                          

                          <form action='emp_my_details.php' method='POST'>  
                          <input name='usern' type='hidden' id='usern' value='".$_POST["usern"]."'>
                          <input name='pwd' type='hidden' id='pwd' value='".$_POST["pwd"]."'>
                          <button type='submit' class='btn btn-success btn-block' onclick='fdb()'>My Details</button>
                          </form>

                          <a href='#''>My Details</a>
                          <a href='#'>Order part</a>
                          <a href='#'>Pending Work Requests</a>
                          <a href='#'>Finished Work Requests</a>
                        </div>
                        <div style='font-size:30px;cursor:pointer' onclick='openNav()'>&#9776; Menu</div>
                        <div class='col-sm-6' >
                <h2>
                    Your details
                </h2>");
                    
                    $sql = "SHOW COLUMNS FROM employee";
                    $res = mysqli_query($conn, $sql);
                    
                    while ($col = mysqli_fetch_array($res)) {
                        echo "<div class='col-sm-2'>
                                " . strtoupper($col['Field']) . " 
                            </div>";
                        
                        echo "<div class='col-sm-4'>
                            " . $row1[$col['Field']] . "
                        </div><br>";
                    }
                    
                    echo "</div>";
                    
                    
                    echo "
                    <div class='col-sm-12'>
                    <a href='FrontPage.html'>
                    <input type='submit' class='btn btn-success btn-block' value='Log out'/>
             </a>
             </div>

     <script type='text/javascript'>

function openNav() {
    document.getElementById('mySidenav').style.width = '250px';
}

function closeNav() {
    document.getElementById('mySidenav').style.width = '0';
}
    </script>   

                </body>
                </html>";
                    //end html page here
                    break;
                }
            }
        }
    }
}

$conn->close();
?>