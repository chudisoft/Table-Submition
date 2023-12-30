<?php
    include('config.php');
    include('me.php');
    if(!isset($_SESSION['Username']) ||!isset($_SESSION['Role']))
    {
        include("notloggedin.php");
        return;
    }else{
        $username = $_SESSION['Username'];
        $Role = $_SESSION['Role'];
        $TDeposits = 0; $search = ""; $msg = "";

        $i = 0;
        if($_SESSION['Role'] == "Admin"){
                if(isset($_GET['SearchField'])){
                    $search = $_GET['SearchField'];
                }
                $qvRef = $conn->query("SELECT * FROM `users` WHERE (`Username`='$search' Or `Id`='$search' Or `Email`='$search')");
                    $rId = ""; $rEmail = ""; $rUsername = "";
                $rUser = mysqli_fetch_array($qvRef);
                if(mysqli_num_rows($qvRef) >= 1){
                    $rId = $rUser["Id"];
                    $rEmail = $rUser['Email'];
                    $rUsername = $rUser['Username'];
                }
                //echo $rEmail.", ".$search; return;
            $qv1 = $conn->query("SELECT * FROM `users` Where (`Ref`='$rUsername' Or `Ref`='$rEmail' Or `Ref`='$rId')");
        }else{   
            $qv1 = $conn->query("SELECT * FROM `users` Where (`Ref`='$Username' Or `Ref`='$Email' Or `Ref`='$IdNumber')");
        }
        $tbl ="";
        if(mysqli_num_rows($qv1) <= 0){
            $msg = "Referred Users not found!";
        }else{
            $i = 0; $TMaturing = 0;
            while($rRef = mysqli_fetch_array($qv1)){
                $i++;
                $refName = $rRef['Names'];
                $refRef = $rRef['Ref'];
                $refId = $rRef['Id'];
                $refEmail = $rRef['Email'];
                $refUsername = $rRef['Username'];
                if($_SESSION['Role'] == "Admin"){
                    $tbl .= '<tr>';
                    $tbl .= '<td class="text-center">'.$i.'</td>';
                    $tbl .= '<td class="text-center">'.$refId.'</td>';
                    $tbl .= '<td class="text-center">'.$refName.'</td>';
                    $tbl .= '<td class="text-center">'.$refUsername.'</td>';
                    $tbl .= '<td class="text-center">'.$refEmail.'</td>';
                
                    $tbl .= '</tr>';
                }elseif(isset($_GET['SearchField'])){
                    $search = $_GET['SearchField'];
                    if($search == $email || $search == $Id){
                        $tbl .= '<tr>';
                        $tbl .= '<td class="text-center">'.$i.'</td>';
                        $tbl .= '<td class="text-center">'.$refId.'</td>';
                    
                        $tbl .= '</tr>';
                    }
                }else{
                        $tbl .= '<tr>';
                        $tbl .= '<td class="text-center">'.$i.'</td>';
                        $tbl .= '<td class="text-center">'.$refId.'</td>';
                        
                        $tbl .= '</tr>';
                } 
            }
        }
    }
    include("header.php");
?>

    <div class="container">
        <p class="text-warning"><?php echo $msg;?></p>
        <div class="row m-2">
            <div class="input-group col-md-4">
                <input type="text" id="searchBox" value="<?php echo $search; ?>" placeholder="Search by email/username" class="form-control">
                <span title="Search" onclick="getSearchPage('referals?SearchField=')" class="input-group-addon btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table mb30 table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center card-header" 
                            colspan="5">My Referred Users</th>
                    </tr>
                    <tr>
                        <th class="text-center">
                            S/N
                        </th>
                        <th class="text-center">
                            Id
                        </th>
                        <?php 
                            if($_SESSION['Role'] == "Admin")
                            echo '
                                <th class="text-center">
                                    Names
                                </th>
                                <th class="text-center">
                                    Username
                                </th>  
                                <th class="text-center">
                                    Email
                                </th>          
                            ';
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                         echo $tbl;                              
                    ?>              
                </tbody>
            </table>
        </div>
        </div>
    </div>

    
<?php
    include("footer.php");
?>