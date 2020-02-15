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
    confirmed BOOLEAN DEFAULT FALSE,
    fgt_pwd_time TIME (0) NOT NULL DEFALUT NOW()
    )";
if ($con->query($sql) === FALSE)
    echo "Error creating users table: " . $con->error . "\n";

$sql = "CREATE TABLE profiles (
    id_pic INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_user INT(6) UNSIGNED,
    src TEXT DEFAULT NULL,
    status BOOLEAN DEFAULT FALSE
    )";
if ($con->query($sql) === FALSE)    
    echo "Error creating photos table: " . $con->error . "\n";

$sql = "CREATE TABLE photos (
    id_photo INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_user INT(6) UNSIGNED,
    filename TEXT NOT NULL
    )";
if ($con->query($sql) === FALSE)    
    echo "Error creating photos table: " . $con->error . "\n";


$sql = "CREATE TABLE stickers (
    id_sticker INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sticker_name TEXT NOT NULL
    )";
if ($con->query($sql) === FALSE)    
    echo "Error creating photos table: " . $con->error . "\n";
$con->close();
?>