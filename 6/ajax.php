<?php 
if (isset($_POST['id']) && !empty($_POST['id'])){
	include_once 'inc/db.php';
	$type = isset($_POST['type']) ? $_POST['type'] : '';
	$id = isset($_POST['id']) ? $_POST['id'] : '';
	switch ($type) {
		case 'getEditKategori':
				$sql = "SELECT * FROM kategori WHERE id = '$id'";
			break;
		case 'getEditWork':
				$sql = "SELECT * FROM work WHERE id = '$id'";
			break;	

		case 'getEditWorkChange':
				$sql = "SELECT w.*,k.salary FROM work w 
        				INNER JOIN kategori k 
        				ON k.id = w.id_salary  
        				WHERE w.id = '$id'";
			break;	

		case 'getEditHome':
				$sql = "SELECT n.*,w.name,k.salary FROM nama n
				        INNER JOIN work w 
				        ON w.id = n.id_work
				        INNER JOIN kategori k 
				        ON k.id = w.id_salary
				        WHERE n.id = '$id'";
			break;				
	}

	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($query);
	echo json_encode($result);

}

