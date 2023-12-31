<?php
if (!isset($_SESSION["Username"])) {
    include('login_form.php');
    return;
}
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<h3>Number Pad</h3>
<input type="text" id="numberInput" class="form-control mb-3" disabled>
<div class="btn-group">
    <button type="button" class="btn btn-outline-primary number-btn">1</button>
    <button type="button" class="btn btn-outline-primary number-btn">2</button>
    <button type="button" class="btn btn-outline-primary number-btn">3</button>
</div>
<div class="btn-group mt-2">
    <button type="button" class="btn btn-outline-primary number-btn">4</button>
    <button type="button" class="btn btn-outline-primary number-btn">5</button>
    <button type="button" class="btn btn-outline-primary number-btn">6</button>
</div>
<div class="btn-group mt-2">
    <button type="button" class="btn btn-outline-primary number-btn">7</button>
    <button type="button" class="btn btn-outline-primary number-btn">8</button>
    <button type="button" class="btn btn-outline-primary number-btn">9</button>
</div>
<div class="btn-group mt-2">
    <button type="button" class="btn btn-outline-primary number-btn">0</button>
    <button type="button" class="btn btn-outline-danger" id="clearBtn">Clear</button>
</div>
<button type="button" class="btn btn-primary mt-3" id="submitBtn"><i id='sendIcon' class="fa fa-paper-plane"></i> Submit</button>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
    $(document).ready(function() {
        <?php
        $totaltables = 0;
        $que12 = $conn->query("SELECT * FROM `sitesettings`");
        while ($r = mysqli_fetch_array($que12)) {
            $Id = $r['Id'];
            $totaltables = $r['totaltables'];
        }
        ?>
        const totalTables = <?php echo $totaltables ?>;
        $("#closeBtn").on("click", function() {
            $('#myToast').toggleClass('show');
        })
        $(".number-btn").on("click", function() {
            var value = $(this).text();
            var currentVal = $("#numberInput").val();
            $("#numberInput").val(currentVal + value);
        });

        $("#clearBtn").on("click", function() {
            $("#numberInput").val('');
        });

        $("#submitBtn").on("click", function() {
            var selectedNumber = $("#numberInput").val();
            //   console.log("Selected Number: " + selectedNumber);

            if (selectedNumber == null || selectedNumber == "") {
                Toastify({
                    text: "Table number must be 1 and above.",
                    duration: 3000,
                    close: true
                }).showToast();
                return;
            }
            if (selectedNumber < 1 || selectedNumber > totalTables) {
                Toastify({
                    text: `Table number must be between 1 and ${totalTables}.`,
                    duration: 3000,
                    close: true
                }).showToast();
                return;
            }
            formData = {
                selectedNumber: selectedNumber,
            };
            $("#submitBtn").disabled = true;
            $("#submitBtn").Title = "Processing....";
            sendIcon.className = 'fa fa-spin fa-spinner';
            $.post('../account/table-record.php', formData,
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
                        $("#numberInput").val('');
                    } else {
                        alert("Unable to post data... Check your network!");
                    }
                    $("#submitBtn").Title = "Submit";
                    sendIcon.className = 'fa fa-paper-plane';
                    $("#submitBtn").disabled = false;
                }
            );
        });
    });
</script>