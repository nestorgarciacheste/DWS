<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = $_GET["name"];
    $age = $_GET["age"];
    $sex = $_GET["sex[]"];
    $status = $_GET["status[]"];
    $weight = $_GET["weight"];

    echo "<p>$name</p>";
    echo "<p>$age</p>";
    echo "<p>$sex</p>";
    echo "<p>$status</p>";
    echo "<p>$weight</p>";
} else {
    echo "<p>Error: No se han recibido los datos del formulario correctamente.</p>";
}
