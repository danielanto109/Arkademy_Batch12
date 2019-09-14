<?php 
ob_start(); 

$sql = "SELECT * FROM kategori ORDER BY id DESC";
$query = mysqli_query($conn, $sql);
$dataKategori = mysqli_fetch_all($query, MYSQLI_ASSOC);


$sql = "SELECT w.*,k.salary FROM work w 
        INNER JOIN kategori k 
        ON k.id = w.id_salary
        ORDER BY w.id DESC";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_POST['input'])) {
  $name = $_POST['work'];
  $id_salary = $_POST['id_salary'];

  $sql = "INSERT INTO work(name,id_salary) VALUES('$name','$id_salary')";
  $query = mysqli_query($conn, $sql);

  if ($query) {
    $message = [
        'title' => 'Sukses!',
        'txt' => 'Tambah data berhasil...',
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

if (isset($_POST['edit'])) {
  $id = $_POST['_id'];

  $name = $_POST['work'];
  $id_salary = $_POST['id_salary'];
  $sql = "UPDATE work SET name = '$name',id_salary = '$id_salary' WHERE id = '$id'";
  $query = mysqli_query($conn, $sql);

  if ($query) {
    $message = [
        'title' => 'Sukses!',
        'txt' => 'Edit data berhasil...',
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

?>

<div class="col-lg-7 mx-auto">
  <button class="btn btn-warning float-right mt-4 mb-4" data-toggle="modal" data-target="#modal_input_work" data-backdrop="static" data-keyboard="false">Add</button>
  <h3>Data Work</h3>
   <table class="table table-striped">
   	<thead>
   		<tr>
   			<th scope="col">Id</th >
        <th scope="col">Name</th >
   			<th scope="col">Salary</th >
   			<th scope="col">Action</th >
   		</tr>
   	</thead>
   	<tbody>
      <?php $i=1; foreach ($data as $item): ?>
          <tr>
            <th scope="row"><?= $i;  ?></th>
            <td><?= $item['name']  ?></td>
            <td><?= rp($item['salary'])  ?></td>
            <td>
              <a href="index.php?page=deletework&id=<?= $item['id']  ?>" onclick="return confirm('Are you sure ?')"><span class="fa fa-trash"></span></a>
              <a href="#" data-toggle="modal" data-target="#modal_edit_work" data-id_details="<?= $item['id'] ?>" data-backdrop="static" data-keyboard="false"><span class="fa fa-pencil"></span></a>
            </td>
          </tr>
      <?php $i++; endforeach ?>
   	</tbody>
   </table>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_input_work">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Work</h3>
                <hr>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label>Work</label>
                        <input type="text" name="work" id="work" class="form-control"/>
                    </div>                      
                    <div class="form-group">
                        <label>Salary</label>
                        <select name="id_salary" class="form-control">
                        <?php foreach ($dataKategori as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= rp($item['salary'])  ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                    	<button type="submit" name="input" class="btn btn-primary float-right">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_work">
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
                    <div class="form-group">
                        <label>Work</label>
                        <input type="text" name="work" id="work" class="form-control"/>
                        <input type="hidden" name="_id" id="id" class="form-control"/>
                    </div>                      
                        <label>Salary</label>
                        <select name="id_salary" id="id_salary" class="form-control">
                        <?php foreach ($dataKategori as $item): ?>
                            <option value="<?= $item['id'] ?>"><?= rp($item['salary'])  ?></option>
                        <?php endforeach ?>
                        </select>
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