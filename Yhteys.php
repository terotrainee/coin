<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description
 *
 * @author Käyttäjä
 */
class Yhteys {
    private $alku;
    private $loppu;
    private $aika = 0;


    public function __construct($alku, $loppu) {
        $this->alku = $alku;
        $this->loppu = $loppu;
    }
    public function yhteys($taulunimi){
        
        $url = "https://api.coingecko.com/api/v3/coins/bitcoin/market_chart/range?vs_currency=eur&from=$this->alku&to=$this->loppu";
        $pyynto = curl_init($url);
        curl_setopt($pyynto, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($pyynto, CURLOPT_HEADER, 0);
        $data = curl_exec($pyynto);
        curl_close($pyynto);
        $taulu = json_decode($data, $assoc = TRUE);
       
        $array = $taulu[$taulunimi];
        return $array;
    }
    public function tarkistaPaiva() {
        if ($this->loppu < $this->alku) {
            return 'loppupäivä on ennen alkupäivää';
        }
        if ($this->alku === $this->loppu - 3600) {
            return 'annatko pidemmän aikavälin';
        }
            
    }
    //Tarkistetaan aikaväli ja palautetaan taulukko kokonaan tai rajattuna
    public function rajaa($taulu) {
        $aikataulu = [];
        if (($this->loppu - $this->alku)/86400 > 90) {                          
            foreach ($taulu as $value) {
                array_push($aikataulu, ['paiva' => $value[0], 'arvo' => $value[1]]);
            }
            }
        else {
        array_push($aikataulu, ['paiva'=>$taulu[0][0], 'arvo'=>$taulu[0][1]]);  //eka muistiin
        $this->alku += 86400;                                                   //lisätään päivä
        foreach ($taulu as $key => $value)
        {
            $this->aika = round($value[0] / 1000);
            
            if ($this->aika > $this->alku) {                                    //jos on menty ohi eli ollaan
                                                                                //seuraavan päivän puolella
                array_push($aikataulu, ['paiva' => $value[0],'arvo' => $value[1]]);
            
                $this->alku += 86400;
            }
            
        }
        }
        return $aikataulu;
    }
}
