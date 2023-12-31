</div>
</div>
</div>

<!-- js -->
<script src="../asset/js/jquery.js"></script>
<script src="../DBoard/vendors/scripts/core.js"></script>
<script src="../DBoard/vendors/scripts/script.min.js"></script>
<script src="../DBoard/vendors/scripts/process.js"></script>
<script type="text/javascript">
    var p = "<div id='preloader' class='' style=' width:100%; background: #fff !important; z-index:10'>" +
        "<div class='spinner-grow' style='width: 3rem; height: 3rem; ' role='status'></div>" +
        "<div class=' h4 col-md-12' style='padding-top:1em'>Loading Page Data... </div>" +
        "<div class=' h6 col-md-12'> Please wait....<span class='fa fa-spinner fa-spin'></span></div>" +
        "</div>";

    $(document).ready(function() {
        var chk = document.getElementById("msgNotArea");
        var np = document.getElementById("msgNotAreaP");
        np.innerHTML = p;
        $.post("/account/notification.php", {},
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {

                } else {
                    alert("Unable to fetch notification data... Check your network!");
                }
                //np.innerText = data;
                if (data == "<div class=\"text-primary\">All clear!</div>" || data == null || data == undefined) {
                    //alert("1");
                    chk.className = "icon-copy dw dw-notification-11";
                } else {
                    chk.className = "icon-copy dw dw-notification";
                }
                np.innerHTML = data;
            });
    });

    function deleteNotification() {
        $.post("/account/notification.php", {
                Read: true
            },
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
            });
    }

    function showHideFilter(obj) {
        var el = document.getElementById("filterSection");
        if (el.style.display == "none") {
            el.style.display = "block";
            obj.innerText = "Hide Filter";
        } else {
            el.style.display = "none";
            obj.innerText = "Show Filter";
        }
    }

    function DisplayPlanMsg() {
        //alert(SPlan.value);
        var el = document.getElementById("Plan " + SPlan.value);
        planMessage.innerHTML = el.innerHTML;
    }

    function getSearchPage(url) {
        var el = document.getElementById("searchBox").value;
        //alert(url + el);
        document.location = url + el;
    }

    function PostData(btn) {

        var form = $("#idForm");
        var url = form.attr('action');
        btn.disabled = true;
        btn.Title = "Processing....";
        $.post(url, form.serialize(),
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {

                } else {
                    alert("Unable to post data... Check your network!");
                }
                //document.getElementById("bodyContent").innerHTML = data;
                alert(data);
                btn.Title = "Ready";
                btn.disabled = false;
            });
    }

    function PostSiteData(btn) {
        var totaltables = document.getElementById("totaltables");
        //alert(name);
        if (totaltables.value == null || totaltables.value <= 0) {
            alert("All values are required!!");
            return;
        }

        var form = $("#idForm");
        var url = form.attr('action');
        btn.disabled = true;
        btn.Title = "Processing....";
        formData = {
            totaltables: totaltables.value,
            Id: Id.value
        };
        $.post(url, formData,
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {

                } else {
                    alert("Unable to post data... Check your network!");
                }
                //document.getElementById("bodyContent").innerHTML = data;
                msgBox.innerHTML = data;
                //alert(data);
                btn.Title = "Ready";
                btn.disabled = false;
            });
    }

    function UpdateProfile(btn) {

        var form = $("#idForm");
        var url = form.attr('action');

        if (Names.value == null || Names.value == "" ||
            Address.value == null || Address.value == "" ||
            Phone.value == null || Phone.value == ""
        ) {
            alert("Names, Address and Phone are required!");
            return;
        }
        var formData = {
            Names: Names.value,
            Address: Address.value,
            Phone: Phone.value,
        };
        btn.disabled = true;
        btn.value = "Processing....";
        msgBox.innerHTML = p;
        $.post(url, formData,
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {
                    msgBox.innerHTML = data;
                } else {
                    alert("Unable to post data... Check your network!");
                }
                //document.getElementById("bodyContent").innerHTML = data;
                //alert(data);
                //btn.Title = "Ready";
                btn.hidden = true;
            });
    }

    function PostUBData(btn) {

        var form = $("#idForm");
        //var iconBnt = $("#iconBnt");
        var oldClassName = iconBnt.className;
        var url = form.attr('action');
        if (username.value == null || username.value == "" ||
            pType.value == null || pType.value == "" ||
            Amount.value == null || Amount.value == ""
        ) {
            alert("All values are required!");
            return;
        }
        var formData = {
            code: username.value,
            pType: pType.value,
            Amount: Amount.value,
            notifyUser: notifyUser.checked
        };
        btn.disabled = true;
        btn.innerHtml = "<i class='fa fa-spinner fa-spin mr-2' id='iconBnt'></i>Processing....";
        //iconBnt.className = "fa fa-spinner fa-spin";
        msgBox.innerHTML = p;
        $.post(url, formData,
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {
                    msgBox.innerHTML = data;
                } else {
                    alert("Unable to post data... Check your network!");
                }
                //document.getElementById("bodyContent").innerHTML = data;
                //alert(data);
                //btn.Title = "Ready";
                //btn.hidden = true;
                //iconBnt.className = oldClassName;
                btn.innerHtml = "<i class='fa fa-send mr-2' id='iconBnt'></i>Save Changes";
            });
    }

    function PostForAlert(url, btn) {
        var oldClass = btn.className;
        btn.disabled = true;
        btn.className = "fa fa-spinner fa-spin";
        $.post(url, [],
            function(data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {
                    alert(data);
                    btn.className = oldClass;
                    //btn.Title = "Ready";
                    btn.parentElement.parentElement.hidden = true;
                } else {
                    alert("Unable to post data... Check your network!");
                }
                //document.getElementById("bodyContent").innerHTML = data;
            });
    }
</script>
</body>

</html>