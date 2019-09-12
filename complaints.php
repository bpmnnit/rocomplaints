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
$admin_type = isset($_SESSION['admin_type'])?$_SESSION['admin_type']:"";

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
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({
                placement : 'top'
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius: 0px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://10.208.133.79/rocomplaints/complaints.php">Complaints</a>
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
                        <select class="form-control" id="complain_type" onchange="create_complain_categories('complain_type', 'complain_category')" required="required">
                            <option value="">Select One...</option>
                            <option value="CIVIL">CIVIL</option>
                            <option value="ELECTRICAL">ELECTRICAL</option>
                            <option value="HOUSEKEEPING">HOUSEKEEPING</option>
                            <option value="INFOCOM">INFOCOM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="complain_category">Complaint Category (Select One):</label>
                        <select class="form-control" id="complain_category" required="required"></select>
                    </div>
                    <div class="form-group">
                        <label for="complain_location">Complaint Location</label>
                        <select class="form-control" id="complain_location"  onchange="create_complain_office_colony('complain_location', 'complain_office_colony')" required="required">
                            <option value="">Select One...</option>
                            <option value="OFFICE">OFFICE</option>
                            <option value="RESIDENCE">RESIDENCE</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="complain_office_colony">Complaint Office/Colony</label>
                        <select class="form-control" id="complain_office_colony" required="required"></select>
                    </div>
                    <div class="form-group">
                        <label for="complain_address">Complaint Address <small>(max 256 characters)</small></label>
                        <input id="complain_address" type="text" class="form-control" placeholder="Full Address" maxlength="256" required="required">
                    </div>
                    <div class="form-group">
                        <label for="complain_description">Complaint Description <small>(max 512 characters)</small></label>
                        <textarea class="form-control" rows="3" id="complain_description" maxlength="512"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="complain_time">Time Availability (for job) <small>(max 128 characters)</small></label>
                        <input id="complain_time" type="text" maxlength="128" class="form-control" placeholder="Preferred time of the day for the job.">
                    </div>
                    <button id="create_complain" type="button" class="btn btn-primary" onclick="create_complain_request()">Create Complaint</button>
                </form>
            </div>
            <div id="view_complains">
                <h3>List of Complaints</h3>
                <hr>
                <div id="delete_result"></div>
                    <?php
                        $conn = connect_db();
                        $query = generate_query($admin_type, $cpf);
                        $result = mysqli_query($conn, $query);
                        if($result && mysqli_num_rows($result) > 0) {
                            $output = generate_records_view($admin_type, $result, $cpf);
                            echo $output;
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
                    <?php
                        $modals = generate_modals($admin_type, $cpf);
                        echo $modals;
                    ?>
            </div>
            <div id="modify_complain"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

        </div>
    </div>
</div>
</body>
</html>