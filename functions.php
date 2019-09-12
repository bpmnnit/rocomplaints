<?php

function connect_db() {
    $host = "localhost";
    $user = "root";
    $password = "harekrishna";
    $db = "rocomplaints";

    $conn = mysqli_connect($host, $user, $password, $db);

    if(!$conn) { die("Connection failed: ". mysqli_connect_error()); }

    return $conn;
}

function generate_query($admin_type, $cpf) {
    switch ($admin_type) {
        case 1:
            $query = "SELECT * FROM complains WHERE complain_type = \"CIVIL\" OR complain_cpf = $cpf";
            break;
        case 2:
            $query = "SELECT * FROM complains WHERE complain_type = \"ELECTRICAL\" OR complain_cpf = $cpf";
            break;
        case 3:
            $query = "SELECT * FROM complains WHERE complain_type = \"HOUSEKEEPING\" OR complain_cpf = $cpf";
            break;
        case 10:
            $query = "SELECT * FROM complains WHERE (complain_type = \"CIVIL\" AND complain_assigned_to = $cpf) OR complain_cpf = $cpf";
            break;
        case 20:
            $query = "SELECT * FROM complains WHERE (complain_type = \"ELECTRICAL\" AND complain_assigned_to = $cpf) OR complain_cpf = $cpf";
            break;
        case 30:
            $query = "SELECT * FROM complains WHERE (complain_type = \"HOUSEKEEPING\" AND complain_assigned_to = $cpf) OR complain_cpf = $cpf";
            break;
        case 100:
            $query = "SELECT * FROM complains";
            break;
        default:
            $query = "SELECT * FROM complains WHERE complain_cpf = $cpf";
            break;
    }
    return $query;
}

function create_heads_view($admin_type, $result, $cpf) {
    $output = '';
    $output .= '<table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Office/Colony</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Dated</th>
                                <th>Status</th>
                                <th>AssigendTo</th>
                                <th>TentativeCompDt</th>
                                <th>Closing Remarks</th>
                                <th>Comp Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
    while ($row = $result->fetch_assoc()) {
        $output .= '<tr><td>' . $row['complain_id'] . '</td><td>' . $row['complain_cpf'] . '</td><td>' . $row['complain_type'] . '</td><td>' . $row['complain_location'] . '</td><td>' . $row['complain_office_colony'] . '</td><td>' . $row['complain_address'] . '</td><td>' . $row['complain_description'] . '</td><td>' . $row['complain_createdat'] . '</td><td>' . $row['complain_status'] . '</td><td>' . $row['complain_assigned_to'] . '</td><td>' . $row['complain_tdate'] . '</td><td>' . $row['complain_remark'] . '</td><td>' . $row['complain_cdate'] . '</td>';
        if($row["complain_cpf"] == $cpf && $admin_type != get_admin_type($row["complain_type"], $admin_type)) {
            $output .= '<td><a href="#" data-toggle="modal" data-target="#myModal' . $row["complain_id"] . '"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-original-title="View"></span></a></td></tr>';
        } else if($row["complain_cpf"] == $cpf && $admin_type == get_admin_type($row["complain_type"], $admin_type) && ($admin_type == 10 || $admin_type == 20 || $admin_type == 30) && $row["complain_assigned_to"] != $cpf){
            $output .= '<td><a href="#" data-toggle="modal" data-target="#myModal' . $row["complain_id"] . '"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-original-title="View"></span></a></td></tr>';
        } else {
            $output .= '<td><a href="#" data-toggle="modal" data-target="#myModal' . $row["complain_id"] . '"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-original-title="View"></span></a>&nbsp;<a href="#" onclick="modify_complain(\'' . $row['complain_id'] . '\', \'' . $admin_type . '\')"><span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-original-title="Edit"></span></a></td></tr>';
        }
    }
    $output .= '</tbody></table>';
    return $output;
}

