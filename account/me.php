<?php
    if(!isset($_SESSION["Username"])){
        include("notloggedin.php");
    }else{
        $Username = $_SESSION["Username"];       
        
        $qv = $conn->query("SELECT * FROM `users` WHERE `Username`='$Username'");
        $r = mysqli_fetch_array($qv);
        if(mysqli_num_rows($qv) >= 1){
            $active = $r['Active'];
            $Status = $r['Status'];
            $Restraurant = $r['Restraurant'];
            $Role = $r['Role'];
            $Id = $r["Id"];
            $IdNumber = $r["Id"];
            $name = $r['Names'];
            $Email = $r['Email'];
            $active = $r['Active'];
            $Address = $r['Address'];
            $Phone = $r['Phone'];
            $password = $r['Password'];
            $imageUrl = $r['Image Name'];
            $Ref = $r['Ref'];
            $CDate = $r['CDate'];
            
            $qvReferredUsers = $conn->query("SELECT * FROM `users` WHERE `Ref`='".$Username."'");
            $rReferredUsers = mysqli_fetch_array($qvReferredUsers);
            $TReferredUsers = mysqli_num_rows($qvReferredUsers);               
            if($TReferredUsers >= 1){
                //while($rReferredUsers = mysqli_fetch_array($qvReferredUsers)){
                    //$TReferredUsers += $rReferredUsers['Amount'];
                //}
            }
            $user = '{"Id":"'.$Id.'","Username": "'.$Username.'","Password": "'.
                    $password.'","Email": "'.$Email.'","Role": "'.$Role.
                    '","Referee": "'.$Ref.
                    '","Phone": "'.$Phone.'","Names": "'. $name.
                    '","Status": "'.$Status.'","imageUrl": "'.$imageUrl.'","Address": "'.$Address.
                    '","CDate": "'.$CDate.'","Active": '.$active.',"TReferredUsers":'.
                    $TReferredUsers.'}';
               
        }else{
            include("notloggedin.php");
        }
    }
?>