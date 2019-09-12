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
    ?>
    <h3>Update Complaint</h3>
    <h4><small>Complaint Request ID: <?php echo $id; ?></small></h4>
    <hr>
    <div id="modify_complain_result"></div>
    <form action="" method="post" id="modify_complain_form">
        <div class="form-group">
            <label for="mod_complain_type">Complaint Type</label>
            <select class="form-control" id="mod_complain_type" onchange="create_complain_categories('mod_complain_type', 'mod_complain_category')" required="required">
                <option value="">Select One...</option>
                <option value="CIVIL" <?php if(strcmp($row['complain_type'],'CIVIL') == 0) {echo 'selected';}?>>CIVIL</option>
                <option value="ELECTRICAL" <?php if(strcmp($row['complain_type'],'ELECTRICAL') == 0) {echo 'selected';}?>>ELECTRICAL</option>
                <option value="HOUSEKEEPING" <?php if(strcmp($row['complain_type'],'HOUSEKEEPING') == 0) {echo 'selected';}?>>HOUSEKEEPING</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mod_complain_category">Complaint Category (Select One):</label>
            <select class="form-control" id="mod_complain_category" required="required">
                <?php
                    switch($row['complain_type']) {
                        case 'CIVIL':
                            ?>
                            <option value="Carpentary" <?php if(strcmp($row['complain_category'],'Carpentary') == 0) {echo 'selected';}?>>Carpentary</option>
                            <option value="Plastering/Whitewash" <?php if(strcmp($row['complain_category'],'Plastering/Whitewash') == 0) {echo 'selected';}?>>Plastering/Whitewash</option>
                            <option value="Plumbing" <?php if(strcmp($row['complain_category'],'Plumbing') == 0) {echo 'selected';}?>>Plumbing</option>
                            <option value="Masonary" <?php if(strcmp($row['complain_category'],'Masonary') == 0) {echo 'selected';}?>>Masonary</option>
                            <option value="Sanitary" <?php if(strcmp($row['complain_category'],'Sanitary') == 0) {echo 'selected';}?>>Sanitary</option>
                            <option value="Seepage" <?php if(strcmp($row['complain_category'],'Seepage') == 0) {echo 'selected';}?>>Seepage</option>
                            <option value="Steel Work" <?php if(strcmp($row['complain_category'],'Steel Work') == 0) {echo 'selected';}?>>Steel Work</option>
                            <option value="Others" <?php if(strcmp($row['complain_category'],'Others') == 0) {echo 'selected';}?>>Others</option>
                            <?php
                            break;
                        case 'ELECTRICAL':
                            ?>
                            <option value="Light/Fan/Bell/Regulator/Switches" <?php if(strcmp($row['complain_category'],'Light/Fan/Bell/Regulator/Switches') == 0) {echo 'selected';}?>>Light/Fan/Bell/Regulator/Switches</option>
                            <option value="Sparking/Short Circuit/Fire" <?php if(strcmp($row['complain_category'],'Sparking/Short Circuit/Fire') == 0) {echo 'selected';}?>>Sparking/Short Circuit/Fire</option>
                            <option value="Power Supply" <?php if(strcmp($row['complain_category'],'Power Supply') == 0) {echo 'selected';}?>>Power Supply</option>
                            <option value="AC Complaint" <?php if(strcmp($row['complain_category'],'AC Complaint') == 0) {echo 'selected';}?>>AC Complaint</option>
                            <option value="New Connection" <?php if(strcmp($row['complain_category'],'New Connection') == 0) {echo 'selected';}?>>New Connection</option>
                            <option value="Street Light" <?php if(strcmp($row['complain_category'],'Street Light') == 0) {echo 'selected';}?>>Street Light</option>
                            <option value="Others" <?php if(strcmp($row['complain_category'],'Others') == 0) {echo 'selected';}?>>Others</option>
                            <?php
                            break;
                        case 'HOUSEKEEPING':
                            ?>
                            <option value="Cleaning" <?php if(strcmp($row['complain_category'],'Cleaning') == 0) {echo 'selected';}?>>Cleaning</option>
                            <option value="Others" <?php if(strcmp($row['complain_category'],'Others') == 0) {echo 'selected';}?>>Others</option>
                            <?php
                            break;
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mod_complain_location">Complaint Location</label>
            <select class="form-control" id="mod_complain_location" onchange="create_complain_office_colony('mod_complain_location', 'mod_complain_office_colony')" required="required">
                <option value="">Select One...</option>
                <option value="OFFICE" <?php if(strcmp($row['complain_location'],'OFFICE') == 0) {echo 'selected';}?>>OFFICE</option>
                <option value="RESIDENCE" <?php if(strcmp($row['complain_location'],'RESIDENCE') == 0) {echo 'selected';}?>>RESIDENCE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mod_complain_office_colony">Complain Office/Colony</label>
            <select class="form-control" id="mod_complain_office_colony" required="required">
                <?php
                switch($row['complain_location']) {
                    case 'OFFICE':
                        ?>
                        <option value="Vasudhara Bhawan" <?php if(strcmp($row['complain_office_colony'],'Vasudhara Bhawan') == 0) {echo 'selected';}?>>Vasudhara Bhawan</option>
                        <option value="NBP Green Heights" <?php if(strcmp($row['complain_office_colony'],'NBP Green Heights') == 0) {echo 'selected';}?>>NBP Green Heights</option>
                        <option value="11 High" <?php if(strcmp($row['complain_office_colony'],'11 High') == 0) {echo 'selected';}?>>11 High</option>
                        <option value="Panvel" <?php if(strcmp($row['complain_office_colony'],'Panvel') == 0) {echo 'selected';}?>>Panvel</option>
                        <option value="Helibase" <?php if(strcmp($row['complain_office_colony'],'Helibase') == 0) {echo 'selected';}?>>Helibase</option>
                        <?php
                        break;
                    case 'RESIDENCE':
                        ?>
                        <option value="Fisherman Mahim Colony" <?php if(strcmp($row['complain_office_colony'],'Fisherman Mahim Colony') == 0) {echo 'selected';}?>>Fisherman Mahim Colony</option>
                        <option value="D.N. Nagar, Andheri (W)" <?php if(strcmp($row['complain_office_colony'],'D.N. Nagar, Andheri (W)') == 0) {echo 'selected';}?>>D.N. Nagar, Andheri (W)</option>
                        <option value="Dharavi Complex" <?php if(strcmp($row['complain_office_colony'],'Dharavi Complex') == 0) {echo 'selected';}?>>Dharavi Complex</option>
                        <option value="JVPD (N), Andheri (W)" <?php if(strcmp($row['complain_office_colony'],'JVPD (N), Andheri (W)') == 0) {echo 'selected';}?>>JVPD (N), Andheri (W)</option>
                        <option value="Poonam Nagar" <?php if(strcmp($row['complain_office_colony'],'Poonam Nagar') == 0) {echo 'selected';}?>>Poonam Nagar</option>
                        <option value="Bachelor Accommodation-Poonam Nagar" <?php if(strcmp($row['complain_office_colony'],'Bachelor Accommodation-Poonam Nagar') == 0) {echo 'selected';}?>>Bachelor Accommodation-Poonam Nagar</option>
                        <option value="Gokuldham, Goregaon (E)" <?php if(strcmp($row['complain_office_colony'],'Gokuldham, Goregaon (E)') == 0) {echo 'selected';}?>>Gokuldham, Goregaon (E)</option>
                        <option value="Reclamation, Bandra (W)" <?php if(strcmp($row['complain_office_colony'],'Reclamation, Bandra (W)') == 0) {echo 'selected';}?>>Reclamation, Bandra (W)</option>
                        <option value="BKC, Bandra (E)" <?php if(strcmp($row['complain_office_colony'],'BKC, Bandra (E)') == 0) {echo 'selected';}?>>BKC, Bandra (E)</option>
                        <option value="Dixit Road, Vile Parle (E)" <?php if(strcmp($row['complain_office_colony'],'Dixit Road, Vile Parle (E)') == 0) {echo 'selected';}?>>Dixit Road, Vile Parle (E)</option>
                        <option value="Sunder Nagar, Malad (W)" <?php if(strcmp($row['complain_office_colony'],'Sunder Nagar, Malad (W)') == 0) {echo 'selected';}?>>Sunder Nagar, Malad (W)</option>
                        <option value="Vidya Vihar (E)" <?php if(strcmp($row['complain_office_colony'],'Vidya Vihar (E)') == 0) {echo 'selected';}?>>Vidya Vihar (E)</option>
                        <option value="Brij Kutir, Nepean Sea Rd." <?php if(strcmp($row['complain_office_colony'],'Brij Kutir, Nepean Sea Rd.') == 0) {echo 'selected';}?>>Brij Kutir, Nepean Sea Rd.</option>
                        <option value="Jupiter Apts., Colaba" <?php if(strcmp($row['complain_office_colony'],'Jupiter Apts., Colaba') == 0) {echo 'selected';}?>>Jupiter Apts., Colaba</option>
                        <option value="Persepolis Apts., Colaba" <?php if(strcmp($row['complain_office_colony'],'Persepolis Apts., Colaba') == 0) {echo 'selected';}?>>Persepolis Apts., Colaba</option>
                        <option value="Jolly Maker Apts. Colaba" <?php if(strcmp($row['complain_office_colony'],'Jolly Maker Apts. Colaba') == 0) {echo 'selected';}?>>Jolly Maker Apts. Colaba</option>
                        <option value="Twin Tower, Prabhadevi" <?php if(strcmp($row['complain_office_colony'],'Twin Tower, Prabhadevi') == 0) {echo 'selected';}?>>Twin Tower, Prabhadevi</option>
                        <option value="Monalisa Bandra (W)" <?php if(strcmp($row['complain_office_colony'],'Monalisa Bandra (W)') == 0) {echo 'selected';}?>>Monalisa Bandra (W)</option>
                        <option value="Sea View Apts., Santacruz" <?php if(strcmp($row['complain_office_colony'],'Sea View Apts., Santacruz') == 0) {echo 'selected';}?>>Sea View Apts., Santacruz</option>
                        <?php
                        break;
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="mod_complain_address">Complaint Address</label>
            <input id="mod_complain_address" type="text" class="form-control" placeholder="Full Address" required="required" value="<?php echo $row['complain_address']; ?>">
        </div>
        <div class="form-group">
            <label for="mod_complain_description">Complaint Description</label>
            <textarea class="form-control" rows="3" id="mod_complain_description"><?php echo $row['complain_description']; ?></textarea>
        </div>
        <?php
            if ($admin_type === "" || (strcmp($admin_type, $row['complain_type']) !== 0) || strcmp($admin_type, 'ALL') !== 0) {
                ?>
                <div class="form-group">
                    <label for="mod_complain_time">Time Availability (for job)</label>
                    <input id="mod_complain_time" type="text" class="form-control"
                           placeholder="Preferred time of the day for the job."
                           value="<?php echo $row['complain_time']; ?>">
                </div>
        <?php
            }
        ?>
        <?php
            if(($admin_type !== "" && strcmp($admin_type, $row['complain_type']) === 0) || strcmp($admin_type, 'ALL') === 0) {
        ?>
                <div class="form-group">
                    <label for="mod_complain_status">Complaint Status</label>
                    <select class="form-control" id="mod_complain_status" required="required">
                        <option value="">Select One...</option>
                        <option value="OPEN" <?php if(strcmp($row['complain_status'],'OPEN') == 0) {echo 'selected';}?>>OPEN</option>
                        <option value="OPEN" <?php if(strcmp($row['complain_status'],'ASSIGNED') == 0) {echo 'selected';}?>>ASSIGNED</option>
                        <option value="CLOSED" <?php if(strcmp($row['complain_status'],'CLOSED') == 0) {echo 'selected';}?>>CLOSED</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mod_complain_remark">Remarks</label>
                    <input id="mod_complain_remark" type="text" class="form-control" placeholder="Remarks for completion of Job/Complaint." value="<?php echo $row['complain_remark']; ?>">
                </div>
        <?php
            }
        ?>
        <button id="update_complain" type="button" class="btn btn-primary" onclick="modify_complain_request(<?php echo "$id".","."'$admin_type'"; ?>)">Modify Complaint</button>
    </form>
<?php
} else {
    echo "KO";
}
mysqli_close($conn);
?>