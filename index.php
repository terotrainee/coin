<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php

final class Index
{
    const DEFAULT_PAGE = 'home';
    const PAGE_DIR = 'templates/';
    const LAYOUT_DIR = 'layout/';

    private static $CLASSES = [
        'Taulu' => '/classes/Taulu.php',
        'Yhteys' => '/classes/Yhteys.php',
        
    ];

 public function init(){
         spl_autoload_register([$this, 'loadClass']);
    }
    public function loadClass($name) {
        if (!array_key_exists($name, self::$CLASSES)) {
            die('Class "' . $name . '" not found.');
        }
        require_once __DIR__ . self::$CLASSES[$name];
    }    
    public function run() {
        
        $this->runPage($this->getPage());    
    }
     private function getPage() {
        $page = self::DEFAULT_PAGE;

        if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
        }
        return $page;
    }
      private function runPage($page) {
        $run = false;
        $title = 'home';
        if ($this->hasScript($page)) {
            $run = true;
            require $this->getScript($page);
        }
        if ($this->hasTemplate($page)) {
            $run = true;
            // data for main template
            $output = $this->getTemplate($page);
           
            require self::LAYOUT_DIR . 'layout.html.php';
        }
        if (!$run) {
            die('Page "' . $page . '" has neither script nor template!');
        }
    }
     private function getScript($page) {
        return self::PAGE_DIR . $page . '.php';
    }

    private function getTemplate($page) {
        return self::PAGE_DIR . $page . '.html.php';
    }

    private function hasScript($page) {
        return file_exists($this->getScript($page));
    }

    private function hasTemplate($page) {
        return file_exists($this->getTemplate($page));
    }
}
$index = new Index();
$index->init();
$index->run();
    