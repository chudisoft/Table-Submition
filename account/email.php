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
    $Id = "";
                
    if(isset($_POST['Reciever']) && isset($_POST['Title']) && isset($_POST['Body'])){		
		$Reciever = $_POST['Reciever'];
        $Title = $_POST['Title'];
        $Body = $_POST['Body'];

        if($Reciever == '' || $Title == '' || $Body == ''){
            echo '<p class="text-danger">Reciever, Title and Body are required!</p>';
        }else{
            mail($Reciever,$Title,$Body,$headers);
            echo "<p class='text-success'>Email was sent successfully.</p>";
            return;                   
        }
    }
    if(isset($_POST['Names']) && isset($_POST['Email']) && isset($_POST['Body'])){		
		$Sender = $_POST['Names'];
        $Email = $_POST['Email'];
        $Body = $_POST['Body'];

        if($Sender == '' || $Email == '' || $Body == ''){
            echo '<p class="text-danger">Names, Email and Body are required!</p>';
        }else{
            //$headers = 'From: Daily FX Plan, U.S <' . $SiteEmail . '>';
            //$headers .="CC: " . $Email. "";
            $nBody = "Support mail from: " . $Sender . " (" . $Email . ") <br> <br>" . $Body;
            //mail(to,subject,message,headers,parameters);
            mail($SiteEmail,"Support mail from: " . $Sender,$nBody,$headers);
            mail($Email,"Repy - Support Email","Hi " . $Sender . 
                ",<br/> We recieved your support mail and we will get back to you shortly: <br/><br/>Ref:<br/>" .
                $Body,$headers);
            echo "<p class='text-success'>Email was sent successfully.</p>";
            return;                   
        }
    }if(isset($_GET['Reciever'])){		
		$Id = $_GET['Reciever'];
    }else{
    }
    include("header.php");
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Site favicon -->
    <link rel="icon" type="image/png" href="../images/logo.png">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<div class="card flex-wrap justify-content-center">
    <div class="container">
        <?php
            echo '<p class="text-danger">Reciever, Title and Body are required!</p>'; 
            ?>
        <div class="row align-items-center">
            <div class="col-md-10 col-lg-8 d-md-block m-md-auto">
                <div class="p-0 col-md-8 bg-white box-shadow border-radius-10 border border-success shadow">
                    <div class="card-header m-0">
                        <h4 class="text-center text-primary">
                            Send Email to : <?php echo $Id; ?>
                        </h4>
                    </div>
                    <form action="email.php" method="post" id="idForm" style="padding:1em">
                        <label class="h6 font-weight-bold">Reciever</label>
                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg"
                                    placeholder="Reciever's email address" id="Reciever" 
                                    value="<?php echo $Id; ?>">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-at"></i></span>
                            </div>
                        </div>
                        <label class="h6 font-weight-bold">Title</label>
                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg"
                                    placeholder="Email Title" id="Title" >
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-header"></i></span>
                            </div>
                        </div>
                        <label class="h6 font-weight-bold">Body</label>
                        <div id="editor" style="min-height:10em">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <div class='text-danger' id='msg'>
                                    </div>
                                        <a class='btn btn-success btn-lg btn-block text-light border-primary fa fa-send' 
                                            onclick='PostEmail(this);' id='btn'> Send Email</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
	var quill = new Quill('#editor', {
	theme: 'snow'
	});
    const editor = $('.editor');

    //const quill = new Quill(editor);

    // set html content
    quill.setHTML = (html) => {
      editor.root.innerHTML = html;
    };

    // get html content
    quill.getHTML = () => { return quill.root.innerHTML; };

    // usages
    //quill.setHTML('<b>Hello my friend</b>');

    quill.on('text-change', () => {
        //console.log('get html', quill.getHTML());
    });
	function PostEmail(){
        var form = $("#idForm");
        var url = form.attr('action');

        if (Reciever.value == null || Title.value == null ||
            Reciever.value == "" || Title.value == "" || quill.getHTML() == ""){
            alert("Reciever, Title and Body are required!");
            return;
        }
        formData = {
            Reciever: Reciever.value,
            Title: Title.value,
            Body : quill.getHTML()
        };
        
        btn.disabled = true;
        msg.innerHTML = "Sending....";
        $.post("email.php", formData,
            function (data, status) {
                //alert("Data: " + data + "\nStatus: " + status);
                if (status == "success") {
                    msg.innerHTML = data;
                } else {
                    alert("Unable to post data... Check your network!");
                }
                //document.getElementById("bodyContent").innerHTML = data;
                //alert(data);
                btn.Title = "Ready";
                btn.disabled = false;
            }
        );
	}
</script>


<?php
    include("footer.php");
?>