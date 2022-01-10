<?php
require "proses/session.php";

//query untuk tabel peminjaman
$select = mysqli_query($conn, "SELECT * FROM tb_peminjaman pem
LEFT JOIN tb_barang brg ON pem.barang=brg.kode_barang
LEFT JOIN tb_matakuliah mk ON pem.matakuliah=mk.kode_matakuliah
LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip
LEFT JOIN tb_user usr ON pem.user=usr.id 
WHERE status=1 || status=2 || status=5");

//query untuk tabel tambah peminjaman
$selct = mysqli_query($conn, "SELECT * FROM tb_peminjaman pem
LEFT JOIN tb_barang brg ON pem.barang=brg.kode_barang
LEFT JOIN tb_matakuliah mk ON pem.matakuliah=mk.kode_matakuliah
LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip
LEFT JOIN tb_user usr ON pem.user=usr.id 
WHERE username='$_SESSION[username]'");

//query untuk tabel list peminjaman
$sql = mysqli_query($conn, "SELECT * FROM tb_peminjaman pem
LEFT JOIN tb_barang brg ON pem.barang=brg.kode_barang
LEFT JOIN tb_mahasiswa mhs ON pem.user=mhs.id_user
LEFT JOIN tb_matakuliah mk ON pem.matakuliah=mk.kode_matakuliah
LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip");

//query untuk tabel riwayat peminjaman
$slect = mysqli_query($conn, "SELECT * FROM tb_peminjaman pem
LEFT JOIN tb_barang brg ON pem.barang=brg.kode_barang
LEFT JOIN tb_matakuliah mk ON pem.matakuliah=mk.kode_matakuliah
LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip
LEFT JOIN tb_user usr ON pem.user=usr.id 
WHERE status=3 || status=4");

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
            Peminjaman Barang
        </div>

        <div class="card-body">
      DATA BARANG SISTEM INFORMASI PEMINJAMAN BARANG <br>
      JURUSAN TEKNOLOGI INFORMASI DAN KOMPUTER - POLITEKNIK NEGERI LHOKSEUMAWE <br><br>


      <?php
      if ($row['level'] == 'dosen' || $row['level'] == 'mahasiswa') {
      ?>

      <!-- Button Tambah -->
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalAdd">
          Tambah Peminjaman
      </button>

      <!-- Button List Peminjaman -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalList">
        List Peminjaman
      </button>

      <!-- Button Riwayat Peminjaman -->
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalHistory">
        Riwayat Peminjaman
      </button>
      <?php
      }
      ?>

      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Gambar</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Waktu Peminjaman</th>
      <th scope="col">Waktu Pengembalian</th>
      <th scope="col">Mata Kuliah</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
  while($hasil=mysqli_fetch_array($select)) {
    $no++;
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td><?php echo $hasil['kode_barang'] . "<br>"; ?></td>
      <td><?php echo "<img src='images/barang/$hasil[gambar]' class='img-thumbnail' width='100' height='120'" . "<br>"; ?></td>
      <td><?php echo $hasil['nama_barang'] . "<br>"; ?></td>
      <td><?php echo $hasil['keterangan'] . "<br>"; ?></td>
      <td><?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_peminjaman'])) . "<br>"; ?></td>
      <td><?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_pengembalian'])) . "<br>"; ?></td>
      <td><?php echo $hasil['nm_matakuliah'] . " - " . $hasil['nm_dosen'] . "<br>"; ?></td>
      <td>
        <?php 
        if ( $hasil['status'] == 1 ) echo "<span class='badge bg-secondary'>Pending</span>";
        elseif ( $hasil['status'] == 2 ) echo "<span class='badge bg-success'>Dipinjam</span>";
        elseif ( $hasil['status'] == 3 ) echo "<span class='badge bg-danger'>Ditolak</span>";
        elseif ( $hasil['status'] == 4 ) echo "<span class='badge bg-primary'>Telah Dikembalikan</span>";
        elseif ( $hasil['status'] == 5 ) echo "<span class='badge bg-warning'>Proses Dikembalikan</span>";
        ?>
      </td>
      <td>
        <?php
        if ($hasil['status'] == 1) {
        ?>

      <!--Button Check-->
      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ModalCheck<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
      </svg>
      </button>
      <!--Button Edit-->
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
      <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
      </svg>
      </button>
      <!--Button Delete-->
      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
      </svg>
      </button>
      
      <?php 
        } elseif ($hasil['status'] == 5) {
      ?>
      <!-- Button Setujui Kembali -->
      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalKembali<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
          <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z" />
          <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
      </svg>
      </button>

      <?php
        }
      ?>
<!-- Modal Check Setujui-->
<div class="modal fade" id="ModalCheck<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cek Disetujui</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_setujui_peminjaman.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="id_peminjaman" value="<?php echo $hasil['id_peminjaman'] ?>">
          <div class="mb-3">
            <label for="kode_barang" class="col-form-label">Nama Barang</label>
            <input type="text" class="form-control" 
            value="<?php
            echo $hasil['kode_barang'] . " - " . $hasil['nama_barang'] . " " 
            . $hasil['keterangan'] ?>" disabled>
          </div>
          <div class="mb-3">
            <label for="mk" class="col-form-label">Mata Kuliah</label>
            <input type="text" class="form-control" id="mk" name="mk"
            value="<?php echo $hasil['nm_matakuliah'] . " - " . $hasil['nm_dosen']?>">
          </div>
          <div class="mb-3">
            <label for="wkt_kembali" class="col-form-label">Waktu Peminjaman s/d Waktu Pengembalian</label>
            <input type="text" class="form-control"
            value="<?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_peminjaman'])) 
            . " s/d " . date("d-m-Y H:i:s", strtotime($hasil['waktu_pengembalian']));?>" disabled>
          </div>
          <div class="mb-3">
            <label class="col-form-label">Aksi</label>
            <select name="aksi" class="form-select">
            <option value="2">Disetujui</option>
            <option value="3">Ditolak</option>
            </select>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Simpan</button>
      </div>
      </div>
      </form>
    </div>
  </div> 
  </div>
<!-- Akhir Modal Check Setujui -->
<!-- Modal Edit-->
<div class="modal fade" id="ModalEdit<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_tambah_barang.php" method="POST">
      <div class="modal-body">
          <div class="mb-3">
            <label for="kode_barang" class="col-form-label">Nama Barang</label>
            <select name="barang" class="form-select">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM tb_barang");
              while ($hasil1 = mysqli_fetch_array($query)) {
                echo "<option value='$hasil1[kode_barang]'>" . $hasil1['kode_barang'] . " "
                . $hasil1['nama_barang'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="matkul" class="col-form-label">Mata Kuliah</label>
            <select name="matkul" class="form-select">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM tb_matakuliah mk
              LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip");
              while ($hasil1 = mysqli_fetch_array($query)) {
                echo "<option value='$hasil1[kode_matakuliah]'>" . $hasil1['kode_matakuliah'] . " "
                . $hasil1['nm_matakuliah'] . " - " . $hasil1['nm_dosen'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="wkt_kembali" class="col-form-label">Waktu Pengembalian</label>
            <input type="datetime-local" class="form-control" name="wkt_kembali"
            value="<?php echo date("d/m/Y H.i", strtotime($hasil['waktu_pengembalian'])) ?>">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </div>
      </form>
    </div>
  </div> 
  </div>
<!-- Akhir Modal Edit -->
<!-- Modal Delete-->
<div class="modal fade" id="ModalDelete<?php echo $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_hapus_data_peminjaman.php" method="POST">
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
<!-- Akhir Modal Delete -->
<!-- Modal Setujui Kembali Peminjaman -->
<div class="modal fade" id="ModalKembali" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List Peminjaman Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_setujui_kembali_peminjaman.php">
        <input type="hidden" name="id_peminjaman" value="<?php echo $hasil['barang']; ?>">
        <div class="modal-body">
        <div class="mb-3">
        <label class="form_label">Nama Barang</label>
        <input type="text" class="form-control" value="<?php echo $hasil['kode_barang'] 
        . " - " . $hasil['nama_barang'] . " - " . $hasil['keterangan'] ?>" disabled>
        </div>
        <div class="mb-3">
        <label class="form_label">Mata Kuliah</label>
        <input type="text" class="form-control" value="<?php echo $hasil['nm_matakuliah'] 
        . " - " . $hasil['nm_dosen'] ?>" disabled>
        </div>
        <div class="mb-3">
        <label class="form_label">Waktu Peminjaman s/d Waktu Pengembalian</label>
        <input type="text" class="form-control" value="<?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_peminjaman'])) 
            . " s/d " . date("d-m-Y H:i:s", strtotime($hasil['waktu_pengembalian'])); ?>" disabled>
        </div>
        <div class="modal-footer">  
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Terima</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Akhir Modal Setujui Kembali -->

      </td>
</tr>
<?php } ?>
  </tbody>
</table>
        </div>      


        </div>
    </div>
    <!-- End of Content -->


<!-- Modal Tambah Peminjaman-->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_tambah_peminjaman.php" method="POST">
      <div class="modal-body">
          <div class="mb-3">
            <label for="kode_barang" class="form-label">Nama Barang</label>
            <select name="barang" class="form-select">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM tb_barang");
              while ($hasil1 = mysqli_fetch_array($query)) {
                echo "<option value='$hasil1[kode_barang]'>" . $hasil1['kode_barang'] . " "
                . $hasil1['nama_barang'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="mk" class="form-label">Mata Kuliah</label>
            <select name="matkul" class="form-select">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM tb_matakuliah mk
              LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip");
              while ($hasil1 = mysqli_fetch_array($query)) {
                echo "<option value='$hasil1[kode_matakuliah]'>" . $hasil1['kode_matakuliah'] . " "
                . $hasil1['nm_matakuliah'] . " - " . $hasil1['nm_dosen'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="wkt_kembali" class="form-label">Waktu Pengembalian</label>
            <input type="datetime-local" class="form-control" name="wkt_kembali">
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


<!-- Modal List Peminjaman -->
<div class="modal fade" id="ModalList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List Peminjaman Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Status</th>
      <th scope="col">Peminjam</th>
      <th scope="col">Waktu Peminjaman</th>
      <th scope="col">Waktu Pengembalian</th>
      <th scope="col">Mata Kuliah</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
  while($hasil=mysqli_fetch_array($sql)) {
    $no++;
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td><?php echo $hasil['kode_barang'] . "<br>"; ?></td>
      <td><?php echo $hasil['nama_barang'] . "<br>"; ?></td>
      <td>
        <?php 
        if ($hasil['status'] == '1') {
            $status = 'Dipinjam';
        } 
        elseif ($hasil['status'] == '2') {
            $status = 'Tersedia';
        }
        elseif ($hasil['status'] == '3') {
            $status = 'Dipinjam';
        } 
        else {
          $status = 'Tersedia';
        }
        echo $status;
        ?>
      </td>
      <td>
          <?php echo $hasil['nama'] . "<br>"; ?>
          <?php echo $hasil['prodi'] . "<br>"; ?>
          <?php echo $hasil['kelas'] . "<br>"; ?>
      </td>
      <td>
        <?php echo $hasil['waktu_peminjaman'] . "<br>"; ?>
      </td>
      <td>
        <?php echo $hasil['waktu_pengembalian'] . "<br>"; ?>
      </td>
      <td>
        <?php echo $hasil['nm_matakuliah'] . "<br>"; ?>
        <?php echo "(" . $hasil['dosen'] . ")<br>"; ?>
      </td>
</tr>
<?php 
  } ?>
  </tbody>
</table>
      <div class="modal-footer">  
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal List -->


<!-- Awal Modal Riwayat-->
<div class="modal fade" id="ModalHistory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Gambar</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Waktu Peminjaman</th>
      <th scope="col">Waktu Pengembalian</th>
      <th scope="col">Mata Kuliah</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
  while($hasil=mysqli_fetch_array($slect)) {
    $no++;
    ?>
    <tr>
      <th scope="row"><?php echo $no ?></th>
      <td><?php echo $hasil['kode_barang'] . "<br>"; ?></td>
      <td><?php echo "<img src='images/barang/$hasil[gambar]' class='img-thumbnail' width='100' height='120'" . "<br>"; ?></td>
      <td><?php echo $hasil['nama_barang'] . "<br>"; ?></td>
      <td><?php echo $hasil['keterangan'] . "<br>"; ?></td>
      <td><?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_peminjaman'])) . "<br>"; ?></td>
      <td><?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_pengembalian'])) . "<br>"; ?></td>
      <td><?php echo $hasil['nm_matakuliah'] . " - " . $hasil['nm_dosen'] . "<br>"; ?></td>
      <td>
        <?php 
        if ( $hasil['status'] == 1 ) echo "<span class='badge bg-secondary'>Pending</span>";
        elseif ( $hasil['status'] == 2 ) echo "<span class='badge bg-success'>Dipinjam</span>";
        elseif ( $hasil['status'] == 3 ) echo "<span class='badge bg-primary'>Dikembalikan</span>";
        elseif ( $hasil['status'] == 4 ) echo "<span class='badge bg-danger'>Ditolak</span>";
        ?>
      </td>
      <td>
        <?php
        if ($hasil['status'] != 1) $s = "disabled";
        else $s = "";
        ?>

        <!--Button Check-->
      <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ModalCheck<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
      </svg>
      </button>
      <!--Button Edit-->
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
      <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
      </svg>
      </button>
      <!--Button Delete-->
      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $no ?>">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
      </svg>
      </button>
      </td>
</tr>

<!-- Modal Check Setujui-->
<div class="modal fade" id="ModalCheck<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cek Disetujui</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_setujui_peminjaman.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="id_peminjaman" value="<?php echo $hasil['id_peminjaman'] ?>">
          <div class="mb-3">
            <label for="nama_barang" class="col-form-label">Nama Barang</label>
            <input type="text" class="form-control" 
            value="<?php
            echo $hasil['kode_barang'] . " - " . $hasil['nama_barang'] . " " 
            . $hasil['keterangan'] ?>" disabled>
          </div>
          <div class="mb-3">
            <label for="mk" class="col-form-label">Mata Kuliah</label>
            <input type="text" class="form-control" id="mk" name="mk"
            value="<?php echo $hasil['nm_matakuliah'] . " - " . $hasil['nm_dosen']?>">
          </div>
          <div class="mb-3">
            <label for="wkt_kembali" class="col-form-label">Waktu Peminjaman s/d Waktu Pengembalian</label>
            <input type="text" class="form-control"
            value="<?php echo date("d-m-Y H:i:s", strtotime($hasil['waktu_peminjaman'])) 
            . " s/d " . date("d-m-Y H:i:s", strtotime($hasil['waktu_pengembalian']));?>" disabled>
          </div>
          <div class="mb-3">
            <label class="col-form-label">Aksi</label>
            <select name="aksi" class="form-select">
            <option value="2">Disetujui</option>
            <option value="3">Ditolak</option>
            </select>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Simpan</button>
      </div>
      </div>
      </form>
    </div>
  </div> 
  </div>
<!-- Akhir Modal Check Setujui -->
<!-- Modal Edit-->
<div class="modal fade" id="ModalEdit<?php echo $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_tambah_barang.php" method="POST">
      <div class="modal-body">
          <div class="mb-3">
            <label for="kode_barang" class="col-form-label">Nama Barang</label>
            <select name="barang" class="form-select">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM tb_barang");
              while ($hasil1 = mysqli_fetch_array($query)) {
                echo "<option value='$hasil1[kode_barang]'>" . $hasil1['kode_barang'] . " "
                . $hasil1['nama_barang'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="mk" class="col-form-label">Mata Kuliah</label>
            <select name="matkul" class="form-select">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM tb_matakuliah mk
              LEFT JOIN tb_dosen dos ON mk.dosen=dos.nip");
              while ($hasil1 = mysqli_fetch_array($query)) {
                echo "<option value='$hasil1[kode_matakuliah]'>" . $hasil1['kode_matakuliah'] . " "
                . $hasil1['nm_matakuliah'] . " - " . $hasil1['nm_dosen'] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="wkt_kembali" class="col-form-label">Waktu Pengembalian</label>
            <input type="datetime-local" class="form-control" name="wkt_kembali"
            value="<?php echo date("d/m/Y H.i", strtotime($hasil['waktu_pengembalian'])) ?>">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </div>
      </form>
    </div>
  </div> 
  </div>
<!-- Akhir Modal Edit -->
<!-- Modal Delete-->
<div class="modal fade" id="ModalDelete<?php echo $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/proses_hapus_data_peminjaman.php" method="POST">
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
<!-- Akhir Modal Delete -->

<?php } ?>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Riwayat-->



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
