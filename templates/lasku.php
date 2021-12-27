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
        
        $haku = new Yhteys($unalku, $unloppu);
        $error = $haku->tarkistaPaiva();
        
        if (!$error) {
        $array = $haku->yhteys('prices');
        if (isset($array)) {
        $aikataulu = $haku->rajaa($array);      
       
        $resarray = new Taulu($aikataulu);
        $tulos = [];
        $arvo = 0;
        foreach ($resarray as $key => $value)
        {                     
            if ($value['arvo'] < $arvo) {                                               //jos uusi arvo on pienempi
                array_push($tulos, ['paiva' => $value['paiva'],'arvo' => $value['arvo']]);//taulukko ei käytössä
                $resarray->laita();                                                     //kasvatetaan määrä
            }
            else {
                $resarray->nollaa();
            }
            $resarray->vertaaMaara();                                                   //verrataan laskun pituus
            $arvo = $value['arvo'];                                                     //laitetaan ed. arvo muistiin
        }
        
        $alkuKesto = $resarray->haeTulos();
        extract($alkuKesto);
        $alkupv = round($alkupv/1000);
        $alkupaiva = date('d m o', $alkupv);
        }
        else {
            $error = 'ei yhteyttä';
        }
    }
}
$title = 'lasku';

