<?php
include('config.php');
include('me.php');
include("header.php");
if (!isset($_SESSION['Username']) || !isset($_SESSION['Role'])) {
    include("notloggedin.php");
    return;
}
$username = $_SESSION['Username'];
$Role = $_SESSION['Role'];
$search = "";
$msg = "";
$data = array();

$qv = $conn->query("SELECT * FROM `ticket_records` WHERE `Username`='$username'");
if ($_SESSION['Role'] == "Admin") {
    $qv = $conn->query("SELECT * FROM `ticket_records`");
} else {
    $qv = $conn->query("SELECT * FROM `ticket_records` WHERE `Username`='$username'");
}
$tbl = "";
if (mysqli_num_rows($qv) >= 1) {
    $i = 0;
    while ($r = mysqli_fetch_array($qv)) {
        $i++;
        $Restraurant = $r['Restraurant'];
        $Ticket = $r['Ticket'];
        $Date = $r['Date'];
        $Id = $r['Id'];

        $username = $r['Username'];

        $del = '<btn onclick="if(confirm(\'Delete this item?\'))
                    {PostForAlert(\'table-record.php?code=' . $Id . '&action=Delete\', this);}"
                    title="Delete withdrawal" class="btn btn-danger fa fa-trash"></btn>';

        $record = array(
            'Id' => $i,
            'Restraurant' => $Restraurant,
            'Ticket' => $Ticket,
            'Date/Time' => $Date
        );
                    
        if (isset($_GET['SearchField'])) {
            $search = $_GET['SearchField'];
            // $data[] = $r;
            $data[] = $record;
            if (($search == $Email || $search == $username) || $search == "") {
                $tbl .= '<tr>';
                $tbl .= '<td class="text-center">' . $i . '</td>';
                $tbl .= '<td class="text-center">' . $username . '</td>';
                $tbl .= '<td class="text-center">' . $Date . '</td>';
                $tbl .= '<td class="text-center">' . $Ticket . '</td>';
                $tbl .= '<td class="text-center">' . $Restraurant . '</td>';
                if ($_SESSION['Role'] == "Admin") {
                    $tbl .= '<td class="text-center" style="font-size:large">' . $del . '</td>';
                }

                $tbl .= '</tr>';
            }
        } else {
            $data[] = $record;
            $tbl .= '<tr>';
            $tbl .= '<td class="text-center">' . $i . '</td>';
            $tbl .= '<td class="text-center">' . $username . '</td>';
            $tbl .= '<td class="text-center">' . $Date . '</td>';
            $tbl .= '<td class="text-center">' . $Ticket. '</td>';
            $tbl .= '<td class="text-center">' . $Restraurant. '</td>';
            if ($_SESSION['Role'] == "Admin") {
                $tbl .= '<td class="text-center" style="font-size:large">' . $del . '</td>';
            }

            $tbl .= '</tr>';
        }
    }
} else {
    $msg = "Records not found!";
}
// Convert the array to JSON format
$jsonResult = json_encode($data);
?>

<script>
    function downloadExcel() {
        const jsonData = <?php echo $jsonResult?>
        // Convert JSON to CSV format
        const header = Object.keys(jsonData[0]).join(',') + '\n';
        const csv = jsonData.map(row => Object.values(row).join(',')).join('\n');

        // Combine header and CSV data
        const csvData = header + csv;

        // Create a Blob object with CSV data
        const blob = new Blob([csvData], {
            type: 'text/csv'
        });

        // Create a temporary URL for the Blob object
        const url = URL.createObjectURL(blob);

        // Create a link element
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'exported_data.csv');
        document.body.appendChild(link);

        // Trigger the download
        link.click();

        // Clean up
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }

    // Example JSON data (replace this with your actual JSON data)
    const jsonData = [{
            Name: 'John Doe',
            Age: 30,
            Email: 'john@example.com'
        },
        {
            Name: 'Jane Smith',
            Age: 28,
            Email: 'jane@example.com'
        }
    ];

    // Call the download function with your JSON data
    // downloadExcel(jsonData);
</script>

<div class="">
    <p class="text-warning"><?php echo $msg; ?></p>
    <div class="">
        <div class="row m-2">
            <div class="input-group col-md-4">
                <input type="text" id="searchBox" value="<?php echo $search; ?>" placeholder="Search by email/username" class="form-control">
                <span title="Search" onclick="getSearchPage('table-records?SearchField=')" class="input-group-addon btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
            <div class="input-group col-md-4">
            </div>
            <div class="col-md-4 text-right">
                <!-- <a href="table-records-export.php" target="_blank"><i class="fa fa-excel"></i> Export to excel</a> -->
                <button onclick="downloadExcel()" class="btn btn-primary"><i class="fa fa-excel"></i> Export to excel</button>
            </div>
        </div>
    </div>
    <div class=" table-responsive">
        <table class="table mb30 table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center card-header" colspan="8">Record History</th>
                </tr>
                <tr>
                    <th class="text-center">
                        S/N
                    </th>
                    <th class="text-center">
                        Username
                    </th>
                    <th class="text-center">
                        Date
                    </th>
                    <th class="text-center">
                        Ticket
                    </th>
                    <th class="text-center">
                        Restraurant
                    </th>
                    <th class="text-center">
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
</div>