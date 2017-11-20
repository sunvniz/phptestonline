<?php

$total = 2;
function calc($total)
{
	$wa = 0;
	for($a = 0; $a <= $total/6; $a++)
	for($b = 0; $b <= $total/5; $b++)
	for($c = 0; $c <= $total/4; $c++)
	for($d = 0; $d <= $total/3; $d++)
	for($e = 0; $e <= $total/2; $e++)
	for($f = 0; $f <= $total; $f++)
	{
		if(6*$a+5*$b+4*$c + 3*$d+2*$e+$f == $total) {
			echo "6*$a+5*$b+4*$c + 3*$d+2*$e+$f<br/>";
			$wa += 1;
		}
	}
	return $wa;
}
echo calc(8);