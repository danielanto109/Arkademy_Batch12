<?php  
function cetak($jumlah)
{
	$str = [];
	for ($i=1; $i <= $jumlah; $i++) { 
		$str[] = str_shuffle(str_shuffle(uniqid().uniqid().uniqid()));
	}
	if (count($str) == count(array_unique($str))) {
		return '<li>'.implode('</li><li>',$str).'</li>';
	}else{
		return 'Ada string yang sama!';
	}

}
echo '<ol>'.cetak(4).'</ol>';
