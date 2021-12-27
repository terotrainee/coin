<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<p>haetaan pisin laskukausi</p>
    <form action="index.php?page=lasku" method="post">
        <input type="date" name="alku" required/>
        <input type="date" name="loppu" required/>
        <button id="paiva" value="submit">anna päivämääräväli</button>
    </form>
        
<?php if(isset($tulos)){ ?>
<div class="tulos">
<?php if ($maxmaara == 0) { ?>
    <p>annetulla aikavälillä ei ole laskusuhdannetta</p>
<?php }
else { ?>
    <p>pisin laskukausi on <?=$maxmaara?> päivää</p>
    <p>alkaen <?=$alkupaiva?></p>
</div>
<?php }}
if (isset($error)) { ?>
<div class="tulos">
    <p><?=$error?></p>
</div>
<?php }
