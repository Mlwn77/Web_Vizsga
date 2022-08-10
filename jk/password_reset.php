<?php
// Munkamenet indítása

session_start();
// Annak ellenőrzése, hogy a felhasználó be van-e jelentkezve, ha nincs, akkor irányítsa át a bejelentkezési oldalra

if (!isset($_SESSION['bejelentkezett']) && $_SESSION['bejelentkezett'] !== false) {
    header('location: login.php');
    exit;
}
// A config file betöltése

require_once 'config/config.php';
// Változók definiálása és inicializálása üres értékekkel.

$new_jelszo = $confirm_jelszo = "";
$new_jelszo_err = $confirm_jelszo_err  = "";
// A kapott űrlapadatok feldolgozása.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Jelszó ellenőrzése

    if (empty(trim($_POST['new_jelszo']))) {
        $new_jelszo_err = "ADJ meg egy ÓJ jelszót!.-..---.-.--.";
    } elseif (strlen(trim($_POST['new_jelszo'])) < 6) {
        $new_jelszo_err = "A Jelszónam legalább 6 kapakterbol kell állnia!!";
    } else {
        $new_jelszo = trim($_POST['new_jelszo']);
    }
    // Jelszó megerősítés ellenőrzése

    if (empty(trim($_POST['confirm_jelszo']))) {
        $confirm_jelszo_err = "Erositsd meg a a jelszavad";
    } else {
        $confirm_jelszo = trim($_POST['confirm_jelszo']);
        if (empty($new_jelszo_err) && ($new_jelszo != $confirm_jelszo)) {
            $confirm_jelszo_err = "A két jelszó nem eggyezik";
        }
    }
    // Beviteli hibák ellenőrzése, mielőtt beszúrnánk az adatbázisba az adatokat.

    if (empty($new_jelszo_err) && empty($confirm_jelszo_err)) {
        $sql = 'UPDATE users SET jelszo = ? WHERE id = ?';
        if ($stmt = $db->prepare($sql)) {
            $param_jelszo = password_hash($new_jelszo, PASSWORD_DEFAULT);
            $param_id = $_SESSION['id'];

            $stmt -> bind_param("si", $param_jelszo, $param_id);

            if ($stmt -> execute()) {
                // A jelszó sikeresen frissítve. A munkamenet törlése, és átirányítás a bejelentkezési oldalra.

                session_destroy();
                header('location: login.php');
                exit;
            } else {
                echo "Valami Hiba van probálkozz újra!";
            }
            $stmt -> claos();
        }
        // Adatbázis lezárása.

        $stmt -> close();
    }
}
 ?>


 <!DOCTYPE html>
 <html lang="hu" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Jelszó változtatás</title>
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="formazas.css">
   </head>
   <body>
     <main>
       <section class="container formazas">
         <h1 class="display-4">Jelszó megvaltoztatása</h1>
         <p>Tötlsed ki az ürlapot:</p>
         <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
           <div class="form-group">
             <label for="new_jelszo">Új Jelszó</label>
             <input type="password" name="new_jelszo" class="form-control" id="new_jelszo" value="<?php echo $new_jelszo; ?>">
             <span><?php echo $new_jelszo_err; ?></span>
           </div>
           <div class="form-group">
             <label for="confirm_jelszo">ÚJelszó megerősítés:</label>
             <input type="password" name="confirm_jelszo" id="confirm_jelszo" value="<?php echo $confirm_jelszo; ?>" class="form-control">
             <span><?php echo $confirm_jelszo_err; ?></span>
           </div>
           <div class="form-group">
             <input type="submit" class="btn btn-block btn-outline-primary" value="Megváltoztatom">
             <a href="welcome.php" class="btn btn-block btn-light">Mégsem</a>
           </div>
          </form>
       </section>
     </main>
   </body>
 </html>
