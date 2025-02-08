<?php
    $conn = mysqli_connect("localhost", "root", "", "auxilio");
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }

?>