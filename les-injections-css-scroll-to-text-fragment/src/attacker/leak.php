<?php
    require_once('config.php');
    $filename = "text_to_retrieve.txt";

    if(isset($_GET['text'])) {
        file_put_contents($filename, $_GET['text']);
    }
?>