<?php

function cetek_gambar($number)
{
	$cek = $number % 2;
	if ($cek != 1) {
		return 'Bukan bilangan ganjil!';
	}

    $result = "";

    for ($i=1; $i <= $number; $i++) { 
        for($j = 1;$j < $number+1;$j++){
        	if ($j == 1 || $j == $number || $i == round($number /2)) {
        		$result .= ' * ';
        	}else{
        		if ($j == 0) {
        			$result .= ' = ';
        		}
        		if ($i == $number) {
        			$result .= ' = ';
        		}else{
        			$result .= ' = ';
        		}
        	}
        }
        $result .="<br>";
    }
    return $result .'Input: '.$number;
}

echo '<center>'.cetek_gambar(5).'</center><br />';
echo '<center>'.cetek_gambar(7).'</center>';

?>