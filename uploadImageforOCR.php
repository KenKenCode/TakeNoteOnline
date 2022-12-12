<?php
if(isset($_FILES['image'])){ //'image' is the name of input=file in ExtrasPage.html, so if user clicks it, the code in this if-statement will run. 

$file_name = $_FILES['image']['name'];
$file_tmp =$_FILES['image']['tmp_name'];
move_uploaded_file($file_tmp,"images/".$file_name);
echo "<h3>Image Upload Success</h3>";
echo '<img src="images/'.$file_name.'" style="width:100%">';
echo "'$file_tmp'";


shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\xampp\\htdocs\\TakeNote Online\\OCRImages\\'.$file_name.'" out');

echo "<br><h3>OCR after reading</h3><br><pre>";

$myfile = fopen("out.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("out.txt"));
fclose($myfile);
echo "</pre>";
}

//PHP is server-side so storing of images from a client's computer might not work. 
//Just try deleting the /OCRImages/ folder after the signout of the user to prevent security issues.

?>