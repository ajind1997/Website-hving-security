<form method="get">
<textarea name="text" rows="10" cols="60">
<?php print $_GET['text']; ?>
</textarea>
<input type="submit" name="submit" value="Submit" />
</form>

<?php
if(!empty($_GET['text'])) {
    //print $_GET['text'];
    //print strip_tags($_GET['text'], '<b><i><br><h2>');
    print htmlentities($_GET['text']);
}
?>