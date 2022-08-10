<?php

function mindent($db)
{
    $valasztott = $_GET['kategoria'];

//    echo '<script language="javascript">';
//    echo 'alert("termékek lekérdezése ok")';
//    echo '</script>';

    $stmt = $db->prepare("SELECT id, nev, marka, ar, kep, leiras FROM termekek WHERE kategoria_id =?");
    $stmt->bind_param("i", $valasztott);
    $stmt->execute();
    $eredmeny = $stmt->get_result();

    $sorok = array();
    while ($sor = $eredmeny->fetch_assoc()) {
        $sor_adat = array();
        $sor_adat['id'] = $sor['id'];
        $sor_adat['nev'] = $sor['nev'];
        $sor_adat['marka'] = $sor['marka'];
        $sor_adat['ar'] = $sor['ar'];
        $sor_adat['kep'] = $sor['kep'];
        $sor_adat['leiras'] = $sor['leiras'];
        //$sor_adat['kategoria_id'] = $sor['kategoria_id'];
        array_push($sorok, $sor_adat);
    }
    return $sorok;
}

require_once 'config/config.php';

$response = array();
//if ($_GET['akcio'] == '4') {
    $response['lista'] = mindent($db);
//}

echo json_encode($response);

$db->close();
