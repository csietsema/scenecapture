<?
	unlink($_GET['file']);
	header('Location: list-scenes.php?userId=' . $_GET['userId']);
?>