function get_admin_type($comp_type, $admin_type) {
    $t = -1;
    if(strcmp($comp_type, "CIVIL") == 0 && ($admin_type == 1 || $admin_type == 2 || $admin_type == 3)){
        $t = 1;
    } else if(strcmp($comp_type, "ELECTRICAL") == 0 && ($admin_type == 1 || $admin_type == 2 || $admin_type == 3)){
        $t = 2;
    } else if(strcmp($comp_type, "HOUSEKEEPING") == 0 && ($admin_type == 1 || $admin_type == 2 || $admin_type == 3)){
        $t = 3;
    } else if(strcmp($comp_type, "CIVIL") == 0 && ($admin_type == 10 || $admin_type == 20 || $admin_type == 30)){
        $t = 10;
    } else if(strcmp($comp_type, "ELECTRICAL") == 0 && ($admin_type == 10 || $admin_type == 20 || $admin_type == 30)){
        $t = 20;
    } else if(strcmp($comp_type, "HOUSEKEEPING") == 0 && ($admin_type == 10 || $admin_type == 20 || $admin_type == 30)){
        $t = 30;
    }
    return $t;
}

function create_user_view($admin_type, $result) {
    $output = '';
    $output .= '<table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Office/Colony</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Dated</th>
                                <th>Status</th>
                                <th>AssigendTo</th>
                                <th>TentativeCompDt</th>
                                <th>Closing Remarks</th>
                                <th>Comp Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
    while ($row = $result->fetch_assoc()) {
        $output .= '<tr><td>' . $row['complain_id'] . '</td><td>' . $row['complain_cpf'] . '</td><td>' . $row['complain_type'] . '</td><td>' . $row['complain_location'] . '</td><td>' . $row['complain_office_colony'] . '</td><td>' . $row['complain_address'] . '</td><td>' . $row['complain_description'] . '</td><td>' . $row['complain_createdat'] . '</td><td>' . $row['complain_status'] . '</td><td>' . $row['complain_assigned_to'] . '</td><td>' . $row['complain_tdate'] . '</td><td>' . $row['complain_remark'] . '</td><td>' . $row['complain_cdate'] . '</td><td><a href="#" data-toggle="modal" data-target="#myModal' . $row["complain_id"] . '"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-original-title="View"></span></a></td></tr>';
    }
    $output .= '</tbody></table>';
    return $output;
}

function create_super_heads_view($result) {
    $output = "";
    $output .= '<table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Office/Colony</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Dated</th>
                                <th>Status</th>
                                <th>AssigendTo</th>
                                <th>TentativeCompDt</th>
                                <th>Closing Remarks</th>
                                <th>Comp Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>';
    while ($row = $result->fetch_assoc()) {
        $output .= '<tr><td>' . $row['complain_id'] . '</td><td>' . $row['complain_cpf'] . '</td><td>' . $row['complain_type'] . '</td><td>' . $row['complain_location'] . '</td><td>' . $row['complain_office_colony'] . '</td><td>' . $row['complain_address'] . '</td><td>' . $row['complain_description'] . '</td><td>' . $row['complain_createdat'] . '</td><td>' . $row['complain_status'] . '</td><td>' . $row['complain_assigned_to'] . '</td><td>' . $row['complain_tdate'] . '</td><td>' . $row['complain_remark'] . '</td><td>' . $row['complain_cdate'] . '</td><td><a href="#" data-toggle="modal" data-target="#myModal' . $row["complain_id"] . '"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" data-original-title="View"></span></a></td></tr>';
    }
    $output .= '</tbody></table>';
    return $output;
}

function generate_records_view($admin_type, $result, $cpf) {
    switch($admin_type) {
        case 1: // Head of civil - only view and assignment
            $output = create_heads_view($admin_type, $result, $cpf);
            break;
        case 2: // // Head of electrical - only view and assignment
            $output = create_heads_view($admin_type, $result, $cpf);
            break;
        case 3: // // Head of housekeeping - only view and assignment
            $output = create_heads_view($admin_type, $result, $cpf);
            break;
        case 10: // admin of civil - Can view, modify and close
            $output = create_heads_view($admin_type, $result, $cpf);
            break;
        case 20: // Head of electrical - Can view, modify and close
            $output = create_heads_view($admin_type, $result, $cpf);
            break;
        case 30: // Head of housekeeping - Can view, modify and close
            $output = create_heads_view($admin_type, $result, $cpf);
            break;
        case 100: // Super heads - Can view only
            $output = create_super_heads_view($result);
            break;
        default: // Head of civil - only view and assignment
            $output = create_user_view($admin_type, $result);
            break;
    }
    return $output;
}

