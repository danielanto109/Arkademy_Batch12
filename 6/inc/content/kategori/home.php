<?php 
ob_start(); 
$sql = "SELECT * FROM kategori ORDER BY id DESC";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST['input'])) {
  $salary = $_POST['salary'];

  $sql = "INSERT INTO kategori(salary) VALUES('$salary')";
  $query = mysqli_query($conn, $sql);

  if ($query) {
    $message = [
        'title' => 'Sukses!',
        'txt' => 'Tambah data berhasil...',
        'type' => 'success',
        'href' => 'index.php?page=kategori'
    ];
  }else{
      $message = [
          'title' => 'Gagal!',
          'txt' => 'Ups, ada kesalahan pada sistem! <br />'.$conn->error,
          'type' => 'error',
          'href' => 'index.php?page=kategori'
      ];  
  }
}

if (isset($_POST['edit'])) {
  $salary = $_POST['salary'];
  $id = $_POST['_id'];
  $sql = "UPDATE kategori SET salary = '$salary' WHERE id = '$id'";
  $query = mysqli_query($conn, $sql);

  if ($query) {
    $message = [
        'title' => 'Sukses!',
        'txt' => 'Edit data berhasil...',
        'type' => 'success',
        'href' => 'index.php?page=kategori'
    ];
  }else{
      $message = [
          'title' => 'Gagal!',
          'txt' => 'Ups, ada kesalahan pada sistem! <br />'.$conn->error,
          'type' => 'error',
          'href' => 'index.php?page=kategori'
      ];  
  }
}

?>

<div class="col-lg-7 mx-auto">
  <button class="btn btn-warning float-right mt-4 mb-4" data-toggle="modal" data-target="#modal_input_kategori" data-backdrop="static" data-keyboard="false">Add</button>
  <h3>Data Kategori</h3>
   <table class="table table-striped">
   	<thead>
   		<tr>
   			<th scope="col">Id</th >
   			<th scope="col">Salary</th >
   			<th scope="col">Action</th >
   		</tr>
   	</thead>
   	<tbody>
      <?php $i=1; foreach ($data as $item): ?>
          <tr>
            <th scope="row"><?= $i;  ?></th>
            <td><?= rp($item['salary'])  ?></td>
            <td>
              <a href="index.php?page=deleteKategori&id=<?= $item['id']  ?>" onclick="return confirm('Are you sure ?')"><span class="fa fa-trash"></span></a>
              <a href="#" data-toggle="modal" data-target="#modal_edit_kategori" data-id_details="<?= $item['id'] ?>" data-backdrop="static" data-keyboard="false"><span class="fa fa-pencil"></span></a>
            </td>
          </tr>
      <?php $i++; endforeach ?>
   	</tbody>
   </table>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_input_kategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add data</h3>
                <hr>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control"/>
                    </div>
                    <div class="form-group">
                    	<button type="submit" name="input" class="btn btn-primary float-right">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_kategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit</h3>
                <hr>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="number" name="salary" id="salary" class="form-control"/>
                        <input type="hidden" name="_id" id="_id" class="form-control"/>

                    </div>
                    <div class="form-group">
                      <button type="submit" name="edit" class="btn btn-primary float-right">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>