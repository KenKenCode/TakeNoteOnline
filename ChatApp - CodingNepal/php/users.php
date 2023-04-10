<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id']; //basically means, the 'sender' ID
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC"; //displays users who are != to current sender/logged-in ID
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>