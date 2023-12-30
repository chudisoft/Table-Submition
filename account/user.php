<?php
    include('config.php');
    include('me.php');
    if(!isset($_SESSION['Username']))
    {
        include("notloggedin.php");
        return;
    }
	$username = $_SESSION['Username'];
	if(isset($_POST['Username'])){
		$username = $_SESSION[''];
		$Id = validate($conn, $_POST['Username']);

        $name = $r['Names'];
        $email = $r['Email'];
        $active = $r['Active'];
        $status = $r['Status'];
        $password = $r['Password'];
        //$plain = $r['plain'];
        //$code = $r['hash_p'];
        $Ref = $r['Ref'];

        $del = '<btn onclick="if(confirm(\'Delete this item?\'))
            {PostForAlert(\'user.php?code='.$Id.'&action=Delete\', this);}"
            title="Delete User" class="btn btn-danger fa fa-trash"></btn>';
        $pn = "";
        $cn = "";
                
        if($status == '0'){
            $pn = '<btn onclick="if(confirm(\'Approve this item?\'))
                {PostForAlert(\'user.php?code='.$Id.'&action=Approve\', this);}" 
                    title="Approve User" class="btn btn-primary fa fa-check-square-o"></btn> | ';
            $s = '<span class="text-primary" style="">Pending Approval</span>';
        }elseif($status == '1'){
            $s = '<span style="color: #228B22;">Approved</span>';
            $cn = '<btn onclick="if(confirm(\'Deapprove this item?\'))
                {PostForAlert(\'user.php?code='.$Id.'&action=Deapprove\', this);}" 
                    title="Deapprove User" class="btn btn-success fa fa-close"></btn> | ';
        }else{
            $s = '<span style="color: #b22222;">Not Approved</span>';
        }
    }elseif(isset($_GET['code']) && isset($_GET['action'])){   
        $code = validate($conn, $_GET['code']);
        if ($code == "Administrator") {
            echo "Error: Invalid action!"; return;
        }
        $date = date('Y/m/d H:i:s');
        $code = $_GET['code'];
        $action = $_GET['action'];
        
        $qv = $conn->query("SELECT * FROM `users` WHERE `Username`='$code'");
        $r = mysqli_fetch_array($qv);
        if(mysqli_num_rows($qv) <= 0){
            echo "User not found!"; return;
        }
        $approve = $r["Active"];
        if($action=="Approve"){
            $stmt = "Update users Set `Active` = 1 WHERE `Username`='$code'";
            if ($conn->query($stmt) === TRUE) {
            } else {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }

            echo "User Active!"; return;
		}
        elseif($action=="Deapprove"){
            $stmt = "Update users Set `Active` = 0 WHERE `Username`='$code'";
            if ($conn->query($stmt) === TRUE) {
            } else {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }
            echo "User's Active status was cancelled!"; return;              
		}
        elseif($action=="Delete"){
            $stmt = "Delete FROM users WHERE `Username`='$code'";
            if ($conn->query($stmt) === TRUE) {
            } else {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }
            echo "User was deleted!"; return;              
		}
    }else{
        //echo '<p class="text-danger"> Username is required!</p>';
    }
    include("header.php");
?>

<?php
    include("footer.php");
?>