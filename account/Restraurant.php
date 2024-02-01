<?php
if (!isset($_SESSION["Username"])) {
    include('notloggedin.php');
    return;
}

if ($_SESSION['Role'] != "Admin") {
    include("notloggedin.php");
    return;
}

if(isset($_POST['name'])){
    $name = validate($conn, $_POST['name']);

    if($username == '' || $name == ''){
        echo 'Invalid request!'; return;
    }else{
        $returnMessage = "";
        $date = date('Y/m/d H:i:s');
        // $Id = GUID(); 
                    
        //Add to the database
        $stmt = $conn->prepare("INSERT INTO `restraurant` (`Name`) values ('$name')");
        // $stmt->bind_param("d", $name);
        $result = $stmt->execute();

        if (!$result) {
            die(__LINE__ . ' Invalid query: ' . mysqli_error($conn));
            return;
        }
        // echo "<p class='text-primary'>Data submited successfully!</p>";
        echo "Data submited successfully!";
        return;
    }
}elseif(isset($_GET['code']) && isset($_GET['action'])){
    $date = date('Y/m/d H:i:s');
    $code = $_GET['code'];
    $action = $_GET['action'];
    
    $qv = $conn->query("SELECT * FROM `restraurant` WHERE `Id`=$code");
    $r = mysqli_fetch_array($qv);
    if(mysqli_num_rows($qv) <= 0){
        echo "Record not found!"; return;
    }
    if($action=="Delete"){
        $stmt = "Delete FROM restraurant Where `Id`=$code";
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
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<h3>Restraurant Name</h3>
<input type="text" id="RestraurantName" class="form-control mb-3">
<button type="button" class="btn btn-primary mt-3" id="submitBtnRestaurant"><i id='sendRestaurantIcon' class="fa fa-paper-plane"></i> Submit</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    $(document).ready(function() {
        $("#closeBtn").on("click", function() {
            $('#myToast').toggleClass('show');
        })
        
        $("#submitBtnRestaurant").on("click", function() {
            var RestraurantName = $("#RestraurantName").val();

            if (RestraurantName == null || RestraurantName == "") {
                Toastify({
                    text: "Restraurant name is required!",
                    duration: 3000,
                    close: true
                }).showToast();
                return;
            }
            
            formData = {
                name: RestraurantName,
            };
            $("#submitBtn").disabled = true;
            $("#submitBtn").Title = "Processing....";
            sendRestaurantIcon.className = 'fa fa-spin fa-spinner';
            $.post('restraurant.php', formData,
                function(data, status) {
                    //alert("Data: " + data + "\nStatus: " + status);
                    if (status == "success") {
                        // msgbox.innerHTML = data;
                        Toastify({
                            text: data,
                            duration: 3000,
                            close: true
                        }).showToast();

                        // $('#myToast').toggleClass('show');
                        $("#RestraurantName").val('');
                    } else {
                        alert("Unable to post data... Check your network!");
                    }
                    $("#submitBtn").Title = "Submit";
                    sendRestaurantIcon.className = 'fa fa-paper-plane';
                    $("#submitBtn").disabled = false;
                }
            );
        });
    });
</script>