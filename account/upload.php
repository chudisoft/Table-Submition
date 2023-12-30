<?php
    include('config.php');
    include('me.php');
    if(!isset($_SESSION['Username']))
    {
        include("notloggedin.php");
        return;
    }
	$username = $_SESSION['Username'];
    $qv = $conn->query("SELECT * FROM `users` WHERE `Username`='$username'");
    $r = mysqli_fetch_array($qv);
    $active = $r['Active'];
    $e = $r['Email'];
    if(mysqli_num_rows($qv) >= 1){
        if(isset($_GET['code']) && isset($_GET['action'])){
            $date = date('Y/m/d H:i:s');
            $code = $_GET['code'];
            $action = $_GET['action'];
        }
        else if(isset($_POST['fileToUpload']) && isset($_POST['action']) && isset($_POST['code'])){
            $date = date('Y/m/d H:i:s');
            $code = $_GET['code'];
            $action = $_GET['action'];
        
            if($action=="Deposit"){  
                $qv = $conn->query("SELECT * FROM `deposits` WHERE `Id`=$code");
                $r = mysqli_fetch_array($qv);
                if(mysqli_num_rows($qv) <= 0){
                    echo "Deposit not found!"; return;
                }

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                  if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . "."; return;
                    $uploadOk = 1;
                  } else {
                    echo "File is not an image.";
                    $uploadOk = 0; return;
                  }
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                  echo "Sorry, file already exists."; return;
                  $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                  echo "Sorry, your file is too large."; return;
                  $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; return;
                  $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  echo "Sorry, your file was not uploaded."; return;
                // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                  } else {
                    echo "Sorry, there was an error uploading your file."; return;
                  }
                }        
                $stmt = "Update Deposits Set `ImageSet` = 1, `Image Upload Time` = '$date'";
                if ($conn->query($stmt) === TRUE) {
                } else {
                    die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                    return;
                }
                return;
		    }
            if($action=="User"){  
                $qv = $conn->query("SELECT * FROM `users` WHERE `Id`=$code");
                $r = mysqli_fetch_array($qv);
                if(mysqli_num_rows($qv) <= 0){
                    echo "User not found!"; return;
                }

                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                  if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . "."; return;
                    $uploadOk = 1;
                  } else {
                    echo "File is not an image.";
                    $uploadOk = 0; return;
                  }
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                  echo "Sorry, file already exists."; return;
                  $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                  echo "Sorry, your file is too large."; return;
                  $uploadOk = 0;
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed."; return;
                  $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                  echo "Sorry, your file was not uploaded."; return;
                // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                  } else {
                    echo "Sorry, there was an error uploading your file."; return;
                  }
                }        
                $stmt = "Update Users Set `ImageSet` = 1, `Image Upload Time` = '$date'";
                if ($conn->query($stmt) === TRUE) {
                } else {
                    die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
                    return;
                }
                return;
		    }
        }else{
            echo '<p class="text-danger"> At least one file is required!</p>';
        }
    }else{
        echo 'User not found!';
        return;                
    }
    include("header.php");
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="text" id="action" name"action" hidden>
  <input type="text" id="code" name"code" hidden>
  <input type="submit" class="form-control-sm btn btn-sm btn-defualt" value="Upload Image" name="submit">
</form>

<?php
    include("footer.php");
?>