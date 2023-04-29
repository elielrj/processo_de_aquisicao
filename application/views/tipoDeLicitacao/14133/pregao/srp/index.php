<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>


<!-- título -->
<h1>
    <?php echo $titulo ?>
</h1>



</br></br>

<!-- tabela -->
<table class=''>
    <table class="table table-responsive-md table-hover">
        <?php 

        foreach($indice_pregao as $item) :
           
        ?>
        
        <tr><td><?php $item ?></td></tr>
        <tr><td><?php $item ?></td></tr>
    </table>
</table>
