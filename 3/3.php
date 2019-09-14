<?php 

function itungKataSama($str,$kata)
{
	if (strlen($str) < strlen($kata)) {
		return 'String lebih besar dari kata.';
	}else{
		return substr_count($str, $kata);
	}
}


echo itungKataSama('s','nana');
