<?php
require "proses/session.php";
$select = mysqli_query($conn, "SELECT * FROM tb_barang");
//$query = mysqli_fetch_array($select);

//while($hasil=mysqli_fetch_array($select)) {
 // echo $hasil['nama_barang'] . "<br>"; }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>SIPBAR (Sistem Informasi Peminjaman Barang Jurusan TIK</title>
  </head>

  <body>

  <div class="container-fluid">
  <div class="row">
    <!--Header-->
    <?php
        require "header.php";
    ?>
    <!-- Akhir Header -->
  </div>
  
  <div class="row">
    <div class="col-3">
    <!-- Sidebar -->
    <?php
        require "sidebar.php";
    ?>
    <!--Akhir Sidebar-->
    </div>

    <!--Isi Content-->
    <div class="col-9">
    <div class="card ms-1 mt-4">
      <h5 class="card-header">
        <strong>Data Barang</strong>
      </h5>
      <div class="card-body">
      DATA BARANG SISTEM INFORMASI PEMINJAMAN BARANG <br>
      JURUSAN TEKNOLOGI INFORMASI DAN KOMPUTER - POLITEKNIK NEGERI LHOKSEUMAWE <br><br>
        <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Gambar</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
  while($hasil=mysqli_fetch_array($select)) {
    $no++;
    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><?php echo "<img src='images/barang/$hasil[gambar]' class='img-thumbnail' width='100' height='120'" . "<br>"; ?></td>
      <td><?php echo $hasil['nama_barang'] . "<br>"; ?></td>
      <td><?php echo $hasil['keterangan'] . "<br>"; ?></td>
      <td>

<!--Button Edit-->
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $no; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
      <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
      </svg>
      </button>

<!-- Modal Edit-->
<div class="modal fade" id="ModalEdit<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_edit_data_barang.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="kode_barang" value="<?php echo $hasil['kode_barang']; ?>">
          <div class="mb-3">
            <label for="nama_barang" class="col-form-label">Nama Barang:</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
            value="<?php echo $hasil['nama_barang']; ?>">
          </div>
          <div class="mb-3">
            <label for="keterangan" class="col-form-label">Keterangan:</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan"
            value="<?php echo $hasil['keterangan']; ?>">
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
      
<!--Button Delete-->
      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $no; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg>
      </button>

<!-- Modal Delete-->
<div class="modal fade" id="ModalDelete<?php echo $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_hapus_data_barang.php" method="POST">
      <div class="modal-body">
      <input type="hidden" name="kode_barang" value="<?php echo $hasil['kode_barang']; ?>">
        Apakah Anda ingin menghapus data <?php echo $hasil['nama_barang'] . ' ' . $hasil['keterangan']?> ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
      </form>
    </div>
  </div>
  </div>
    
    </td>
</tr>
<?php } ?>
  </tbody>
</table>


  <!-- Button Tambah -->
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAdd<?php echo $no; ?>">
  Tambah
</button>

<!-- Modal Tambah-->
<div class="modal fade" id="ModalAdd<?php echo $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_tambah_barang.php" method="POST">
      <div class="modal-body">
          <div class="mb-3">
            <label for="kode_barang" class="col-form-label">Kode Barang:</label>
            <input type="text" class="form-control" name="kode_barang">
          </div>
          <div class="mb-3">
            <label for="nama_barang" class="col-form-label">Nama Barang:</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang">
          </div>
          <div class="mb-3">
            <label for="keterangan" class="col-form-label">Keterangan:</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan">
          </div>
          <div class="mb-3">
            <label for="stok" class="col-form-label">Stok:</label>
            <input type="text" class="form-control" id="stok" name="stok">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Tambah</button>
      </div>
      </div>
      </form>
      </div>
    </div>
  </div>
</div>

        </div>
        
      </div>
    </div>
  </div>
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