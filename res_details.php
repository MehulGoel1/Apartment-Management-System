<!DOCTYPE html>
<html>
<head>
    <title>
        Resident Details
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
$username   = "root";
$password   = "";
$dbname     = "aptdb";
// Create connection
$conn       = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql    = "SELECT * FROM residentlogindetail";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        if ($row["username"] == $_POST["usern"]) {
            if ($_POST["pwd"] != $row["password"]) {
                echo ("NO");
                die();
            }
            
            $sql      = "SELECT * FROM RESIDENT";
            $finalres = $conn->query($sql);
            
            while ($row1 = $finalres->fetch_assoc()) {
                # code...
                if ($row1["resid"] == $row["resid"]) {
                    //start html page here
                    
                    echo ("        <body>
                    <h1 class='jumbotron text-center'>
                        WELCOME ");
                    echo strtoupper($row1['fname']);
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
                    
                    
                    $residentid = $row1['resid'];
                    $sql        = "SHOW COLUMNS FROM resident";
                    $res        = mysqli_query($conn, $sql);
                    
                    while ($col = mysqli_fetch_array($res)) {
                        echo "<div class='col-sm-6'>
                                " . strtoupper($col['Field']) . " 
                            </div>";
                        
                        echo "<div class='col-sm-6'>
                            " . $row1[$col['Field']] . "
                        </div><br>";
                    }
                    
                    echo "</div>";
                    
                    echo ("<div class='col-sm-6' >
                <h2>
                    House details
                </h2>");
                    
                    $sql  = "SELECT * FROM LEASE WHERE resid = '$residentid'";
                    $fres = mysqli_query($conn, $sql);
                    
                    $residentid = $row1['resid'];
                    $sql        = "SHOW COLUMNS FROM LEASE";
                    $res        = mysqli_query($conn, $sql);
                    while ($row1 = $fres->fetch_assoc()) {
                        while ($col = mysqli_fetch_array($res)) {
                            echo "<div class='col-sm-6'>
                                    " . strtoupper($col['Field']) . " 
                                </div>";
                            
                            echo "<div class='col-sm-6'>
                                " . $row1[$col['Field']] . "
                            </div><br>";
                        }
                        break;
                    }
                    
                    echo "</div>";
                    
                    echo "
                    <div class='col-sm-6' >
                            <h2>
                                Submit new request
                            </h2>

                            <form id='form' class='col-sm-12' data-fv-framework='bootstrap'
                                data-fv-icon-valid='glyphicon glyphicon-ok'
                                data-fv-icon-invalid='glyphicon glyphicon-remove'
                                data-fv-icon-validating='glyphicon glyphicon-refresh' onsubmit='return f1();'>
                                
                                <div class='form-group'>
                                    <label for='problem_type'>Select problem type (select one):</label>
                                    <select name='problem_type' class='form-control' id='problem_type' required
                                       data-fv-notempty-message='This field is required'>";
                    
                    
                    
                    
                    $sql = "SELECT * FROM EMPLOYEE";
                    $res = mysqli_query($conn, $sql);
                    
                    while ($rows = $res->fetch_assoc()) {
                        # code...
                        echo "<option>";
                        echo $rows['type'];
                        echo "</option>";
                    }
                    
                    
                    echo "</select>
                                </div>

                                <div class='form-group'>
                                    <label for='problem_description'>Problem Description:</label>
                                    <input name='problem_description' type='text' class='form-control' id='problem_description' required
                                      data-fv-notempty-message='This field is required'>
                                </div>
                                
                                <button type='submit' class='btn btn-default'>Submit</button>
                                <br>
                                <br>
                                <div id='error'></div>
                            </form>

                        </div>

                        
                ";
                    echo "
                    <div class='col-sm-6' >
                            <h2>
                                Give feedback
                            </h2>

                            <form id='form' class='col-sm-12' data-fv-framework='bootstrap'
                                data-fv-icon-valid='glyphicon glyphicon-ok'
                                data-fv-icon-invalid='glyphicon glyphicon-remove'
                                data-fv-icon-validating='glyphicon glyphicon-refresh' onsubmit='return f2();'>
                                
                                <div class='form-group'>
                                    <label for='work_order_id'>Select work order Id (select one):</label>
                                    <select name='work_order_id' class='form-control' id='work_order_id' required
                                   data-fv-notempty-message='This field is required'>";
                    
                    
                    
                    
                    $sql = "SELECT * FROM WORKORDER WHERE status = '1' AND feedback IS NULL AND WORKORDER.unitno IN (SELECT unitno FROM LEASE WHERE resid = '$residentid')";
                    $res = mysqli_query($conn, $sql);
                    
                    while ($rows = $res->fetch_assoc()) {
                        # code...
                        echo "<option>";
                        echo $rows['workorderid'];
                        echo "</option>";
                    }
                    
                    
                    echo "</select>
                                </div>

                                <div class='form-group'>
                                    <label for='feedback'>Your feedback:</label>
                                    <input name='feedback' type='text' class='form-control' id='feedback' required
                data-fv-notempty-message='This field is required'>
                                </div>
                                
                                <button type='submit' class='btn btn-default'>Submit</button>
                                <br>
                                <br>
                                <div id='error1'></div>
                            </form>

                        </div>

                        
                ";
                    
                    
                    
                    
                    $residentid = $row1['resid'];
                    
                    $sql = "SELECT * FROM LEASE WHERE LEASE.resid = $residentid";
                    $res = mysqli_query($conn, $sql);
                    
                    while ($row_work = $res->fetch_assoc()) {
                        $uni_no = $row_work["unitno"];
                    }
                    
                    
                    
                    $sql     = "SELECT * FROM WORKORDER WHERE WORKORDER.unitno IN (SELECT unitno FROM LEASE WHERE resid = '$residentid' )";
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
                 <script type='text/javascript'>
                    function f2(){
                        var x =  document.getElementById('work_order_id').value;
                        var y =  document.getElementById('feedback').value;     

                        if(x == '' || y == ''){
                            document.getElementById('error').innerHTML = 'One or more cells are empty';
                            return false;
                        }
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open('GET', 'give_feedback.php?work_order_id=' + x + '&feedback=' + y, false);
                        xmlhttp.send();
                        location.reload();
                        return false;                            
                    }
                    function f1(){
                        var x =  document.getElementById('problem_type').value;
                        var y =  document.getElementById('problem_description').value;     

                        if(x == '' || y == ''){
                            document.getElementById('error1').innerHTML = 'One or more cells are empty';
                            return false;
                        }
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open('GET', 'submit_work_request.php?problem_type=' + x + '&problem_description=' + y +'&unitno=' + '$uni_no', false);
                        xmlhttp.send();
                        location.reload();
                        return false;                            
                    }
                </script>   
                
           
                <script>
function f5(){
            window.location.href = 'http://stackoverflow.com';
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