<?php
function uploadFile($name) {
    chmod("/prove06/images", 0755);
    $imgDirectory = $_SERVER['DOCUMENT_ROOT'].'/prove06/images';
    $filename = $_FILES[$name]['name'];

    $source = $_FILES[$name]['tmp_name'];
    $target = $imgDirectory.'/'.$filename;
    move_uploaded_file($source, $target);
}

function console_log($data) {
    echo "<script>";
    echo "console.log('".$data."');";
    echo "</script>";
}