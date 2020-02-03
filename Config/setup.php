<?php
$con = new mysqli("localhost", "root", "123456");
if ($con->connect_error)
    die("Connection failed: " . $con->connect_error . "\n");

$sql = "CREATE DATABASE camagrue";
if ($con->query($sql) === FALSE)
    echo "Error creating database: " . $con->error . "\n";

if ($con->query("USE camagrue") === FALSE)
    echo "Error using database: " . $con->error . "\n";

$sql = "CREATE TABLE users (
    no INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(100) NOT NULL,
    password VARCHAR(400) NOT NULL,
    email VARCHAR(100) NOT NULL,
    verify_id TEXT NOT NULL,
    confirmed BOOLEAN DEFAULT FALSE
    )";
if ($con->query($sql) === FALSE)
    echo "Error creating users table: " . $con->error . "\n";

$sql = "CREATE TABLE profiles (
    id_pic INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_user INT(6) UNSIGNED,
    src TEXT NOT NULL,
    status BOOLEAN DEFAULT FALSE
    )";
if ($con->query($sql) === FALSE)    
    echo "Error creating photos table: " . $con->error . "\n";

$con->close();
?>