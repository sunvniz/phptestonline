<?php
$data = [0, 1, 2, 3,[], [4,5,[6,7,8],9],12];
$result = array();
function getVar($item,&$result)
{	
	if(is_array($item))
	{
		foreach ($item as $val)
		{
			getVar($val,$result);
		}	
	} else $result[] = $item;
	
}
getVar($data,$result);
echo '<pre>';
var_dump($result);
echo '</pre>';