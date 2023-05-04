<?php
include_once 'submit.php';
include_once 'dbConfig.php';

$noteSelect = mysqli_query($db, "SELECT * FROM editor WHERE id = 1;");
?>
<!DOCTYPE html>
<html>
<head>

<script src="../TinyMCE/tinymce/js/tinymce/tinymce.min.js"></script>
</head>
<body>

<div class="container">

<div class="ed-frm">

<h2>Insert Editor Content in Database</h2>


<?php if(!empty($statusMsg)) { ?>
<p class="stmsg"><?php echo $statusMsg; ?> </p>
<?php } ?>


<form method="post" action="submit.php">
    <textarea name="editor" id="editor" rows="10" cols="80">
    This is my textarea to be replaced with HTML editor.
    </textarea>
    <input type="submit" name="submit" value="SUBMIT">
</form>

</div>

<!--
<?php if(!empty($editorContent)){ ?>

<div class="ed-cont">
<h4>Inserted Content</h4>
<?php echo $editorContent; ?>

</div>

<?php } ?>
-->

<?php
//Remember to use while loop when querying multiple rows/columns
while($row = mysqli_fetch_assoc($noteSelect)) {
    echo "<textarea>" . $row['content'] . "</textarea>";
	echo "<p>" . $row['content'] . "</p>";
}
?>
</div>
<script>
tinymce.init({
    selector: '#editor',
	width: 500
});
</script>

</body>
</html>