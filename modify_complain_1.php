<?php
include_once 'functions.php';
$d = $_GET['d'];
$data = explode("|", $d);
$id = $data[0];
$admin_type = $data[1];
$conn = connect_db();
$query = "SELECT * FROM complains WHERE complain_id = $id";
$result = mysqli_query($conn, $query);
if($result && mysqli_num_rows($result) === 1) {
    $row = $result->fetch_assoc();
    switch ($admin_type) {
        case 1:
            $output = generate_head_modification_view($row, $id, $admin_type);
            echo $output;
            break;
        case 2:
            $output = generate_head_modification_view($row, $id, $admin_type);
            echo $output;
            break;
        case 3:
            $output = generate_head_modification_view($row, $id, $admin_type);
            echo $output;
            break;
        case 10:
            $output = generate_admin_modification_view($row, $id, $admin_type);
            echo $output;
            break;
        case 20:
            $output = generate_admin_modification_view($row, $id, $admin_type);
            echo $output;
            break;
        case 30:
            $output = generate_admin_modification_view($row, $id, $admin_type);
            echo $output;
            break;
    }
} else {
    echo "KO";
}
mysqli_close($conn);
?>