function adlogin() {

    var cpf = document.getElementById("cpf").value;
    var pass = document.getElementById("pwd").value;

    if(cpf === null || cpf === "" || pass === null || pass === "") {
        alert("Please provide the CPF No. and Domain password.");
    } else {
        var request = new XMLHttpRequest();
        request.open("GET", "http://10.208.133.79/rocomplaints/adlogin.php?d=" + encodeURIComponent(cpf) + "|" + encodeURIComponent(pass), true);
        request.send();
        request.onreadystatechange=function() {
            if (request.readyState === 4 && request.status === 200) {
                if (request.responseText === 'OK') {
                    window.location = "complaints.php";
                } else {
                    document.getElementById("login_result").innerHTML = request.responseText;
                }
            }
        }
    }
}

var civil = [
    {display: "Carpentary", value: "Carpentary"},
    {display: "Plastering/Whitewash", value: "Plastering/Whitewash"},
    {display: "Plumbing", value: "Plumbing"},
    {display: "Masonary", value: "Masonary"},
    {display: "Sanitary", value: "Sanitary"},
    {display: "Seepage", value: "Seepage"},
    {display: "Steel Work", value: "Steel Work"},
    {display: "Others", value: "Others"}
];
var electrical = [
    {display: "Light/Fan/Bell/Regulator/Switches", value: "Light/Fan/Bell/Regulator/Switches"},
    {display: "Sparking/Short Circuit/Fire", value: "Sparking/Short Circuit/Fire"},
    {display: "Power Supply", value: "Power Supply"},
    {display: "AC Complaint", value: "AC Complaint"},
    {display: "New Connection", value: "New Connection"},
    {display: "Street Light", value: "Street Light"},
    {display: "Others", value: "Others"}
];
var housekeeping = [
    {display: "Cleaning", value: "Cleaning"},
    {display: "Others", value: "Others"}
];

var infocom = [
    {display: "Telephone(Landline)", value: "Telephone(Landline)"}
];

var office = [
    {display: "NBP Green Heights", value: "NBP Green Heights"},
    {display: "Vasudhara Bhawan", value: "Vasudhara Bhawan"},
    {display: "11 High", value: "11 High"},
    {display: "Helibase", value: "Helibase"},
    {display: "Panvel Office and Institutes", value: "Panvel Office and Institutes"},
    {display: "Maker Tower", value: "Maker Tower"},
    {display: "Nhava", value: "Nhava"}
];

var residence = [
    {display: "Fisherman Mahim Colony", value: "Fisherman Mahim Colony"},
    {display: "D.N. Nagar, Andheri (W)", value: "D.N. Nagar, Andheri (W)"},
    {display: "Dharavi Complex", value: "Dharavi Complex"},
    {display: "JVPD (N), Andheri (W)", value: "JVPD (N), Andheri (W)"},
    {display: "Poonam Nagar", value: "Poonam Nagar"},
    {display: "Bachelor Accommodation-Poonam Nagar", value: "Bachelor Accommodation-Poonam Nagar"},
    {display: "Gokuldham, Goregaon (E)", value: "Gokuldham, Goregaon (E)"},
    {display: "Reclamation, Bandra (W)", value: "Reclamation, Bandra (W)"},
    {display: "BKC, Bandra (E)", value: "BKC, Bandra (E)"},
    {display: "Dixit Road, Vile Parle (E)", value: "Dixit Road, Vile Parle (E)"},
    {display: "Sunder Nagar, Malad (W)", value: "Sunder Nagar, Malad (W)"},
    {display: "Vidya Vihar (E)", value: "Vidya Vihar (E)"},
    {display: "Brij Kutir, Nepean Sea Rd.", value: "Brij Kutir, Nepean Sea Rd."},
    {display: "Jupiter Apts., Colaba", value: "Jupiter Apts., Colaba"},
    {display: "Persepolis Apts., Colaba", value: "Persepolis Apts., Colaba"},
    {display: "Jolly Maker Apts. Colaba", value: "Jolly Maker Apts. Colaba"},
    {display: "Twin Tower, Prabhadevi", value: "Twin Tower, Prabhadevi"},
    {display: "Monalisa Bandra (W)", value: "Monalisa Bandra (W)"},
    {display: "Sea View Apts., Santacruz", value: "Sea View Apts., Santacruz"},
    {display: "Panvel Colony", value: "Panvel Colony"}
];

