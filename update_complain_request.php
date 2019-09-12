<?php
include_once 'functions.php';
$d = $_GET['d'];
$data = explode("|", $d);
$cdate = $data[0];
$remark = $data[1];
$id = $data[2];

$conn = connect_db();
$query = "UPDATE complains SET complain_status = \"CLOSED\", complain_cdate = \"$cdate\", complain_remark = \"$remark\" WHERE complain_id = $id";
$result = mysqli_query($conn, $query);

if($result) {
    echo '
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Thank you! The complaint has been succesfully updated.
            </div>
        ';
} else {
    echo $query;
}