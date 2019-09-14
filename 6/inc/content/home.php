<?php 
ob_start(); 

$sql = "SELECT w.*,k.salary FROM work w 
        INNER JOIN kategori k 
        ON k.id = w.id_salary
        ORDER BY w.id DESC";
$query = mysqli_query($conn, $sql);
$dataWork = mysqli_fetch_all($query, MYSQLI_ASSOC);


$sql = "SELECT n.*,w.name,k.salary FROM nama n
        INNER JOIN work w 
        ON w.id = n.id_work
        INNER JOIN kategori k 
        ON k.id = w.id_salary
        ORDER BY n.id DESC";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

if (isset($_POST['input'])) {
  extract($_POST);
  $sql = "INSERT INTO nama(nama,id_work,id_salary) VALUES('$name','$id_work','$id_salary')";
  $query = mysqli_query($conn, $sql);

  if ($query) {
    $message = [
        'title' => 'Sukses!',
        'txt' => 'Tambah data berhasil...',
        'type' => 'success',
        'href' => 'index.php'
    ];
  }else{
      $message = [
          'title' => 'Gagal!',
          'txt' => 'Ups, ada kesalahan pada sistem! <br />'.$conn->error,
          'type' => 'error',
          'href' => 'index.php'
      ];  
  }
}

if (isset($_POST['edit'])) {
  extract($_POST);
  $sql = "UPDATE nama SET nama = '$name',id_work = '$id_work',id_salary='$id_salary' WHERE id = '$_id'";
  $query = mysqli_query($conn, $sql);

  if ($query) {
    $message = [
        'title' => 'Sukses!',
        'txt' => 'Edit data berhasil...',
        'type' => 'success',
        'href' => 'index.php'
    ];
  }else{
      $message = [
          'title' => 'Gagal!',
          'txt' => 'Ups, ada kesalahan pada sistem! <br />'.$conn->error,
          'type' => 'error',
          'href' => 'index.php'
      ];  
  }
}

?>

<div class="col-lg-7 mx-auto">
  <button class="btn btn-warning float-right mt-4 mb-4" data-toggle="modal" data-target="#modal_input_home" data-backdrop="static" data-keyboard="false">Add</button>
  <h3>Data</h3>
   <table class="table table-striped">
   	<thead>
   		<tr>
   			<th scope="col">Id</th >
        	<th scope="col">Name</th >
        	<th scope="col">Work</th >
   			<th scope="col">Salary</th >
   			<th scope="col">Action</th >
   		</tr>
   	</thead>
   	<tbody>
      <?php $i=1; foreach ($data as $item): ?>
          <tr>
            <th scope="row"><?= $i;  ?></th>
            <td><?= $item['nama']  ?></td>
            <td><?= $item['name']  ?></td>
            <td><?= rp($item['salary'])  ?></td>
            <td>
              <a href="index.php?page=delete&id=<?= $item['id']  ?>" onclick="return confirm('Are you sure ?')"><span class="fa fa-trash"></span></a>
              <a href="#" data-toggle="modal" data-target="#modal_edit_home" data-id_details="<?= $item['id'] ?>" data-backdrop="static" data-keyboard="false"><span class="fa fa-pencil"></span></a>
            </td>
          </tr>
      <?php $i++; endforeach ?>
   	</tbody>
   </table>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_input_home">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Data</h3>
                <hr>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>                      
                    <div class="form-group">
                        <label>Work</label>
                        <select name="id_work" id="id_work" class="form-control" required >
                        	<option>--PILIH---</option>
                        <?php foreach ($dataWork as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="hidden" name="id_salary">
                        <input type="text" id="id_salary" class="form-control" required  disabled="" />
                    </div>                    
                    <div class="form-group">
                    	<button type="submit" name="input" class="btn btn-primary float-right">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_home">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Data</h3>
                <hr>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="_id" id="id">
                        <input type="text" name="name" id="name_edit" class="form-control" required />
                    </div>                      
                    <div class="form-group">
                        <label>Work</label>
                        <select name="id_work" id="id_work_edit" class="form-control" required >
                        	<option>--PILIH---</option>
                        <?php foreach ($dataWork as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="hidden" name="id_salary" id="id_salary_val_edit">
                        <input type="text" id="id_salary_edit" class="form-control" required  readonly />
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