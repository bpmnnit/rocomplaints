<?php
session_start();
if($_SESSION['login'] !== 1) {
    header('Location: http://10.208.133.79/rocomplaints/index.php');
}

include_once 'functions.php';

$cpf = $_SESSION['cpf'];
$name = $_SESSION['name'];
$desg = $_SESSION['desg'];
$dept = $_SESSION['dept'];
$admin_type = $_SESSION['admin_type'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>ONGC|MR|Complaints</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost/rocomplaints">Complaints</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="http://10.208.133.79/rocomplaints/logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>CPF</th>
                    <th>Designation</th>
                    <th>Department</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $cpf; ?></td>
                    <td><?php echo $desg; ?></td>
                    <td><?php echo $dept; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#" id="create_complain_div" onclick="show_create_complain()">Create Complaint</a></li>
                <li><a href="#" id="view_complains_div" onclick="show_view_complains()">View Complaints</a></li>
            </ul>
        </div>
        <div class="col-lg-10">
            <div id="create_complain">
                <h3>Create Complaint</h3>
                <hr>
                <div id="create_complain_result"></div>
                <form action="" method="post" id="create_complain_form">
                    <div class="form-group">
                        <label for="complain_type">Complaint Type</label>
                        <select class="form-control" id="complain_type" onchange="create_complain_categories()" required="required">
                            <option value="">Select One...</option>
                            <option value="CIVIL">CIVIL</option>
                            <option value="ELECTRICAL">ELECTRICAL</option>
                            <option value="HOUSEKEEPING">HOUSEKEEPING</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="complain_category">Complaint Category (Select One):</label>
                        <select class="form-control" id="complain_category" required="required"></select>
                    </div>
                    <div class="form-group">
                        <label for="complain_location">Complaint Location</label>
                        <select class="form-control" id="complain_location" required="required">
                            <option value="">Select One...</option>
                            <option value="OFFICE">OFFICE</option>
                            <option value="RESIDENCE">RESIDENCE</option>
                            <option value="PLATFORM">PLATFORM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="complain_address">Complaint Address</label>
                        <input id="complain_address" type="text" class="form-control" placeholder="Full Address" required="required">
                    </div>
                    <div class="form-group">
                        <label for="complain_description">Complaint Description</label>
                        <textarea class="form-control" rows="3" id="complain_description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="complain_time">Time Availability (for job)</label>
                        <input id="complain_time" type="text" class="form-control" placeholder="Preferred time of the day for the job.">
                    </div>
                    <button id="create_complain" type="button" class="btn btn-primary" onclick="create_complain_request()">Create Complaint</button>
                </form>
            </div>
            <div id="view_complains">
                <h3>List of Complaints</h3>
                <hr>
                <?php
                $conn = connect_db();
                switch($admin_type) {
                    case 'ALL':
                        $query = "SELECT * FROM complains";
                        break;
                    case 'CIVIL':
                        $query = "SELECT * FROM complains WHERE complain_type = \"CIVIL\"";
                        break;
                    case 'ELECTRICAL':
                        $query = "SELECT * FROM complains WHERE complain_type = \"ELECTRICAL\"";
                        break;
                    case 'HOUSEKEEPING':
                        $query = "SELECT * FROM complains WHERE complain_type = \"HOUSEKEEPING\"";
                        break;
                    default:
                        $query = "";
                        break;
                }
                $result = mysqli_query($conn, $query);
                if($result && mysqli_num_rows($result) > 0) {
                    ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = $result->fetch_assoc()) {
                            echo '<tr><td>'.$row['complain_id'].'</td><td>'.$row['complain_type'].'</td><td>'.$row['complain_location'].'</td><td>'.$row['complain_address'].'</td><td>'.$row['complain_description'].'</td><td>'.$row['complain_status'].'</td><td>'.$row['complain_createdat'].'</td><td><a href="#" onclick="modify_complain(\''.$row['complain_id'].'\')"><span class="glyphicon glyphicon-pencil"></span></a></td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo
                    '<div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Sorry! You have not registered any complain.
                            </div>
                        ';
                }
                mysqli_close($conn);
                ?>
            </div>
            <div id="modify_complain">

            </div>
        </div>
    </div>
</div>
</body>
</html>