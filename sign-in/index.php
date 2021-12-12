<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SIPBAR Log In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href='https://fonts.googleapis.com/css?PlayfairDisplaySC;' rel='stylesheet'>

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      body {
        background-image : linear-gradient(#ebe8fc, #bcb9c6);
      }
      .card {
        border-radius : 20px;
      }
      .btn {
        background-color: #7662ea;
      }
      .h3 {
        font-family : Playfair Display SC;
      }
      .form-control {
        background-color: #bcb9c6;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
<div class="card ms-1 mt-4">
        <div class="card-header">
        <form action="../proses/proses_login.php" method="POST">
    <img class="mb-4" src="../assets/brand/Logo_Politeknik_Negeri_Lhokseumawe.png" alt="" width="100" height="100">
    
    <p>Silakan masukkan username dan password Anda</p>

    <div class="form-floating">
      <input type="email" class="form-control" id="username" name="useranme" placeholder="name@example.com">
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg" type="submit"><strong>Log In</strong></button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021 by ds2code</p>
  </form>
        </div>
        </div>
</main>


    
  </body>
</html>
