<?php
session_start();

$date = new DateTime();
$cur =  $date->getTimestamp();
$files = scandir('test/');
foreach($files as $file) {
    if($file == "deletefile.php" || $file == "test_error.php") continue;

    if(file_exists($file)) $create = $cur - filemtime($file);
    if(intval($create) > 2000 && file_exists($file)) unlink("test/".$file);;
}

if(!isset($_POST["code"])) return false;


$disable = ["apache_child_terminate","apache_setenv","define_syslog_variables","escapeshellarg","escapeshellcmd","eval","exec","fp","fput","ftp_connect","ftp_exec","ftp_get","ftp_login","ftp_nb_fput","ftp_put","ftp_raw","ftp_rawlist","highlight_file","ini_alter","ini_get_all","ini_restore","inject_code","mysql_pconnect","openlog","passthru","php_uname","phpAds_remoteInfo","phpAds_XmlRpc","phpAds_xmlrpcDecode","phpAds_xmlrpcEncode","popen","posix_getpwuid","posix_kill","posix_mkfifo","posix_setpgid","posix_setsid","posix_setuid","posix_setuid","posix_uname","proc_close","proc_get_status","proc_nice","proc_open","proc_terminate","shell_exec","syslog","system","xmlrpc_entity_decode","basename","chgrp","chmod","chown","clearstatcache","copy","delete","dirname","disk_free_space","disk_total_space","diskfreespace","fclose","feof","fflush","fgetc","fgetcsv","fgets","fgetss","file_exists","file_get_contents","file_put_contents","file","fileatime","filectime","filegroup","fileinode","filemtime","fileowner","fileperms","filesize","filetype","flock","fnmatch","fopen","fpassthru","fputcsv","fputs","fread","fscanf","fseek","fstat","ftell","ftruncate","fwrite","glob","is_dir","is_executable","is_file","is_link","is_readable","is_uploaded_file","is_writable","is_writeable","lchgrp","lchown","link","linkinfo","lstat","mkdir","move_uploaded_file","parse_ini_file","parse_ini_string","pathinfo","pclose","popen","readfile","readlink","realpath_cache_get","realpath_cache_size","realpath","rename","rewind","rmdir","set_file_buffer","stat","symlink","tempnam","tmpfile","touch","umask","unlink"];


$code = $_POST["code"];

$_SESSION["code"] = $code;
$sur = checkStr($code);
if ( $sur !== 1) $code = "<p>This seem to be a function that was diabled: <b>".$sur."</b></p>";

$written =  $code;
$filename = "test/".session_id()."code.php";
    $ourFileName =$filename;
    $ourFileHandle = fopen($ourFileName, 'w');    
    fwrite($ourFileHandle,$written);
    fclose($ourFileHandle);
echo "1";

function checkStr($phpCode)
{
	$words = array();
	preg_match_all('~\w+(?:-\w+)*~',$phpCode, $words);

	$disable = ["apache_child_terminate","apache_setenv","define_syslog_variables","escapeshellarg","escapeshellcmd","eval","exec","fp","fput","ftp_connect","ftp_exec","ftp_get","ftp_login","ftp_nb_fput","ftp_put","ftp_raw","ftp_rawlist","highlight_file","ini_alter","ini_get_all","ini_restore","inject_code","mysql_pconnect","openlog","passthru","php_uname","phpAds_remoteInfo","phpAds_XmlRpc","phpAds_xmlrpcDecode","phpAds_xmlrpcEncode","popen","posix_getpwuid","posix_kill","posix_mkfifo","posix_setpgid","posix_setsid","posix_setuid","posix_setuid","posix_uname","proc_close","proc_get_status","proc_nice","proc_open","proc_terminate","shell_exec","syslog","system","xmlrpc_entity_decode","basename","chgrp","chmod","chown","clearstatcache","copy","delete","dirname","disk_free_space","disk_total_space","diskfreespace","fclose","feof","fflush","fgetc","fgetcsv","fgets","fgetss","file_exists","file_get_contents","file_put_contents","file","fileatime","filectime","filegroup","fileinode","filemtime","fileowner","fileperms","phpCodeize","filetype","flock","fnmatch","fopen","fpassthru","fputcsv","fputs","fread","fscanf","fseek","fstat","ftell","ftruncate","fwrite","glob","is_dir","is_executable","is_file","is_link","is_readable","is_uploaded_file","is_writable","is_writeable","lchgrp","lchown","link","linkinfo","lstat","mkdir","move_uploaded_file","parse_ini_file","parse_ini_string","pathinfo","pclose","popen","readfile","readlink","realpath_cache_get","realpath_cache_size","realpath","rename","rewind","rmdir","set_file_buffer","stat","symlink","tempnam","tmpfile","touch","umask","unlink","chdir","chroot","closedir","dir","getcwd","opendir","readdir","rewinddir","scandir"];
	$disable = [];
	foreach ($disable as $key => $value) {		
		if(in_array($value,$words[0]) == TRUE) 
		{
			$startPos = stripos($phpCode,$value."(");
			$endPos = stripos(substr($phpCode,$startPos),")");
			if($endPos !== false) 
				{
					return substr($phpCode,$startPos,$endPos+1);
				}
		}
	}
	return 1;
}