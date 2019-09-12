<?php
include_once 'functions.php';
$d = $_GET['d'];
$data = explode("|", $d);
$id = $data[1];
$assignTo = $data[0];
$tdate = $data[2];

$conn = connect_db();
$query = "UPDATE complains SET complain_assigned_to = $assignTo, complain_tdate = \"$tdate\", complain_status = \"ASSIGNED\" WHERE complain_id = $id";
$result = mysqli_query($conn, $query);

if($result) {
    echo '
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Thank you! The complaint has been succesfully assigned.
            </div>
        ';
} else {
    echo $query;
}