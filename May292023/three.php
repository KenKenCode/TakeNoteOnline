<?php

if (isset($_POST["ajax_action"])) {
    $ajax_action = $_POST["ajax_action"];

    switch ($ajax_action) {
        case "action1":
            // Code to handle AJAX action 1
            echo "Performing action 1";
            break;
            
        case "action2":
            // Code to handle AJAX action 2
            echo "Performing action 2";
            break;
            
        case "action3":
            // Code to handle AJAX action 3
            echo "Performing action 3";
            break;
            
        default:
            // Default case if none of the cases match
            echo "Unknown action";
            break;
    }
}


?>


