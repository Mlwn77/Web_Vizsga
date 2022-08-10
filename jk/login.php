<?php
// Munkamenet indítása
  session_start();
  // Annak ellenőrzése, hogy a felhasználó már bejelentkezett-e, ha igen, akkor irányítjuk át az üdvözlő oldalra.
  if (isset($_SESSION["bejelentkezett"])&&$_SESSION["bejelentkezett"] === true) {
      header("location: index.php");
      exit;
  }
  // A config file betöltése

  require_once 'config/config.php';
  // Változók definiálása és inicializálása üres értékekkel.

  $fnev = $jelszo = "";
  $fnev_err = $jelszo_err  = "";
  // A kapott űrlapadatok feldolgozása.

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Annak ellenőrzése, hogy a felhasználónév mező üres-e.

      if (empty(trim($_POST['fnev']))) {
          $fnev_err = "Add meg a felhasznaloneved.";
      } else {
          $fnev = trim($_POST['fnev']);
      }
      // Annak ellenőrzése, hogy a jelszó mező üres-e.

      if (empty(trim($_POST['jelszo']))) {
          $jelszo_err = "Add meg a Jelszavad.";
      } else {
          $jelszo = trim($_POST['jelszo']);
      }
      // Hitelesítési adatok érvényesítése

      if (empty($fnev_err) && empty($jelszo_err)) {
          $sql='SELECT id, fnev, jelszo, jog FROM felhasznalok WHERE fnev = ?';

          if ($stmt = $db->prepare($sql)) {
              $param_fnev = $fnev;
              $stmt -> bind_param('s', $param_fnev);

              if ($stmt -> execute()) {
                  $stmt->store_result();
                  // Annak Ellenőrzése, hogy létezik-e felhasználónév.

                  if ($stmt->num_rows == 1) {
                      $stmt->bind_result($id, $fnev, $hashed_jelszo, $jog);
                      if ($stmt->fetch()) {
                          if (password_verify($jelszo, $hashed_jelszo)) {
                              // Munkamenet indítása

                              session_start();
                              // Adatok tárolása.

                              $_SESSION['bejelentkezett']=true;
                              $_SESSION['id']=$id;
                              $_SESSION['fnev']=$fnev;
                              $_SESSION['jog']=$jog;
                              // Átirányítás az üdvözlő oldalra.

                              header('location: index.php');
                          } else {
                              $jelszo_err = "Helytelen jelszó.";
                          }
                      }
                  } else {
                      $fnev_err = "A felhasznalonev nem létezik.";
                  }
              } else {
                  echo "Valami hiba történt, probald ujra.";
              }
              $stmt->close();
          }
          // DB kapcsolat bezárása.

          $db->close();
      }
  }


 ?>

<!DOCTYPE html>
<html lang="hu" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="formazas.css">
    <title>Bejelentkezes</title>
  </head>
  <body>
    <main>
      <section class="container formazas">
        <h2 class="display-4 pt-3">Csak bejelentkezett felhasználóknak elérhető Weboldal</h2>
        <p class="text-center">Add meg az adataid a belépéshez</p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
              <label for="fnev">felhasznalonev</label>
              <input type="text" name="fnev" class="form-control" id="fnev" value="<?php echo $fnev; ?>">
              <span><?php echo $fnev_err; ?></span>
            </div>
            <div class="form-group">
              <label for="jelszo">Jelszó</label>
              <input type="password" name="jelszo" class="form-control" id="jelszo" value="<?php echo $jelszo; ?>">
              <span><?php echo $jelszo_err; ?></span>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-block btn-outline-success" value="belepes">
            </div>
            <p>Nincs Fiokod? <a href="register.php">Regisztrálj</a> </p>
        </form>
      </section>
    </main>
  </body>
</html>
