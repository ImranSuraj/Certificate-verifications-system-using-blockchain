<?php
# blockchaincertificate.lovestoblog.com
$con = mysqli_connect("localhost","root","","user_db");
if (mysqli_connect_error()) {
    echo"<script>alert('Database not connected');</script>";
    exit();
}

?>