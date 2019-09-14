<?php ob_start();				
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id) {
	$sql = "DELETE FROM work WHERE id = '$id'";
	if (mysqli_query($conn,$sql)) {
		$message = [
	        'title' => 'Sukses!',
	        'txt' => 'Hapus data berhasil...',
	        'type' => 'success',
	        'href' => 'index.php?page=work'
   	 	];
	}else{
      $message = [
          'title' => 'Gagal!',
          'txt' => 'Ups, ada kesalahan pada sistem! <br />'.$conn->error,
          'type' => 'error',
          'href' => 'index.php?page=work'
      ]; 		
	}
}	
include 'inc/_message.php';
$content = ob_get_clean();