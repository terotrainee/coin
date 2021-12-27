<!doctype html>
<!--
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->

<p>haetaan suurin vaihtopäivä</p>
    <form action="index.php?page=volume" method="post">
        <input type="date" name="alku" required/>
        <input type="date" name="loppu" required/>
        <button id="paiva" value="submit">anna päivämääräväli</button>
    </form>

<?php if(isset($paiva)){ ?>
     
<div class="tulos">

    <p>suurin vaihtopäivä on <?=$vaihtopaiva?></p>
    <p>ja arvo on <?=$maxpaiva?> eur</p>
</div>
<?php }
if(isset($error)){ ?>
     
<div class="tulos">

    <p><?=$error?></p>

</div>
<?php }
