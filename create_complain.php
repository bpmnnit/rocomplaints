<?php

header('Access-Control-Allow-Origin: *');
session_start();

include_once 'functions.php';

$data = $_GET['d'];
$data = explode("|", $data);

$complain_type = $data[0];
$complain_category = $data[1];
$complain_location = $data[2];
$complain_address = $data[3];
$complain_description = $data[4];
$complain_time = $data[5];
$complain_office_colony = $data[6];
$complain_cpf = $_SESSION['cpf'];
$complain_name = $_SESSION['name'];
$complain_desg = $_SESSION['desg'];
$complain_dept = $_SESSION['dept'];
$complain_mob = $_SESSION['mob'];
$complain_createdat = date('Y-m-d');

if(strcmp($complain_location, "OFFICE") === 0) {
    $complain_colony = "";
}

$conn = connect_db();

$query = "INSERT INTO complains (complain_type, complain_category, complain_location, complain_office_colony, complain_address, complain_description, complain_time, complain_cpf, complain_name, complain_desg, complain_dept, complain_mob, complain_createdat) VALUES (\"$complain_type\", \"$complain_category\", \"$complain_location\", \"$complain_office_colony\", \"$complain_address\", \"$complain_description\",  \"$complain_time\",$complain_cpf, \"$complain_name\", \"$complain_desg\", \"$complain_dept\", \"$complain_mob\", \"$complain_createdat\")";

$result = mysqli_query($conn, $query);
if($result) {
    echo '
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Thank you! Your complaint has been succesfully registered.
            </div>
        ';
} else {
    echo "KO";
}

mysqli_close($conn);

?>