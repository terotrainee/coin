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
        $array = $hae->yhteys('total_volumes');
        
        if (isset($array)){
        $aikataulu = $hae->rajaa($array);
        $max = 0;
        $paiva = 0;

        foreach ($aikataulu as $key => $value) {
            if ($value['arvo'] > $max) {                            //verrataan arvo
                $paiva = $value['paiva'];                           //ja laitetaan arvo ja päivä muistiin
                $max = $value['arvo'];
            }
        }
        $vaihtopaiva = date('d m o', round($paiva/1000));
        $maxpaiva = round($max, 2);
        }
        else {
            $error = 'ei yhteyttä';
        }
        }
}
$title = 'volume';
