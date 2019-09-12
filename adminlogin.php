<?php
header('Access-Control-Allow-Origin: *');

$cpf = $_GET['cpf'];

include_once 'functions.php';
$conn = connect_db();
$query = "SELECT * FROM admins WHERE admin_cpf = $cpf";
$result = mysqli_query($conn, $query);
if($result && mysqli_num_rows($result) === 1) {
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['admin_type'] = $row['admin_type'];
    $_SESSION['cpf'] = $cpf;
    $_SESSION['name'] = $name;
    $_SESSION['desg'] = $desg;
    $_SESSION['dept'] = $dept;
    $_SESSION['mob'] = $mob;
    $_SESSION['login'] = 1;
    echo $row['admin_type'];
} else {
    echo "NO";
}
mysqli_close($conn);
?>