<?php 

$name   	= 'Mahesa Ibrahim';
$age 		= 18;
$address 	= 'Ds. Pasir Angin RT 02/04 Cileungsi Bogor 16820';
$hobbies	= ['Menulis kode', 'Bermain Dota'];
$is_married = false;
$school = [(object)
			[
				'name' => 'SMK BINA MANDIRI MULTIMEDIA',
				'year_in'=> 2016,
				'year_out'=> 2019,
				'major'=>null
			]
		];
$skills = [ (object) [
				'name' => 'OOP', 
				'level' => 'advance'
			],
			[
				'name' => 'Web Developer', 
				'level' => 'advance'
			],
			[
				'name' => 'Dekstop', 
				'level' => 'advance'
			]

		];
$interest_in_coding = true;
echo json_encode([
        'name' => $name,
        'address' => $address,
        'hobbies' => $hobbies,
        'is_married' => $is_married,
        'school' => $school,
        'skills' => $skills
        'interest_in_coding' => $interest_in_coding
 ], JSON_PRETTY_PRINT);

/*
https://stackoverflow.com/questions/3707722/how-to-build-arrays-of-objects-in-php-without-specifying-an-index-number
*/