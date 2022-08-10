<?php

  require_once 'config/config.php';

  function mindent($db)
  {
      $result = $db->query('SELECT id, nev, marka, ar, kep, leiras FROM termekek ORDER By id DESC');

      $sorok = array();
      while ($sor = $result->fetch_assoc()) {
          $sor_adat = array();
          $sor_adat['id'] = $sor['id'];
          $sor_adat['nev'] = $sor['nev'];
          $sor_adat['marka'] = $sor['marka'];
          $sor_adat['ar'] = $sor['ar'];
          $sor_adat['kep'] = $sor['kep'];
          $sor_adat['leiras'] = $sor['leiras'];
          $sor_adat['kategoria_id'] = $sor['kategoria_id'];
          array_push($sorok, $sor_adat);
      }
      return $sorok;
  }

$response = array();

if ($_POST['akcio'] == 'mindent') {
    $response['lista'] = mindent($db);
} elseif ($_POST['akcio'] == 'beszuras') {
    $nev = $_POST['nev'];
    $marka = $_POST['marka'];
    $ar = $_POST['ar'];
    $kep = $_POST['kep'];
    if (isset($_FILES['kepfile'])) {
        $fileOK = basename($_FILES['kepfile']['name']);
        move_uploadaed_file($_FILES['kepfile']['tmp_name'], 'kepek/' . $fileOK);
    }
    $leiras = $_POST['leiras'];
    $kategoria_id = $_POST['kategoria_id'];

    //  $db->exec();

    $sql = "INSERT INTO termekek(nev, marka, ar, kep, leiras, kategoria_id) VALUES ('$nev', '$marka', '$ar', '$fileOK', '$leiras','$kategoria_id')";
    if ($db->query($sql) === true) {
        echo "siker";
    } else {
        echo "Hiba: " . $sql . "<br>" . $db->error;
    }



    $response['lista']= mindent($db);
} elseif ($_POST['akcio'] == 'torles') {
    $id = $_POST['id'];
    //  $db -> exec("DELETE FROM termekek WHERE id = $id");

    $sql = "DELETE FROM termekek WHERE id = $id";
    if ($db->query($sql) === true) {
        echo "siker";
    } else {
        echo "Hiba: " . $sql . "<br>" . $db->error;
    }


    $response['lista']= mindent($db);
}

echo json_encode($response);
//echo json_encode(array('response'=>$response));
//echo JSON.parse($response);
$db->close();
