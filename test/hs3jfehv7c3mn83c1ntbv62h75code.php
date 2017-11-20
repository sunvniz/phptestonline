<?php
function getShortName($str)
{
	$letters = explode(' ',$str);
 	$shortName = "";
	foreach($letters as $letter)
	{
		$shortName .= substr($letter,0,1);
	}
	return strtoupper($shortName);
} 
function getShort($string) {
	$newStr = '';
	for($i = 0; $i<strlen($string); $i++)
	{
		if((bool)preg_match('/[A-Z]/', $string[$i]))
			$newStr.=$string[$i];
			
	}
    return $newStr;
}
echo getShort('Hoang Van Hieu');