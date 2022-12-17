<?php
session_start();
session_unset();
session_destroy();
echo 'session logged out';

header('Location: LogInPage.php');

?>