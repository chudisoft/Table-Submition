<?php
    include('config.php');
    if(!isset($_SESSION['Username']))
    {
        // include("notloggedin.php");
        // return;
        echo 'Unauthorize request!'; return;
    }
    include('me.php');
	$username = $_SESSION['Username'];

	if(isset($_POST['selectedNumber'])){
		$selectedNumber = validate($conn, $_POST['selectedNumber']);

        if($username == '' || $selectedNumber == ''){
            echo 'Invalid request!'; return;
        }else{
            if($selectedNumber >= 1){
                $returnMessage = "";
                $date = date('Y/m/d H:i:s');
		        // $Id = GUID(); 
                            
                //Add the invoice to the database
                $stmt = $conn->prepare("INSERT INTO table_records (`Username`, `Date`, `Table`) values ('$username','$date',?)");
                $stmt->bind_param("d", $selectedNumber);
                $result = $stmt->execute();

                if (!$result) {
                    die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                    return;
                }
                // echo "<p class='text-primary'>Data submited successfully!</p>";
                echo "Data submited successfully!";
                return;
            }else {
                    // echo '<p class="text-danger">Table number must be up to 1!</p>'; 
                    echo 'Table number must be up to 1!'; 
                return;
            }
        }
    }elseif(isset($_GET['code']) && isset($_GET['action'])){
        $date = date('Y/m/d H:i:s');
        $code = $_GET['code'];
        $action = $_GET['action'];
        
        $qv = $conn->query("SELECT * FROM `table_records` WHERE `Id`=$code");
        $r = mysqli_fetch_array($qv);
        if(mysqli_num_rows($qv) <= 0){
            echo "Record not found!"; return;
        }
        if($_SESSION['Role'] != "Admin")
        {
            include("notloggedin.php");
            return;
        }
        $username = $r["Username"];
        if($action=="Delete"){
            $stmt = "Delete FROM table_records Where `Id`=$code";
            if ($conn->query($stmt) === TRUE) {
            } else {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }
            echo "Record was deleted!"; return;              
		}
    }else{
        //echo '<p class="text-danger"> Amount is required!</p>';
    }
    
?>