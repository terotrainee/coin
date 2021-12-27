<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../public/coin.css">
        <script src="../js/jquery-3.4.1.js"></script>
        <title><?=$title?></title>
    </head>
    <body>
        <header>
            <h3>Scrooge McDuck's cryptocurrency sovellus</h3>
            <h5><a href="index.php?page=home">home</a></h5>
        </header>
        <main>
            <div class="row">
            <div class="sivu">
                <p style="margin-left: 20px">
                    valitse toiminto
                </p>
                <ul>
                    <li><a href="index.php?page=lasku">etsi laskusuhdanne</a></li>
                    <li><a href="index.php?page=volume">etsi suurin kauppapäivä</a></li>
                    <li><a href="index.php?page=saleday">etsi sopivimmat kauppapäivät</a></li>
                </ul> 
            </div>
            <div class="paa">
           <?php
            require $output;
            ?>
            </div>
            </div>
        </main>        
          
    </body>
</html>
