<?php


function fbadd($a,$b)
	{		
		$alen = strlen($a);
		$blen = strlen($b);
		if($alen < $blen) 
			{
				$tmp = $a;
				$a = $b;
				$b = $tmp;
			}
		$arrayOfa = [];
		$arrayOfb = [];
		$a = (string)$a;
		$b = (string)$b;
		for($i = 0; $i<$alen; $i++)
		{
			$arrayOfa[] = $a[$i];
			if($i < $alen - $blen) $arrayOfb[] = 0;
			else $arrayOfb[] = $b[$i - ($alen - $blen)];
		}
		$result = '';
		$tmp = 0;
		for ($i=$alen-1; $i >= 0; $i--) {
			$c = ($arrayOfa[$i]+$arrayOfb[$i]+$tmp)%10;
			if($arrayOfa[$i]+$arrayOfb[$i]+$tmp > 9) $tmp = 1;
			else $tmp = 0;
			$result = $c.$result;
		}
		if($tmp > 0) $result = $tmp.$result;;

	return $result;
	}


 function giaithua($a)
 {
	static $gi = [];
	if(isset($gi[$a])) return $gi[$a];	
	if($a == 1) return 1;
	if($a > 1) $res[$a] = bcmul(giaithua($a-1),$a);
	 return $res[$a];
 }
//echo giaithua(10000);

function question2($n,$t = 6)
{  
  static $res = [];
  if(isset($res[$n][$t])) return $res[$n][$t];
  if($t == 0) return 0;
  if($t == 1) return 1;
  $res[$n][$t] = 0;
  $code = intval($n/$t);
  $mod = $n%$t;
  if($t > 1)
  {
    for ($i=0; $i < $code; $i++) {
    $res[$n][$t] += question2($t*$i + $mod, $t - 1);
    }
    $res[$n][$t] += question2($n,$t-1);
  }
  return $res[$n][$t];
}

function fibonacci($n)
{
	$prev2 = 0;
	$prev1= 1;
	$current = 0;
	for ($i=2; $i <= $n; $i++) { 
		$current = bcadd($prev1,$prev2);
		$prev2 = $prev1;
		$prev1 = $current;
	}
	return $current;
}
$end1 = microtime();



$start = microtime();
function fibonacci2($n)
{
	static $res = [];
	if(isset($res[$n])) return $res[$n];
	if($n == 0) return 0;
	if($n == 1) return 1;
	$res[$n] = bcadd(fibonacci2($n-1),fibonacci2($n-2));
	return $res[$n];
}



echo "<br/>";


$start2 = microtime(true);
$a = fibonacci(8181);
$end2 = microtime(true);


echo "<br/>";
echo $end2 - $start2;
echo "<br/>";
echo $a;
