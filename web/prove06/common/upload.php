<?php
function uploadFile($name) {
    chmod("/prove06/images", 0755);
    $imgDirectory = $_SERVER['DOCUMENT_ROOT'].'/prove06/images';

    console_log("IMGDIRECTORY -->");
    console_log($imgDirectory);

    $filename = $_FILES[$name]['name'];

    console_log("FILENAME -->");
    console_log($filename);

    $source = $_FILES[$name]['tmp_name'];

    console_log("SOURCE -->");
    console_log($source);

    $target = $imgDirectory.'/'.$filename;

    console_log("TARGET -->");
    console_log($target);

    $moved = move_uploaded_file($source, $imgDirectory);

    console_log("MOVED -->");
    console_log($moved);

    $files = scandir($imgDirectory);
    console_log(print_r($files));
}

function console_log($data) {
    echo "<script>";
    echo "console.log('".$data."');";
    echo "</script>";
}