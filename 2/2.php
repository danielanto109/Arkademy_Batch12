
<?php 


function is_username_valid($str)
{
	return preg_match("/^[a-z0-9-]{4,9}$/ix", $str);
}

function is_password_valid($str)
{
	# return preg_match("/[^A-Za-z0-9 -]/", $str);  
	return preg_match("/^([a-zA-Z0-9@$#]){8,15}$/", $str);
}
echo is_username_valid('@sony');
echo '<br />';
echo is_username_valid('Ayu99v');
echo '<br />';
echo is_password_valid('p@sszzSrd1111#');
// echo is_password_valid('p#sszzSrd1111');
