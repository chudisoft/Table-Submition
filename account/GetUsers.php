<?php
include('config.php');

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);

$Email = "";
$Role = "";
$Id = "";
$successMessage = "";
$errorMessage = '';
$PlanMsgs = "";

$username = $data->Username;
$username = validate($conn, $username);

$stmt = $conn->query("Select * FROM users");
$i = 0;
while ($r = mysqli_fetch_array($stmt)) {
    $i++;
    $name = $r['Names'];
    $email = $r['Email'];
    $active = $r['Active'];
    $status = $r['Status'];
    $country = $r['Address'];
    $password = $r['Password'];
    $Username = $r['Username'];
    $phone = $r['Phone'];
    //$plain = $r['plain'];
    //$code = $r['hash_p'];
    //$Ref = $r['Ref'];
    $CDate = $r['CDate'];
    $Id = $r['Id'];

    $Id = $r['Username'];

    $PlanMsg = '{Id:"' . $Id . '",Username: "' . $Username . '",Password: "' . $password .
        '",Email: "' . $email . '",Role: "' . $Role . '",errorMessage: "' . $errorMessage .
        '",successMessage: "' . $successMessage . ',Referee: "' .
        $Ref . '",Phone: "' . $phone . '",Address: "' . $country . '",Names: "' . $name .
        '",CDate: "' . $CDate . '",Active: ' . $active . '}';

    if (isset($data->SearchField)) {
        $search = $data->SearchField;
        if ($search == $name || $search == $Desc) {
            if ($PlanMsgs == "")
                $PlanMsgs .= $PlanMsg;
            else
                $PlanMsgs .= "," . $PlanMsg;
        }
    } else {
        if ($PlanMsgs == "")
            $PlanMsgs .= $PlanMsg;
        else
            $PlanMsgs .= "," . $PlanMsg;
    }
}
echo $myObj = '[' . $PlanMsgs . ']';
