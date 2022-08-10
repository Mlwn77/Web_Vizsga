<?php
session_start();
if (!isset($_SESSION['bejelentkezett']) && $_SESSION['bejelentkezett'] !== false) {
    header('location: login.php');
    exit;
}

$katid = isset($_GET['kat']) ? $_GET['kat'] : '';

 ?>
<!DOCTYPE html>
<html lang="hu" dir="ltr">

<head>
  <meta charset="utf-8">
  <script type="text/javascript">
      var kategoria = '<?php echo $katid; ?>';
    </script>
  <title>Telefonos áruház</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="formazas.css">
</head>

<body>
  <header>
    <div class="text-right">
      <a href="logout.php" class="btn btn-success">Kijelentkezes</a>
      <a href="password_reset.php" class="btn btn-warning">Jelszo megváltoztatás</a>
      <?php
         if ($_SESSION['jog'] == 1) {
             echo '<a href="register_admin.php" class="btn btn-primary">Felhasználó hozzáadása</a>';
         }
       ?>
       <?php
          if ($_SESSION['jog'] == 2) {
              echo '<a href="termek.php" class="btn btn-primary">Termék menedzselése</a>';
          }
        ?>
       </div>
       <div class="text-center">
         <h2 class="display-4">Telefonos áruház</h2>
       </div>
  </header>
  <main>
    <div class="container formazas">
        <div class="row">
          <div class="col">
            <a href="index.php" class="btn btn-block btn-outline-primary">Főoldal</a>
          </div>
          <div class="col">
            <a href="termekek.php?kat=0" class="btn btn-block btn-outline-primary">Telefonok</a>
          </div>
          <div class="col">
            <a href="termekek.php?kat=1" class="btn btn-block btn-outline-primary">Kiegészítők</a>
          </div>
          <div class="col">
            <a href="kosar.html" class="btn btn-block btn-outline-primary">Kosár megtekeintése</a>
          </div>
        </div>
        <div class="row" id="termekek"></div>
      </div>
  </main>
  <?php
     if ($_SESSION['jog'] == 2) { ?>
         <script src="termekek_torles.js"></script>
     <?php
   } else { ?>
      <script src="termekek.js"></script>
  <?php }
     ?>

</body>

</html>
