<?php

  require_once 'config/config.php';

  $fnev = $jelszo = $confirm_jelszo = "";
  $fnev_err = $jelszo_err = $confirm_jelszo_err = "";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (empty(trim($_POST['fnev']))) {
          $fnev_err= "ADD megy a felhasznalonevedet.";
      } else {
          $sql = 'SELECT id FROM felhasznalok WHERE fnev = ?';

          if ($stmt = $db->prepare($sql)) {
              $param_fnev = trim($_POST['fnev']);
              $stmt -> bind_param('s', $param_fnev);

              if ($stmt->execute()) {
                  $stmt ->store_result();

                  if ($stmt ->num_rows == 1) {
                      $fnev_err= "Ez a felhasznalonev már foglalt.";
                  } else {
                      $fnev = trim($_POST['fnev']);
                  }
              } else {
                  echo "Valami hiba van próbáld meg ójra";
              }
          } else {
              $db->close();
          }
      }
      if (empty(trim($_POST['jelszo']))) {
          $jelszo_err = "Adjon meg egy jelszot!";
      } elseif (strlen(trim($_POST['jelszo'])) < 6) {
          $jelszo_err = "Jelszónam min 6 karakternek kell lenie!";
      } else {
          $jelszo = trim($_POST['jelszo']);
      }
      if (empty(trim($_POST['confirm_jelszo']))) {
          $confirm_jelszo_err = "Erositse meg a jelszavat.";
      } else {
          $confirm_jelszo = trim($_POST['confirm_jelszo']);
          if (empty($jelszo_err) && ($jelszo!=$confirm_jelszo)) {
              $confirm_jelszo_err = "A két jelszo nem eggyezik.";
          }
      }
      if (empty($fnev_err) && empty($jelszo_err) && empty($confirm_jelszo_err)) {
          $sql = 'INSERT INTO felhasznalok (fnev, jelszo, jog) VALUES (?,?,3)';
          if ($stmt = $db->prepare($sql)) {
              $param_fnev = $fnev;
              $param_jelszo = password_hash($jelszo, PASSWORD_DEFAULT);

              $stmt -> bind_param('ss', $param_fnev, $param_jelszo);
              if ($stmt -> execute()) {
                  header('location: ./login.php');
              } else {
                  echo "Valami hiba van probálja meg újra.";
              }

              $stmt->close();
          }
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
      <title>Regisztracio</title>
    </head>
    <body>
      <main>
        <section class="container formazas">
          <h2 class="display-4 pt-3">Regisztracio</h2>
          <p class="text-center">Add meg a Hitelesítő adataid.</p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="form-group">
              <label for="fnev">felhasznalonev:</label>
              <input type="text" name="fnev" id="fnev" value="<?php echo $fnev; ?>" class="form-control">
              <span><?php echo $fnev_err; ?></span>
            </div>
            <div class="form-group">
              <label for="jelszo">Jelszo:</label>
              <input type="password" name="jelszo" id="jelszo" value="<?php echo $jelszo; ?>" class="form-control">
              <span><?php echo $jelszo_err; ?></span>
            </div>
            <div class="form-group">
              <label for="confirm_jelszo">Jelszó megerősítés:</label>
              <input type="password" name="confirm_jelszo" id="confirm_jelszo" value="<?php echo $confirm_jelszo; ?>" class="form-control">
              <span><?php echo $confirm_jelszo_err; ?></span>
            </div>
            <div class="form-group">
              <input type="submit" name="Regisztracio" class="btn btn-block btn-outline-success">
              <input type="reset" name="Rorles" class="btn btn-block btn-outline-primary">
            </div>
            <p>Van már fiokod? <a href="login.php">Jelentkezz be</a></p>

          </form>
        </section>
      </main>
    </body>
  </html>