function generate_modals($admin_type, $cpf) {
    $conn = connect_db();
    $query = generate_query($admin_type, $cpf);
    $result = mysqli_query($conn, $query);
    $output = '';
    if($result && mysqli_num_rows($result) > 0) {
        while($row = $result->fetch_assoc()) {
            $output .= '<div id="myModal'.$row["complain_id"].'" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Complaint ID # '.$row["complain_id"].'</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr><th>Item</th><th>Item Details</th></tr>
                            </thead>
                            <tbody>
                            <tr><td class="info">User</td><td class="success">'.$cpf.'</td></tr>
                            <tr><td class="info">Complaint Type</td><td class="success">'.$row["complain_type"].'</td></tr>
                            <tr><td class="info">Complaint Category</td><td class="success">'.$row["complain_category"].'</td></tr>
                            <tr><td class="info">Complaint Location</td><td class="success">'.$row["complain_location"].'</td></tr>
                            <tr><td class="info">Complaint Office/Colony</td><td class="success">'.$row["complain_office_colony"].'</td></tr>
                            <tr><td class="info">Complaint Address</td><td class="success">'.$row["complain_address"].'</td></tr>
                            <tr><td class="info">Complaint Description</td><td class="success">'.$row["complain_description"].'</td></tr>
                            <tr><td class="info">Complaint Status</td><td class="success">'.$row["complain_status"].'</td></tr>
                            <tr><td class="info">Complaint Register Date</td><td class="success">'.$row["complain_createdat"].'</td></tr>
                            <tr><td class="info">Complaint Completion Remarks</td><td class="success">'.$row["complain_remark"].'</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';
        }
    } else {
        $output = '';
    }
    mysqli_close($conn);
    return $output;
}

function modification_info($row, $id) {
    $output = '';
    $output .= '<h3>Update Complaint</h3><h4><small>Complaint Request ID: '.$id.'</small></h4><hr>';
    $output .= '<div id="assign_complain_result"></div>';
    $output .= '<table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Office/Colony</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Time Availability</th>
                                <th>Status</th>
                                <th>Create Date</th>
                            </tr>
                            <tbody>
                            <tr><td>'.$id.'</td><td>'.$row["complain_type"].'</td><td>'.$row["complain_category"].'</td><td>'.$row["complain_location"].'</td><td>'.$row["complain_office_colony"].'</td><td>'.$row["complain_address"].'</td><td>'.$row["complain_description"].'</td><td>'.$row["complain_time"].'</td><td>'.$row["complain_status"].'</td><td>'.$row["complain_createdat"].'</td></tr>
                            </tbody></table>';
    return $output;
}