function list(array_list, id2) {
    $("#" + id2).html("");
    $(array_list).each(function(i) {
        $("#" + id2).append("<option value=\""+array_list[i].value+"\">"+array_list[i].display+"</option>");
    });
}

function create_complain_office_colony(id1, id2) {
    var complain_office_residence = document.getElementById(id1).value;
    switch(complain_office_residence) {
        case 'OFFICE':
            list(office, id2);
            break;
        case 'RESIDENCE':
            list(residence, id2);
            break;
        default:
            $("#" + id2).html("");
            break;
    }
}

function create_complain_categories(id1, id2) {
    var complain_type = document.getElementById(id1).value;
    switch(complain_type) {
        case 'CIVIL':
            list(civil, id2);
            break;
        case 'ELECTRICAL':
            list(electrical, id2);
            break;
        case 'HOUSEKEEPING':
            list(housekeeping, id2);
            break;
        case 'INFOCOM':
            list(infocom, id2);
            break;
        default:
            $("#" + id2).html("");
            break;
    }
}

function create_complain_request() {
    var complain_type = document.getElementById("complain_type").value;
    var complain_category = document.getElementById("complain_category").value;
    var complain_location = document.getElementById("complain_location").value;
    var complain_address = document.getElementById("complain_address").value;
    var complain_description = document.getElementById("complain_description").value;
    var complain_time = document.getElementById("complain_time").value;
    var complain_office_colony = document.getElementById("complain_office_colony").value;

    if(complain_type === null || complain_type === "" || complain_category === null || complain_category === "" || complain_location === null || complain_location === "" || complain_address === null || complain_address === "" || complain_office_colony === null || complain_office_colony === "") {
        alert("Please provide the required information properly.");
    } else {
        var req = new XMLHttpRequest();

        req.open("GET", "http://10.208.133.79/rocomplaints/create_complain.php?d=" + encodeURIComponent(complain_type) + "|" + encodeURIComponent(complain_category) + "|" + encodeURIComponent(complain_location) + "|" + encodeURIComponent(complain_address) + "|" + encodeURIComponent(complain_description) + "|" + encodeURIComponent(complain_time) + "|" + encodeURIComponent(complain_office_colony), true);
        req.send();

        req.onreadystatechange=function() {
            if(req.readyState === 4 && req.status === 200) {
                if(req.responseText === 'KO') {
                    window.location = "test.php";
                } else {
                    document.getElementById("create_complain_result").innerHTML = req.responseText;
                    document.getElementById("create_complain_form").reset();
                    $("#complain_category").html("");
                }
            }
        }
    }
}

$(document).ready(function() {
    $("#create_complain").hide();
    $("#view_complains").show();
});

function show_create_complain() {
    document.getElementById("view_complains").style.display = "none";
    document.getElementById("modify_complain").style.display = "none";
    document.getElementById("create_complain").style.display = "block";
}

function show_view_complains() {
    document.getElementById("view_complains").style.display = "block";
    document.getElementById("create_complain").style.display = "none";
    document.getElementById("modify_complain").style.display = "none";
    location.reload();
}

function modify_complain(complain_id, admin_type) {
    document.getElementById("view_complains").style.display = "none";
    document.getElementById("create_complain").style.display = "none";
    document.getElementById("modify_complain").style.display = "block";

    if(complain_id === null || complain_id === "") {
        alert("Error: complain IDs not generated properly.");
    } else {
        var req = new XMLHttpRequest();

        req.open("GET", "http://10.208.133.79/rocomplaints/modify_complain_1.php?d=" + encodeURIComponent(complain_id) + "|" + encodeURIComponent(admin_type), true);
        req.send();

        req.onreadystatechange=function() {
            if(req.readyState === 4 && req.status === 200) {
                if(req.responseText === 'KO') {
                    window.location = "test.php";
                } else {
                    document.getElementById("modify_complain").innerHTML = req.responseText;
                }
            }
        }
    }
}

