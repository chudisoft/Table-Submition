<?php	
    echo "<div class='text-center'>";
    echo "<p class='text-danger h3'>You need to login first</p>";
    echo "<a class='btn btn-primary h4' href='../login'>Login Now</a>";
    echo "</p>";
    header("Location: ../login");
    die();
?>