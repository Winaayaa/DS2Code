<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?PlayfairDisplaySC;' rel='stylesheet'>
    
    <title>SIPBAR</title>
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
            Data Barang <br><br>
            <table class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>A001</td>
      <td>Proyektor</td>
      <td>Tersedia</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>A002</td>
      <td>Kabel</td>
      <td>Sedang Digunakan</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>A003</td>
      <td>Speaker</td>
      <td>Kosong</td>
    </tr>
  </tbody>
</table>
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
</html>
