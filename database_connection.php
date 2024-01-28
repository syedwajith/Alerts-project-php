<?php
function db_connection(){
    $server_name = "127.0.0.1";
    $user_name = "root";
    $password = "";
    $database = "alerts";

    global $connection;
    $connection = mysqli_connect($server_name, $user_name, $password, $database);

    if ($connection -> connect_error) {
        die ("<h3> Connection Failed : " . mysqli_connect_error() . "</h3>");
    }
}

db_connection()

?>