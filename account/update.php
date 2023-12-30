<?php
	include('config.php');
	include('me.php');
    if(!isset($_SESSION['Username']))
    {
        include("notloggedin.php");
        return;
    }
	$username = $_SESSION['Username'];
	if(isset($_POST['Names']) && isset($_POST['Address']) && 
        isset($_POST['Phone'])){
		$name = validate($conn, $_POST['Names']);
        $Address = validate($conn, $_POST['Address']);
        $Phone = validate($conn, $_POST['Phone']);

    	$qv = $conn->query("SELECT * FROM `users` WHERE `Username`='$username'");
    		
    	if(mysqli_num_rows($qv) >= 1){
    		$sql = "Update `users` set `Names` = '$name', `Address` = '$Address', 
                    `Phone` = '$Phone' 
                 Where `Username`='$username'";
    		
            if ($conn->query($sql) === TRUE) {
                echo 'Updated Successfully!'; return;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
    	}
    }
    else {
        //echo "Required data is missing";
    	$qv = $conn->query("SELECT * FROM `users` WHERE `Username`='$username'");
    	if(mysqli_num_rows($qv) >= 1){
            $r = mysqli_fetch_array($qv);
		    $name = $r['Names'];
            $Address = $r['Address'];
            $Phone = $r['Phone'];
        }
    }
       
    include("header.php");
?>

<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-5 d-md-block m-md-auto">
                <div class="login-box bg-white box-shadow border-radius-10 border border-success shadow">
                    <div class="card-header">
                        <h4 class="text-center text-primary">Update Your Account Details</h4>
                    </div>
                    <form action="update.php" method="post" id="idForm">
                        <label>Your Names</label>
                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg"
                                    placeholder="Your Names" id="Names" required
                                    value="<?php echo $name ?>">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>
                        </div>
                        <label>Phone</label>
                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg" placeholder="Phone" id="Phone" required
                                    value="<?php echo $Phone ?>">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-phone-call"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom" hidden>
                            <input type="date" class="form-control form-control-lg" placeholder="DOB" id="DOB">
                        </div>
                        <label>Country</label>
                        <div class="input-group custom">
                            <input disabled type="text" class="form-control form-control-lg" placeholder="Address" id="Address" value="<?php echo $Address ?>">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-home"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom" hidden>
                            <input type="file" class="form-control form-control-lg" placeholder="PassPort" id="PassPort" required>
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-attachment"></i></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class='text-primary' id='msgBox'></div>
                                <div class="input-group mb-0">
                                    <a class="btn btn-outline-primary btn-lg btn-block" href="#Submit"
                                        onclick="event.preventDefault(); UpdateProfile(this); ">Update Account</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    include("footer.php");
?>