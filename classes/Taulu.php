<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Taulu
 *
 * @author Käyttäjä
 */
class Taulu implements Iterator{
    private $maara = 0;
    private $maxmaara = 0; 
    private $alku = 0;
    private $ednegpaiva = 0;
    private $seurnegpaiva = 0;
    private $negpaiva;
    private $edposipaiva;
    private $posipaiva;
    private $maxnousu = 0;
    private $position;
    private $array;


    public function __construct($array) {
        $this->array = $array;
    }
    public function next() {
        ++$this->position;
    }
    public function rewind() {
        $this->position = 0;
    }
    public function valid() {
        return isset($this->array[$this->position]);
    }
    public function current() {
        return $this->array[$this->position];
    }
    public function key() {
        return $this->position;
    }
    public function laita() {           
        $this->maara++;   
        }
    public function nollaa() {       
        $this->maara = 0;               
        }
    public function vertaaMaara() {
        if ($this->maara > $this->maxmaara) {                       //verrataan onko päiväjakso pisin
            $this->maxmaara = $this->maara;                         //laitetaan maara muistiin
            $this->alku = $this->position - $this->maara;           //ja laitetaan jakson alku           
        }        
    }
    public function haeTulos() {
        return ['alkupv' => $this->array[$this->alku]['paiva'], 'maxmaara' => $this->maxmaara];
    }
    public function laitaLasku() {
        if ($this->position - $this->negpaiva != 1) {               //jos ei peräkkäiset eli kurssi kääntyy
            $this->edposipaiva = $this->position - 1;               //laskuun laitetaan edellinen arvo muistiin
            $this->vertaaLasku();                                   //että löydetään korkein arvo
            }                                                           
        $this->negpaiva = $this->position;
    }
    public function laitaNousu() {                                  //jos ei peräkkäiset eli kurssi kääntyy
        if ($this->position - $this->posipaiva != 1) {              //nousuun laitetaan edellinen arvo muistiin
                                                                    //että löydetään pienin arvo
            $this->vertaaNousu();
        }
        $this->posipaiva = $this->position;
    }
    // verrataan loppupäivän arvot kumpi negpäivä on pienempi ja onko nousu edellistä suurempi
    public function vertaaLoppu() {
        if ($this->seurnegpaiva > 0) {
            if($this->array[$this->seurnegpaiva]['arvo'] < $this->array[$this->ednegpaiva]['arvo']) {
                $this->ednegpaiva = $this->seurnegpaiva;
            }
        }
        $vertaus = $this->array[$this->position - 1]['arvo'] - $this->array[$this->ednegpaiva]['arvo'];               
        if ($vertaus > $this->maxnousu) {
            $this->edposipaiva = $this->position - 1;
        }
    }
    //verrataan onko pienin arvo edellinen vai sitä edellinen ja verrataan isoin nousu
    public function vertaaLasku() {
        if($this->maxnousu > 0) {
            if($this->array[$this->seurnegpaiva]['arvo'] < $this->array[$this->ednegpaiva]['arvo']) {
                $this->ednegpaiva = $this->seurnegpaiva;
            }
            $vertaus = $this->array[$this->edposipaiva]['arvo'] - $this->array[$this->ednegpaiva]['arvo'];
            if ($vertaus > $this->maxnousu) {
            $this->maxnousu = $vertaus;
            }
        }
        else {
            $this->maxnousu = $this->array[$this->edposipaiva]['arvo'] - $this->array[$this->ednegpaiva]['arvo'];
        }
    }
    //laitetaan muistiin kaksi edellistä pienintä arvoa
    public function vertaaNousu() {
        if ($this->maxnousu > 0) {
            $this->seurnegpaiva = $this->position - 1;
        }
        else {
            $this->ednegpaiva = $this->position - 1;
        }
    }
    public function haePaivat() {
        return ['ostopv' => $this->array[$this->ednegpaiva]['paiva'], 'myyntipv' => $this->array[$this->edposipaiva]['paiva']];
    }
            
}
