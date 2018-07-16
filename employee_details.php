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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
                if ($row1["employeeid"] == $row["empid"]) 
               {
                    //start html page here
                    
                    echo ("        <body>");
                        
                    echo("
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
                    
                    
                    
                        echo ("
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
                    <div class='col-sm-6' >
                            <h2>
                                Order part
                            </h2>

                            <form action='' method='get' id='form' class='col-sm-6' onsubmit='return f1();'>
            
                                <div class='form-group'>
                                    <label for='word_id'>Select WorkOrder Id (select one):</label>
                                    <select name='work_id' class='form-control' required
                data-fv-notempty-message='The password is required' id='work_id'>";
                    
                    
                    $employeeid = $row1["employeeid"];
                    
                    
                    
                    $sql     = "SELECT * FROM WORKORDER WHERE WORKORDER.employeeid = '$employeeid' AND status = 0";
                    $workres = $conn->query($sql);
                    $cnt     = $workres->num_rows;
                    
                    while ($row_work = $workres->fetch_assoc()) {
                        echo "<option>";
                        echo $row_work['workorderid'];
                        echo "</option>";
                    }
                    
                    echo "</select>
                                </div>

                                <div class='form-group'>
                                    <label for='part_type'>Select part (select one):</label>
                                    <select name='part_type' class='form-control' required
                data-fv-notempty-message='The password is required' id='part_type'>

                                    ";
                    
                    
                    $sql     = "SELECT * FROM PART";
                    $workres = $conn->query($sql);
                    
                    while ($row_work = $workres->fetch_assoc()) {
                        echo "<option>";
                        echo $row_work['name'];
                        echo "</option>";
                    }
                    
                    
                    echo "</select>
                                </div>
                                
                                <div class='form-group'>
                                    <label for='part_count'>Quantity:</label>
                                    <input name='part_count' type='number' min='1' class='form-control' required
                data-fv-notempty-message='The password is required' id='part_count'>
                                </div>

                                <button type='submit' class='btn btn-default'>Submit</button>
                                <br>
                                <br>
                                <div id='error'></div>
                            </form>

                        </div>

                        <br>
                ";
                    
                    
                    $employeeid = $row1['employeeid'];
                    
                    
                    
                    $sql     = "SELECT * FROM WORKORDER WHERE WORKORDER.employeeid = '$employeeid' AND status = 0";
                    $workres = $conn->query($sql);
                    
                    echo "
                <div class='col-sm-12' >
                    <h2>
                        Pending Work Requests
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
                    $cnt = 0;
                    while ($row_work = $workres->fetch_assoc()) {
                        $cnt = $cnt += 1;
                        echo "<tr>";
                        $res = mysqli_query($conn, $sql);
                        while ($col = mysqli_fetch_array($res)) {
                            echo "<td>";
                            echo $row_work[$col['Field']];
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    
                    
                    echo "        </tbody>

                            </table>
                            </div>
                ";
                    
                    $employeeid = $row1['employeeid'];
                    
                    $sql     = "SELECT * FROM WORKORDER WHERE WORKORDER.employeeid = '$employeeid' AND status = '1'";
                    $workres = $conn->query($sql);
                    
                    echo "


                <div class='col-sm-12' >
                    <h2>
                        Previous Work Requests
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
                    $cnt = 0;
                    while ($row_work = $workres->fetch_assoc()) {
                        $cnt = $cnt += 1;
                        echo "<tr>";
                        $res = mysqli_query($conn, $sql);
                        while ($col = mysqli_fetch_array($res)) {
                            echo "<td>";
                            echo $row_work[$col['Field']];
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    
                    
                    echo "        </tbody>

                            </table>
                            </div>
                ";
                    echo "
                    

     <script type='text/javascript'>

     function fdb(){
        location.href = 'FrontPage.html';
     }
        function f1(){
            var x =  document.getElementById('work_id').value;
            var y =  document.getElementById('part_type').value;
            var z =  document.getElementById('part_count').value;
                                        
            if(x == '' || y == '' || z ==''){
                document.getElementById('error').innerHTML = 'One or more cells are empty';
                return false;
            }
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open('GET', 'order_part.php?work_id=' + x + '&part_type=' + y+'&part_count=' + z, false);
            xmlhttp.send();
            location.reload();
            return false;        
        }
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