<!doctype html>
<!--
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->

<p>haetaan sopivat päivät kaupankäynnille</p>
    <form action="index.php?page=saleday" method="post">
        <input type="date" name="alku" required/>
        <input type="date" name="loppu" required/>
        <button id="paiva" value="submit">anna päivämääräväli</button>
    </form>
<div class="tulos">
<?php if (isset($laskuviesti)) { ?>
    <p><?=$laskuviesti?></p>
<?php }
 else {
if(isset($paivat)){

    if($ostopaiva !=0){?>
    <p>paras ostopäivä on <?=$ostopaiva?></p>
    <?php }
    else { ?>
    <p>parasta ostopäivää ei löydy</p>
    <?php }
    if ($myyntipaiva !=0) { ?>
    <p>paras myyntipäivä on <?=$myyntipaiva?></p>
    <?php }
    else { ?>
    <p>parasta myyntipäivää ei löydy</p>
    <?php }   
    }
    }
if(isset($error)){ ?>

    <p><?=$error?></p>

<?php } ?>
</div>