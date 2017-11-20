<?php
if(isset($_POST["session_id"]))
{
	$session_id = $_POST["session_id"];
	unlink($session_id."code.php");
	echo "ok";
}

