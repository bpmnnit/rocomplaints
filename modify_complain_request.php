<?php

header('Access-Control-Allow-Origin: *');
session_start();

include_once 'functions.php';

$data = $_GET['d'];
$data = explode("|", $data);

$complain_id = $data[0];
$complain_type = $data[1];
$complain_category = $data[2];
$complain_location = $data[3];
$complain_address = $data[4];
$complain_description = $data[5];
$complain_time = $data[6];
$complain_status = $data[7];
$complain_remark = $data[8];
$complain_office_colony = $data[9];
$complain_cpf = $_SESSION['cpf'];
$complain_name = $_SESSION['name'];
$complain_desg = $_SESSION['desg'];
$complain_dept = $_SESSION['dept'];
$complain_mob = $_SESSION['mob'];
$admin_type = $_SESSION['admin_type'];

$conn = connect_db();

if($admin_type !== '') {
    $query = "UPDATE complains SET complain_type = \"$complain_type\", complain_category = \"$complain_category\" , complain_location = \"$complain_location\", complain_office_colony = \"$complain_office_colony\", complain_address = \"$complain_address\", complain_description = \"$complain_description\", complain_status = \"$complain_status\" , complain_remark = \"$complain_remark\" WHERE complain_id = $complain_id";
} else {
    $query = "UPDATE complains SET complain_type = \"$complain_type\", complain_category = \"$complain_category\" , complain_location = \"$complain_location\", complain_office_colony = \"$complain_office_colony\", complain_address = \"$complain_address\", complain_description = \"$complain_description\", complain_time = \"$complain_time\" WHERE complain_id = $complain_id";
}

$result = mysqli_query($conn, $query);
if($result) {
    echo '
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Thank you! Your complaint has been succesfully updated.
            </div>
        ';
} else {
    echo "KO";
}

mysqli_close($conn);

?>