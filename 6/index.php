<?php include 'inc/db.php'; include 'inc/fungsi.php'; 

	$page = isset($_GET['page']) ? $_GET['page'] : '';
	switch ($page) {
    case 'kategori':
      if ($page) {
        include 'inc/content/kategori/home.php';
      }
      break;

    case 'deleteKategori':
      if ($page) {
        include 'inc/content/kategori/deleteKategori.php';
      }
      break;

    case 'work':
      if ($page) {
        include 'inc/content/work/home.php';
      }
      break;

    case 'deletework':
      if ($page) {
        include 'inc/content/work/deleteWork.php';
      }
      break;

		case 'delete':
			if ($page) {
				include 'inc/content/delete.php';
			}
			break;

		default:
			include 'inc/content/home.php';
			break;
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <title>Soal nomer 6</title>
  </head>
  <body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img src="https://www.arkademy.com/img/Arkademy%20Putih.4e0c6a87.svg" width="30%"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=kategori">Data Kategori
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=work">Data Work
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <?php include 'inc/_message.php'; ?>
      	<?= $content;  ?>
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
    $('#modal_edit_kategori').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id_details') // Extract info from data-* attributes
          $('[name="salary"]').val('')
          $.ajax({
                url : "ajax.php",
                method : "POST",
                data : {id: id,type: 'getEditKategori'},
                async : true,
                dataType : 'json',
                success: function(data){
                    $('[name="_id"]').val(data.id)
                    
                    $('[name="salary"]').val(data.salary)
                },error:function(e){
                   console.log(e);
                }
            });
    })  

    $('#modal_edit_kategori').on('hidden.bs.modal', function (event) {
        $('[name="salary"]').val('')

    })
    $('#modal_edit_work').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id_details') // Extract info from data-* attributes

          $.ajax({
                url : "ajax.php",
                method : "POST",
                data : {id: id,type: 'getEditWork'},
                async : true,
                dataType : 'json',
                success: function(data){

                    $('[name="_id"]').val(data.id)
                    $('[name="work"]').val(data.name)
                    $('#id_salary option[value="'+data.id_salary+'"]').prop('selected', true);
                },error:function(e){
                   console.log(e);
                }
            });
    })
    $('#modal_edit_work').on('hidden.bs.modal', function (event) {
        $('[name="_id"]').val('')
        $('[name="work"]').val('')

    })
    $('#id_work').on('change', function (event){
          var id = $(this).val()
          $.ajax({
                url : "ajax.php",
                method : "POST",
                data : {id: id,type: 'getEditWorkChange'},
                async : true,
                dataType : 'json',
                success: function(data){
                    if (id == '--PILIH---') {
                      $('#id_salary').val('')
                    }else{
                      $('[name="id_salary"]').val(data.id_salary)
                      $('#id_salary').val(data.salary)
                    }
                },error:function(e){
                   console.log(e);
                }
            });      

    })


          $('#id_work_edit').on('change', function (event){
          var id = $(this).val()
          $.ajax({
                url : "ajax.php",
                method : "POST",
                data : {id: id,type: 'getEditWorkChange'},
                async : true,
                dataType : 'json',
                success: function(data){
                    if (id == '--PILIH---') {
                      $('#id_salary_edit').val('')
                    }else{
                      $('[name="id_salary_edit"]').val(data.id_salary)
                      $('#id_salary_edit').val(data.salary)
                    }
                },error:function(e){
                   console.log(e);
                }
            });      

        })
    $('#modal_edit_home').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var id = button.data('id_details') // Extract info from data-* attributes

          $.ajax({
                url : "ajax.php",
                method : "POST",
                data : {id: id,type: 'getEditHome'},
                async : true,
                dataType : 'json',
                success: function(data){
                    console.log(data.salary)
                    $('[name="_id"]').val(data.id)
                    // $('[name="id_salary"]').val(data.id_salary)
                    $('#name_edit').val(data.nama)
                    $('#id_work_edit').val(data.salary)
                    $('#id_salary_edit').val(data.salary)
                    $('#id_salary_val_edit').val(data.id_salary)
                    $('#id_work_edit option[value="'+data.id_work+'"]').prop('selected', true);
                },error:function(e){
                   console.log(e);
                }
            });

    })
    </script>



    <script>
      if ($('.message').data('message')) {
        const href = $('.message').data('href');
        Swal.fire({
        title: $('.message').data('title'),
        text : $('.message').data('message'),
        type: $('.message').data('type'),

          onClose: () => {
            window.location.assign(href)
          }
        });
      }     
    </script>    
  </body>
</html>