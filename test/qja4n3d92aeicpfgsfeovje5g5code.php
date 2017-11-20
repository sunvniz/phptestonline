
data = $data;
$this->left = null;
$this->right = null;
}
function insertByData($node,$data,$pos)
{
if(!$node) return;
if($this->data == $data) {
if($pos == 1) $this->left = new Node($node);
else $this->right = new Node($node);
return 1;
}
else
{
if($this->left) $this->left->insertByData($node,$data,$pos);
if($this->right) $this->right->insertByData($node,$data,$pos);
}
}
function __tostring()
{
	$left = "";
	$right = "";
	$child = "";
	if($this->left) $left = "";
	if($this->right) $left = "";
	if($left || $right) $child = "";
		return "".$child;
}
}
function showNode(Node $tree,&$data,$i)
{
$data[$i][] = $tree->data;
if($tree->left)
{
$temp = showNode($tree->left,$data,$i+1);
if($temp) $data[$i+1][] = $temp;
}
if($tree->right)

{
$temp = showNode($tree->right,$data,$i+1);
if($temp) $data[$i+1][] = $temp;
}
if(!$tree->left&&!$tree->right) return false;
}

function question3($str)
{
$input = explode("¥n", $str);
$tree = new Node(array_shift($input));
foreach ($input as $key => $value) {
$data = explode(',', $value);
$tree->insertByData($data[1],$data[0],1);
$tree->insertByData($data[2],$data[0],2);
}
$data = array();
$i = 0;
showNode($tree,$data,$i);
foreach ($data as $key => $value) {
echo "All node in depth $key: ";
echo implode($value, ",");
echo "";
}
echo "";
echo "";
}
$str = "1
1,2,3
2,4,5
3,6,7
4,8,
6,9,10
10,11,
11,12,13";