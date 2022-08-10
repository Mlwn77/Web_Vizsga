<?php

// Munkamenet indítása

  session_start();
  $_SESSION = array();
  // A felhasználóhoz kapcsolódó összes munkamenet megsemmisítése

  session_destroy();
  // Átirányítás a login.php oldalra

  header('location: login.php');
  exit;
