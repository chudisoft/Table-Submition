<?php
include('config.php');
// Set headers to define the file as an Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="table_report.xlsx"');
header('Cache-Control: max-age=0');
include('me.php');
if (!isset($_SESSION['Username']) || !isset($_SESSION['Role'])) {
    include("notloggedin.php");
    return;
}
$username = $_SESSION['Username'];
$Role = $_SESSION['Role'];
$search = "";
$msg = "";

$qv = $conn->query("SELECT * FROM `table_records` WHERE `Username`='$username'");
if ($_SESSION['Role'] == "Admin") {
    $qv = $conn->query("SELECT * FROM `table_records`");
} else {
    $qv = $conn->query("SELECT * FROM `table_records` WHERE `Username`='$username'");
}
$tbl = "";
if (mysqli_num_rows($qv) >= 1) {

    // Start creating the Excel file content
    $excelData = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $excelData .= '<ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'; // Excel 2003 schema
    $excelData .= '<ss:Worksheet ss:Name="Sheet1">';
    $excelData .= '<ss:Table>';

    // Your data to be written to Excel
    // $data = array(
    //     array('Name', 'Age', 'Email'),
    //     array('John Doe', 30, 'john@example.com'),
    //     array('Jane Smith', 28, 'jane@example.com'),
    // );

    // foreach ($data as $row) {
        $excelData .= '<ss:Row>';
        // foreach ($row as $cell) {
            // $excelData .= '<ss:Cell><ss:Data ss:Type="String">' . htmlspecialchars($cell) . '</ss:Data></ss:Cell>';
        // }
    // }


    $excelData .= '<ss:Cell><ss:Data ss:Type="String">Id</ss:Data></ss:Cell>';
    $excelData .= '<ss:Cell><ss:Data ss:Type="String">Date</ss:Data></ss:Cell>';
    $excelData .= '<ss:Cell><ss:Data ss:Type="String">Table</ss:Data></ss:Cell>';
    $i = 0;
    while ($r = mysqli_fetch_array($qv)) {
        $i++;
        $Table = $r['Table'];
        $Date = $r['Date'];
        $Id = $r['Id'];

        $username = $r['Username'];
        
        $excelData .= '<ss:Cell><ss:Data ss:Type="String">' . $i . '</ss:Data></ss:Cell>';
        $excelData .= '<ss:Cell><ss:Data ss:Type="String">' . $Date . '</ss:Data></ss:Cell>';
        $excelData .= '<ss:Cell><ss:Data ss:Type="String">' . $Table . '</ss:Data></ss:Cell>';
    }
        $excelData .= '</ss:Row>';
    // Close the XML tags
    $excelData .= '</ss:Table>';
    $excelData .= '</ss:Worksheet>';
    $excelData .= '</ss:Workbook>';

    // Output the generated Excel content
    echo $excelData;
} else {
    $msg = "Records not found!";
}
