<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?> 

	<!-- título -->    
	<h1><?php echo $titulo ?></h1>

    <a class="btn btn-primary btn-sm" 
        href="<?php echo base_url('index.php/arquivo/novo')?>">
        NOVO</a>
    
    </br>
    </br>

    <!-- tabela -->
    <table class=''>
        <table class="table table-responsive-md table-hover">
            <?php echo $tabela; ?>
        </table>
    </table>

    <!-- botão na horizontal --> 
    <?php echo "<div class='row'>{$botoes}</div>"; ?>