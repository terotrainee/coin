<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST['alku'])) {
    date_default_timezone_set('UTC');
    $alku = htmlspecialchars($_POST['alku']);
    $loppu = htmlspecialchars($_POST['loppu']);
    $unalku = strtotime($alku);
    $unloppu = strtotime($loppu);
    $unloppu += 3600;
    
    $hae = new Yhteys($unalku, $unloppu);
    $error = $hae->tarkistaPaiva();
    if (!$error) {
    $array = $hae->yhteys('prices');
    if (isset($array)) {
    $aikataulu = $hae->rajaa($array);
    
    $resarray = new Taulu($aikataulu);
    $taulu = [];
    $arvo = $aikataulu[0]['arvo'];                  //laitetaan ensimmäinen arvo
    $laskukausi = TRUE;                             //onko pelkkää laskua
    
    foreach ($resarray as $key => $value) {
        if ($value['arvo'] < $arvo) {
           $resarray->laitaLasku();
        }
        if ($value['arvo'] > $arvo) {
            $laskukausi = FALSE;                     //löytyi suurempi arvo ei laskukausi
            $resarray->laitaNousu();
    }
    $arvo = $value['arvo'];                         //laitetaan edellinen arvo muistiin
    }
    $resarray->vertaaLoppu();                       //tarkistetaan viimeinen päivä

    if($laskukausi) {
        $laskuviesti = 'aikaväli on pelkkää laskua ei suosituksia';
    }
    else {
    $paivat = $resarray->haePaivat();
    extract($paivat);
    $ostopaiva = date('d m o', round($ostopv/1000));
    $myyntipaiva = date('d m o', round($myyntipv/1000));
    }
    }
    else {
        $error = 'ei yhteyttä';
    }
    }
}
$title = 'saleday';
