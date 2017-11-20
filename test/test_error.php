<?php
session_start();
error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
ini_set("display_errors", 1);
include(session_id()."code.php");

?>