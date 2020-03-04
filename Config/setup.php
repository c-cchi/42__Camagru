<?php
    require "database.php";
    try
    {
        $DB = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $sql = file_get_contents('camagru.sql');
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DB->exec("CREATE DATABASE IF NOT EXISTS `$DB_NAME`");
        $DB->query("use $DB_NAME");
        $DB->exec($sql);
        if ($DB)
                echo "Connected to the db";
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }

?>