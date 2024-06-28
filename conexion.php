<?php

function conectar() {
    $servername = "";
    $username = "root";
    $password = "";
    $dbname = "cafetines_udb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
