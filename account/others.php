<?php
    include('config.php');
    if(!isset($_SESSION['Username']))
    {
        return;
    }
    if(isset($_GET['action'])){
        $date = date('Y/m/d H:i:s');
        $action = $_GET['action'];
        
        if($action=="Username"){
            echo $_SESSION['Username'];
            return;
        }
        if($action=="Notification"){
            $n = "";

            echo $n;
            return;
        }
    }