<?php
include "proses/session.php";
$sql = mysqli_query($conn, "SELECT * FROM tb_dosen");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?PlayfairDisplaySC;' rel='stylesheet'>
    
    <title>INFOTIK</title>
  </head>

  <body>
  
  <!-- Grid System -->
  <div class="container-fluid">
      <!-- Header -->
  <div class="row">
        <?php 
        require "header.php";
        ?>
  </div>
  <!-- End of Header -->

  <div class="row">
    <!-- Sidebar -->
    <div class="col">
        <?php 
        require "sidebar.php";
        ?>
    </div>
    <!-- End of Sidebar -->
    
    <!-- Content -->
    <div class="col-9">
    <div class="card ms-1 mt-4">
        <div class="card-header">
        Lhokseumawe, <?php echo date('l, d-m-Y'); ?> <br>
            Data Dosen
        </div>

<!-- awal card body -->
<div class="card-body">
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama</th>
      <th scope="col">Program Studi</th>
      <th scope="col">Tempat Lahir</th>
      <th scope="col">Tanggal Lahir</th>
      <th scope="col">Alamat</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
    $no = 0;
  while($data = mysqli_fetch_array($sql)) {
    $no++;
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td><?php echo $data['nip'] . "<br>"; ?></td>
      <td><?php echo $data['nm_dosen'] . "<br>"; ?></td>
      <td><?php echo $data['prodi'] . "<br>"; ?></td>
      <td><?php echo $data['tempat_lahir'] . "<br>"; ?></td>
      <td><?php echo $data['tgl_lahir'] . "<br>"; ?></td>
      <td><?php echo $data['alamat'] . "<br>"; ?></td>
      <td>
      
       <!--Button Edit-->
       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalEditDosen<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
      <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
      </svg>
      </button>

      <!-- Modal Edit -->
      <div class="modal fade" id="ModalEditDosen<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/proses_edit_data_dosen.php" method="POST">

            <div class="modal-body">
              <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
              <div class="mb-3">
                <label for="nip" class="col-form-label">NIP:</label>
                <input type="text" class="form-control" id="nip" name="nip"
                value="<?php echo $data['nip']; ?>">
              </div>
              <div class="mb-3">
                <label for="nm_dosen" class="col-form-label">Nama :</label>
                <input type="text" class="form-control" id="nm_dosen" name="nm_dosen"
                value="<?php echo $data['nm_dosen']; ?>">
              </div>
              <div class="mb-3">
                <label for="prodi" class="col-form-label">Program Studi :</label>
                <input type="text" class="form-control" id="prodi" name="prodi"
                value="<?php echo $data['prodi']; ?>">
              </div>
              <div class="mb-3">
                <label for="tempat_lahir" class="col-form-label">Tempat Lahir :</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                value="<?php echo $data['tempat_lahir']; ?>">
              </div>
              <div class="mb-3">
                <label for="tgl_lahir" class="col-form-label">Tanggal Lahir :</label>
                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir"
                value="<?php echo $data['tgl_lahir']; ?>">
              </div>
              <div class="mb-3">
                <label for="alamat" class="col-form-label">Alamat :</label>
                <input type="text" class="form-control" id="alamat" name="alamat"
                value="<?php echo $data['alamat']; ?>">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>

            </form>
          </div>
        </div>
      </div>
      <!-- Akhir Modal Edit -->

      <!-- Button Delete -->
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteDosen<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
      </svg>
      </button>

      <!-- Modal Delete -->
      <div class="modal fade" id="ModalDeleteDosen<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Hapus Data Dosen</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/proses_hapus_data_dosen.php" method="POST">
            <div class="modal-body">
            <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
              Apakah Anda ingin menghapus data <?php echo $data['nm_dosen'] . ' ' . $data['nip']?> ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger">Hapus</button>
            </div>
            </form>  
          </div>
        </div>
      </div>
      <!-- Akhir Modal Delete -->


      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
        </div>
<!-- akhir card body -->

        </div>
    </div>
    <!-- End of Content -->

  </div>
</div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
