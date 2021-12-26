<?php
  include "proses/session.php";
  $profil = mysqli_query($conn, "SELECT * FROM tb_user usr
  LEFT JOIN tb_mahasiswa mhs ON usr.id = mhs.id_user
  WHERE username='$_SESSION[username]'");
  $data = mysqli_fetch_array($profil);
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
        <h4><strong>Profile Anda</strong></h4>
        <div class="card-header">
        <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
    value="<?php echo $data['username']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Level</label>
    <input type="text" class="form-control"
    value="<?php echo $data['level']; ?>" disabled>
  </div>
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="email" class="form-control" 
    value="<?php echo $data['nama']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">NIM</label>
    <input type="email" class="form-control"
    value="<?php echo $data['nim']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Tanggal Lahir</label>
    <input type="email" class="form-control"
    value="<?php echo $data['tgl_lahir']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Tempat Lahir</label>
    <input type="email" class="form-control"
    value="<?php echo $data['tempat_lahir']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
    <div class="mb-3">
    <label class="form-label">Kelas</label>
    <input type="email" class="form-control"
    value="<?php echo $data['kelas']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Program Studi</label>
    <input type="email" class="form-control"
    value="<?php echo $data['prodi']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Alamat</label>
    <input type="email" class="form-control"
    value="<?php echo $data['alamat']; ?>" disabled>
    <div id="emailHelp" class="form-text"></div>
  </div>
</form>
    </div>
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