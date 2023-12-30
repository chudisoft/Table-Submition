<?php
    include('config.php');
    include('me.php');
    if(!isset($_SESSION['Username']))
    {
        include("notloggedin.php");
        return;
    }else if($_SESSION['Role'] != "Admin"){
        include("notloggedin.php");
        return;        
    }
	$username = $_SESSION['Username'];
    $Id = 0;
    $totaltables = 0;

	if(isset($_POST['totaltables'])){
		$totaltables = validate($conn, $_POST['totaltables']);

        $qv = $conn->query("SELECT * FROM `sitesettings`");
        $r = mysqli_fetch_array($qv);
        if(mysqli_num_rows($qv) <= 0){
            $stmt = $conn->prepare("INSERT INTO sitesettings (`totaltables`) values (?)");
            $stmt->bind_param("d", $totaltables);
            $result = $stmt->execute();

            if (!$result) {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }
            echo "<p class='text-primary'>Record was added successfull.</p>";
            return;
        }else{
            $stmt = "Update sitesettings Set `totaltables` = '$totaltables'";
            if ($conn->query($stmt) === TRUE) {
                echo "Record was updated successfully!"; return;
            } else {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }
        }
        //print json_encode(array('input_address' => $response->address ));

    }elseif(isset($_GET['code']) && isset($_GET['action'])){   
        $code = validate($conn, $_GET['code']);
        if ($code == "Administrator") {
            echo "Error: Invalid action!"; return;
        }
        $code = $_GET['code'];
        $action = $_GET['action'];
        
        if($action=="Edit"){
            $qv = $conn->query("SELECT * FROM `sitesettings` WHERE `Id`='$code'");
            $r = mysqli_fetch_array($qv);
            if(mysqli_num_rows($qv) <= 0){
                echo "Record not found!"; return;
            }
            
            $Id = $r['Id'];
            $totaltables = $r['totaltables'];
		}
        elseif($action=="Delete"){
            $stmt = "Delete FROM sitesettings WHERE `Id`='$code'";
            if ($conn->query($stmt) === TRUE) {
            } else {
                die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                return;
            }
            echo "Record was deleted!"; return;              
		}
    }else{
        //echo '<p class="text-danger"> All values are required!</p>';
        $que12 = $conn->query("SELECT * FROM `sitesettings`");
        while($r = mysqli_fetch_array($que12)){
            $Id = $r['Id'];
            $totaltables = $r['totaltables'];
        }
    }
    include("header.php");
?>
<div class="card">
    <div class="card-header text-center"><h3>Update Site Information</h3></div>

    <form method="Post" action="siteinfo.php" enctype = "multipart/form-data" id="idForm">
        <div class="form-group row card-body">
            <input type="text" value="" Id="Id" hidden/>
            <div class="col-md-4">
                <labe>Total Tables</label>
                <input type="text" value="<?php echo $totaltables; ?>" Id="totaltables" class="form-control" required/>
            </div>
        </div>
        <div class="form-group card-footer">
            <div class='text-primary' id='msgBox'></div>
            <div class="col-md-12">
                <input type="submit" value="Save Changes" class="btn-sm btn-default form-control btn-success"
                       onclick="event.preventDefault(); PostSiteData(this); " />
            </div>
        </div>
    </form>
</div>


<?php
    include("footer.php");
?>