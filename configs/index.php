<?php
    /* MySQLi Procedural */
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "YOUR_DB";

    // Create connection
    $link = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>