function modify_complain_request(mod_complain_id, admin_type = "") {
    var mod_complain_type = document.getElementById("mod_complain_type").value;
    var mod_complain_category = document.getElementById("mod_complain_category").value;
    var mod_complain_location = document.getElementById("mod_complain_location").value;
    var mod_complain_office_colony = document.getElementById("mod_complain_office_colony").value;
    var mod_complain_address = document.getElementById("mod_complain_address").value;
    var mod_complain_description = document.getElementById("mod_complain_description").value;
    var mod_complain_time = "";
    var mod_complain_status = "";
    var mod_complain_remark = "";
    if (admin_type === "") {
        mod_complain_time = document.getElementById("mod_complain_time").value;
    }
    if (admin_type !== "") {
        mod_complain_status = document.getElementById("mod_complain_status").value;
        mod_complain_remark = document.getElementById("mod_complain_remark").value;
    }
    if(mod_complain_id === null || mod_complain_id === "" || mod_complain_type === null || mod_complain_type === "" || mod_complain_category === null || mod_complain_category === "" || mod_complain_location === null || mod_complain_location === "" || mod_complain_address === null || mod_complain_address === "") {
        alert("Error: Make sure required fields are provided.");
    } else {
        var req = new XMLHttpRequest();

        req.open("GET", "http://10.208.133.79/rocomplaints/modify_complain_request.php?d=" + encodeURIComponent(mod_complain_id) + "|" + encodeURIComponent(mod_complain_type) + "|" + encodeURIComponent(mod_complain_category) + "|" + encodeURIComponent(mod_complain_location) + "|" + encodeURIComponent(mod_complain_address) + "|" + encodeURIComponent(mod_complain_description) + "|" + encodeURIComponent(mod_complain_time) + "|" + encodeURIComponent(mod_complain_status) + "|" + encodeURIComponent(mod_complain_remark) + "|" + encodeURIComponent(mod_complain_office_colony), true);

        req.send();

        req.onreadystatechange=function() {
            if(req.readyState === 4 && req.status === 200) {
                if(req.responseText === 'KO') {
                    window.location = "test.php";
                } else {
                    document.getElementById("modify_complain_result").innerHTML = req.responseText;
                    document.getElementById("modify_complain_form").reset();
                    $("#mod_complain_category").html("");
                }
            }
        }
    }
}

function assign_complain($id, $admin_type) {
    var mod_complain_assign_to = document.getElementById('mod_complain_assign_to').value;
    var mod_complain_tdate = document.getElementById('mod_complain_tdate').value;
    var req = new XMLHttpRequest();
    req.open("GET", "http://10.208.133.79/rocomplaints/assign_complain_request.php?d=" + encodeURIComponent(mod_complain_assign_to) + "|" + encodeURIComponent($id) + "|" + encodeURIComponent(mod_complain_tdate), true);
    req.send();
    req.onreadystatechange=function() {
        if(req.readyState === 4 && req.status === 200) {
            if(req.responseText === 'KO') {
                window.location = "test.php";
            } else {
                document.getElementById("assign_complain_result").innerHTML = req.responseText;
                document.getElementById("assign_complain_form").reset();
            }
        }
    }
}

function updt_complain($id, $admin_type) {
    var mod_complain_cdate = document.getElementById('mod_complain_cdate').value;
    var mod_complain_remark = document.getElementById('mod_complain_remark').value;
    var req = new XMLHttpRequest();
    req.open("GET", "http://10.208.133.79/rocomplaints/update_complain_request.php?d=" + encodeURIComponent(mod_complain_cdate) + "|" + encodeURIComponent(mod_complain_remark) + "|" + encodeURIComponent($id), true);
    req.send();
    req.onreadystatechange=function() {
        if(req.readyState === 4 && req.status === 200) {
            if(req.responseText === 'KO') {
                window.location = "test.php";
            } else {
                document.getElementById("assign_complain_result").innerHTML = req.responseText;
                document.getElementById("update_complain_form").reset();
            }
        }
    }
}

function delete_complain(complain_id) {
    if (confirm("Do you really want to delete this record?")) {
        var req = new XMLHttpRequest();

        req.open("GET", "http://10.208.133.79/rocomplaints/delete_complain.php?id=" + encodeURIComponent(complain_id), true);
        req.send();

        req.onreadystatechange=function() {
            if(req.readyState === 4 && req.status === 200) {
                if(req.responseText === 'KO') {
                    window.location = "test.php";
                } else {
                    document.getElementById("delete_result").innerHTML = '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The selected complain has been deleted.</div>';
                    $('#delete_result').delay(5000).fadeOut(400);
                    setTimeout(function() {
                        location.reload();
                    }, 6000);
                }
            }
        }
    }
}