<?php
header('Access-Control-Allow-Origin: *');

include_once 'functions.php';

$data = $_GET['d'];
$data = explode("|", $data);
$username = $data[0];
$password = $data[1];

if(isset($username) && isset($password)){

    $conn = connect_db();
    $query = "SELECT * FROM admins WHERE admin_cpf = $username";
    $result = mysqli_query($conn, $query);

    $is_session_started = false;

    if($result && mysqli_num_rows($result) === 1) {
        $row = $result->fetch_assoc();
        $admin_type = $row['admin_type'];
        session_start();
        $_SESSION['admin_type'] = $admin_type;
        $is_session_started = true;
    }
    mysqli_close($conn);

    $adServer = "ldap://10.205.122.250";

    $ldap = ldap_connect($adServer);

    $ldaprdn = 'ONGC' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=ONGC,dc=ONGCGroup,dc=co,dc=in",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        $cpf = ''; $name = ''; $desg = ''; $dept = '';
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            $cpf = intval($info[$i]["samaccountname"][0]);
            $name = explode("-", $info[$i]["name"][0])[0];
            $desg = $info[$i]["title"][0];
            $dept = $info[$i]["department"][0];
            $mob = $info[$i]["mobile"][0];

            if($is_session_started === false) {
                session_start();
                $is_session_started = true;
            }
            $_SESSION['cpf'] = $cpf;
            $_SESSION['name'] = $name;
            $_SESSION['desg'] = $desg;
            $_SESSION['dept'] = $dept;
            $_SESSION['mob'] = $mob;
            $_SESSION['login'] = 1;

            echo 'OK';

            //header("Location: complaints.php");
        }
        @ldap_close($ldap);
    } else {
        echo '<hr>';
        echo '
            <div class="alert alert-danger">
                Error : Authentication Failed - Please check your credentials.
            </div>
        ';
    }
}

?>