function generate_head_modification_view($row, $id, $admin_type) {
    $output = modification_info($row, $id);
    switch ($admin_type) {
        case 1:
            $output .= '<form action="" method="post" id="assign_complain_form">
                            <div class="form-group">
                                <label for="mod_complain_assign_to">Assign To</label>
                                <select class="form-control" id="mod_complain_assign_to" required="required">';
            $conn = connect_db();
            $query = "SELECT * FROM admins WHERE admin_type = 10";
            $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0) {
                while ($r = $result->fetch_assoc()) {
                    $output .= '<option value="'.$r["admin_cpf"].'">'.$r["admin_name"].'</option>';
                }
            }
            mysqli_close($conn);
            $output .= '</select></div><div class="form-group"><label for="mod_complain_tdate">Tentative Completion Date</label><input id="mod_complain_tdate" type="date" class="form-control" placeholder="Tentative Completion Date" required="required"></div><button id="update_complain" type="button" class="btn btn-primary" onclick="assign_complain('.$id.','.$admin_type.')">Modify Complaint</button></form>';
            break;
        case 2:
            $output .= '<form action="" method="post" id="assign_complain_form">
                            <div class="form-group">
                                <label for="mod_complain_assign_to">Assign To</label>
                                <select class="form-control" id="mod_complain_assign_to" required="required">';
            $conn = connect_db();
            $query = "SELECT * FROM admins WHERE admin_type = 20";
            $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0) {
                while ($r = $result->fetch_assoc()) {
                    $output .= '<option value="'.$r["admin_cpf"].'">'.$r["admin_name"].'</option>';
                }
            }
            mysqli_close($conn);
            $output .= '</select></div><div class="form-group"><label for="mod_complain_tdate">Tentative Completion Date</label><input id="mod_complain_tdate" type="date" class="form-control" placeholder="Tentative Completion Date" required="required"></div><button id="update_complain" type="button" class="btn btn-primary" onclick="assign_complain('.$id.','.$admin_type.')">Modify Complaint</button></form>';
            break;
        case 3:
            $output .= '<form action="" method="post" id="assign_complain_form">
                            <div class="form-group">
                                <label for="mod_complain_assign_to">Assign To</label>
                                <select class="form-control" id="mod_complain_assign_to" required="required">';
            $conn = connect_db();
            $query = "SELECT * FROM admins WHERE admin_type = 30";
            $result = mysqli_query($conn, $query);
            if($result && mysqli_num_rows($result) > 0) {
                while ($r = $result->fetch_assoc()) {
                    $output .= '<option value="'.$r["admin_cpf"].'">'.$r["admin_name"].'</option>';
                }
            }
            mysqli_close($conn);
            $output .= '</select></div><div class="form-group"><label for="mod_complain_tdate">Tentative Completion Date</label><input id="mod_complain_tdate" type="date" class="form-control" placeholder="Tentative Completion Date" required="required"></div><button id="update_complain" type="button" class="btn btn-primary" onclick="assign_complain('.$id.','.$admin_type.')">Modify Complaint</button></form>';
            break;
    }
    return $output;
}

function generate_admin_modification_view($row, $id, $admin_type) {
    $output = modification_info($row, $id);
    switch ($admin_type) {
        case 10:
            $output .= '<form action="" method="post" id="update_complain_form"><div class="form-group"><label for="mod_complain_cdate">Completion Date</label><input id="mod_complain_cdate" type="date" class="form-control" required="required"></div><div class="form-group"><label for="mod_complain_remark">Closing Remarks</label><input id="mod_complain_remark" type="text" class="form-control" placeholder="Remarks for completion of Job/Complaint."></div><button id="update_complain" type="button" class="btn btn-primary" onclick="updt_complain('.$id.','.$admin_type.')">Update Complaint</button></form>';
            break;
        case 20:
            $output .= '<form action="" method="post" id="update_complain_form"><div class="form-group"><label for="mod_complain_cdate">Completion Date</label><input id="mod_complain_cdate" type="date" class="form-control" required="required"></div><div class="form-group"><label for="mod_complain_remark">Closing Remarks</label><input id="mod_complain_remark" type="text" class="form-control" placeholder="Remarks for completion of Job/Complaint."></div><button id="update_complain" type="button" class="btn btn-primary" onclick="updt_complain('.$id.','.$admin_type.')">Update Complaint</button></form>';
            break;
        case 30:
            $output .= '<form action="" method="post" id="update_complain_form"><div class="form-group"><label for="mod_complain_cdate">Completion Date</label><input id="mod_complain_cdate" type="date" class="form-control" required="required"></div><div class="form-group"><label for="mod_complain_remark">Closing Remarks</label><input id="mod_complain_remark" type="text" class="form-control" placeholder="Remarks for completion of Job/Complaint."></div><button id="update_complain" type="button" class="btn btn-primary" onclick="updt_complain('.$id.','.$admin_type.')">Update Complaint</button></form>';
            break;
    }
    return $output;
}
?>