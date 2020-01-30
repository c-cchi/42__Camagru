<?php
    function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = json_encode($output);
    echo "<script>console.debug('Debug Objects: " . $output . "' );</script>";
    }

    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
