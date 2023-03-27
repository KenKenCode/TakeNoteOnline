<?php

ini_set('SMTP', "google.com");
ini_set('smtp_port', "25");
ini_set('sendmail_from', "email@google.com");
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("adamwilliam09521@gmail.com","Sample Email From PHP TakeNote Online",$msg);
?>