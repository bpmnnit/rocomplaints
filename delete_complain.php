<?php
include_once 'functions.php';
$id = $_GET['id'];
$conn = connect_db();
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = "DELETE FROM complains WHERE complain_id = $id";
$result = mysqli_query($conn, $query);
if($result && mysqli_affected_rows($conn) > 0) {
    echo "OK";
} else {
    echo "KO";
}
mysqli_close($conn);
?>