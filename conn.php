<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "gio_pizza";

    $conn = mysqli_connect($server, $user, $pass, $dbname);
    if(!$conn) {
        die("connection failer:" . mysqli_connect_error());
    }

?>