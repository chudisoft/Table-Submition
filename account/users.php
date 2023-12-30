<?php
include('config.php');
include('me.php');
if (!isset($_SESSION['Username']) || !isset($_SESSION['Role'])) {
    include("notloggedin.php");
    return;
}
$username = $_SESSION['Username'];
$Role = $_SESSION['Role'];
$TDeposits = 0;
$search = "";

if ($_SESSION['Role'] == "Admin") {
    $qv = $conn->query("SELECT * FROM `users`"); // WHERE `Username`='$username'");
    $r = mysqli_fetch_array($qv);
    $tbl = "";
    if (mysqli_num_rows($qv) >= 1) {
        $stmt = $conn->query("Select * FROM users ORDER BY `CDate` DESC");
        $i = 0;
        while ($r = mysqli_fetch_array($stmt)) {
            $i++;
            $name = $r['Names'];
            $email = $r['Email'];
            $active = $r['Active'];
            $status = $r['Status'];
            $country = $r['Address'];
            $password = $r['Password'];
            $phone = $r['Phone'];
            //$plain = $r['plain'];
            //$code = $r['hash_p'];
            $Ref = $r['Ref'];
            $Id = $r['Username'];

            $sm = '<a href="email?Reciever=' . $email . '"
                    title="Email User" class="btn btn-primary fa fa-envelope">
                    </a>';
            $del = '<btn onclick="if(confirm(\'Delete this item?\'))
                    {PostForAlert(\'user.php?code=' . $Id . '&action=Delete\', this);}"
                    title="Delete User" class="btn btn-danger fa fa-trash"></btn>';
            $pn = "";
            $cn = "";

            if ($active == '0') {
                $pn = '<btn onclick="if(confirm(\'Approve this user?\'))
                        {PostForAlert(\'user.php?code=' . $Id . '&action=Approve\', this);}" 
                            title="Approve User" class="btn btn-primary fa fa-check-square-o"></btn>';
                $s = '<span class="text-primary" style="">Not Active</span>';
            } elseif ($active == '1') {
                $cn = '<btn onclick="if(confirm(\'Disapprove this user?\'))
                        {PostForAlert(\'user.php?code=' . $Id . '&action=Deapprove\', this);}" 
                            title="Disapprove User" class="btn btn-warning fa fa-close"></btn>';
                $s = '<span style="color: #228B22;">Active</span>';
            } else {
                $s = '<span style="color: #b22222;">Not Approved</span>';
            }
            if ($status == '0') {
                $s1 = '<span class="text-primary" style="">Not Approved</span>';
            } elseif ($status == '1') {
                $s1 = '<span style="color: #228B22;">Approved</span>';
            } else {
                $s1 = '<span style="color: #b22222;">Not Approved</span>';
            }
            if (isset($_GET['SearchField'])) {
                $search = $_GET['SearchField'];
                if ($search == $email || $search == $Id) {
                    $tbl .= '<tr>';
                    $tbl .= '<td class="text-center">' . $i . '</td>';
                    $tbl .= '<td class="text-center">' . $name . '</td>';
                    $tbl .= '<td class="text-center">' . $Id . '</td>';
                    $tbl .= '<td class="text-center">' . $email . '</td>';
                    $tbl .= '<td class="text-center">' . $country . '</td>';
                    //$tbl .= '<td class="text-center">'.$password.'</td>';
                    // $tbl .= '<td class="text-center">'.$Ref.'</td>';
                    $tbl .= '<td class="text-center">' . $s . '</td>';
                    $tbl .= '<td class="text-center">' . $phone . '</td>';
                    if ($_SESSION['Role'] == "Admin") {
                        $tbl .= '<td class="text-center" 
                            style="font-size:large; border-right:unset; border-left:unset">' . $sm . '</td>';
                        $tbl .= '<td class="text-center" 
                            style="font-size:large; border-right:unset; border-left:unset">' . $pn . '</td>';
                        $tbl .= '<td class="text-center" 
                            style="font-size:large; border-right:unset; border-left:unset">' . $cn . '</td>';
                        $tbl .= '<td class="text-center" 
                            style="font-size:large; border-left:unset">' . $del . '</td>';
                    }

                    $tbl .= '</tr>';
                }
            } else {
                $tbl .= '<tr>';
                $tbl .= '<td class="text-center">' . $i . '</td>';
                $tbl .= '<td class="text-center">' . $name . '</td>';
                $tbl .= '<td class="text-center">' . $Id . '</td>';
                $tbl .= '<td class="text-center">' . $email . '</td>';
                $tbl .= '<td class="text-center">' . $country . '</td>';
                //$tbl .= '<td class="text-center">'.$password.'</td>';
                $tbl .= '<td class="text-center">' . $Ref . '</td>';
                $tbl .= '<td class="text-center">' . $s . '</td>';
                $tbl .= '<td class="text-center">' . $phone . '</td>';
                if ($_SESSION['Role'] == "Admin") {
                    $tbl .= '<td class="text-center" 
                            style="font-size:large; border-right:unset; border-left:unset">' . $sm . '</td>';
                    $tbl .= '<td class="text-center" 
                            style="font-size:large; border-right:unset; border-left:unset">' . $pn . '</td>';
                    $tbl .= '<td class="text-center" 
                            style="font-size:large; border-right:unset; border-left:unset">' . $cn . '</td>';
                    $tbl .= '<td class="text-center" 
                            style="font-size:large; border-left:unset">' . $del . '</td>';
                }

                $tbl .= '</tr>';
            }
        }
    } else {
        echo '
                <div class="row m-4">
                    <div class="input-group  col-md-4">
                        <input type="text" id="searchBox" value="' . $search . '" placeholder="Search by email/username" class="form-control">
                        <span title="Search" onclick="getSearchPage(\'users?SearchField=\')" class="input-group-addon btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </div>
                </div>
            ';
        echo 'User not found!';
        return;
    }
} else {
    include("notloggedin.php");
    return;
}
include("header.php");
?>
<div class="row m-2">
    <div class="input-group col-md-4">
        <input type="text" id="searchBox" value="<?php echo $search; ?>" placeholder="Search by email/username" class="form-control">
        <span title="Search" onclick="getSearchPage('users?SearchField=')" class="input-group-addon btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></span>
    </div>
</div>
<div class=" table-responsive">
    <table class="table table-bordered table-hover" style="overflow:scroll; max-height:30em; max-width:95%">
        <thead>
            <tr>
                <th class="text-center card-header" colspan="15">Users</th>
            </tr>
            <tr>
                <th class="text-center">
                    S/N
                </th>
                <th class="text-center">
                    Names
                </th>
                <th class="text-center">
                    Username
                </th>
                <th class="text-center">
                    Email
                </th>
                <th class="text-center">
                    Country
                </th>
                <!-- <th class="text-center">
                    Referee
                </th> -->
                <th class="text-center">
                    Status
                </th>
                <th class="text-center">
                    Phone
                </th>
                <th class="text-center" colspan="5">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo $tbl;
            ?>
        </tbody>
    </table>
</div>
<?php
include("footer.php");
?>