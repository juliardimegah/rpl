<?php
session_start();
$koneksi = new mysqli("localhost","root","","ulbi");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login | Tokoberas</title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="./images/fotologin2.jpeg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Selamat Datang</h3>
              <p class="mb-4">Silahkan Login untuk melanjutkan</p>
            </div>
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username">username</label>
                <input type="username" class="form-control" name="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password">
              </div>
                  <input type="submit" value="Log In" class="btn btn-block btn-success" name ="login">
                  <br>
                  <p>Belum punya akun?</p>
                  
                  <a href="./register.php"><b>Daftar disini.</b></a>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  <?php
if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Lakukan query ngecek akun di tabel pelanggan di db
    $ambil = $koneksi->query("SELECT * FROM user WHERE username='$username' AND password='$password'");
    
    // Ngitung akun yang terambil
    $akunyangcocok = $ambil->num_rows;

    // Jika 1 akun yang cocok, maka diloginkan
    if($akunyangcocok == 1) {
        // Menggunakan session untuk menyimpan informasi login
        session_start();
        
        // Ambil data user dari hasil query
        $user_data = $ambil->fetch_assoc();

        // Simpan data user ke dalam session
        $_SESSION['username'] = $user_data['username'];
        
        // Redirect ke halaman setelah login
        header("Location: halaman_setelah_login.php");
        exit(); // Penting untuk menghentikan eksekusi script setelah redirect
    } else {
        // Jika tidak ada akun yang cocok, berikan pesan error atau tindakan lainnya
        echo "Username atau password salah.";
    }
}
?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>