<?php
	$q = $db->get_row("SELECT * FROM ".$tables['ANDAMENTO_OBRA']." WHERE id='1'");

    $aEstagiosObra = [
        'escavacao' 			=> 'Escavação',
        'fundacao' 				=> 'Fundação',
        'estrutura' 			=> 'Estrutura',	
        'alvenaria' 			=> 'Alvenaria',
        'acabamento_externo' 	=> 'Acabamento Externo',
        'acabamento_interno' 	=> 'Acabamento Interno',
    ];

    $date = new DateTime($q->atualizacao_obra);

    $formattedDate = $date->format('j \d\e F \d\e Y');

    $monthTranslations = array(
        'January' => 'janeiro',
        'February' => 'fevereiro',
        'March' => 'março',
        'April' => 'abril',
        'May' => 'maio',
        'June' => 'junho',
        'July' => 'julho',
        'August' => 'agosto',
        'September' => 'setembro',
        'October' => 'outubro',
        'November' => 'novembro',
        'December' => 'dezembro',
    );

    $formattedDate = strtr($formattedDate, $monthTranslations);
?>


<section class="andamento-obra-container">
    <div class="wrap">
        <h1>Estágio <br class="is-hidden-tablet"> de Obras</h1>

        <div class="stages is-mobile">

            <?php foreach($aEstagiosObra as $legenda => $valor) { ?>
                <div class="waypoint animation_left circular-progress-container">
                    <svg width="140" height="140" viewBox="0 0 250 250"
                    class="circular-progress waypoint rounded_animation" data-percentTo="<?=$q->{$legenda};?>"
                    >
                        <circle class="bg"></circle>
                        <circle class="fg"></circle>
                        <circle class="ring"></circle>
                        <image x="50%" y="35%" width="50" height="50"  class="<?=$legenda?>"
                            xlink:href="<?=IMG.'icons/andamento-obra/'.$legenda.'.svg' ?>" 
                            transform="translate(-23,-20)"
                        />
                        <text x="51%" y="65%" text-anchor="middle" dy=".3em" font-size="45" fill="#000">
                            <?=$q->{$legenda};?>
                        </text>
                    </svg>
                    <h3><?=$valor;?></h3>
                </div>
            <?php } ?>

        </div>

       

        <div class="stage-total is-relative">
        
            <h2 class="waypoint animation_left ">ESTÁGIO TOTAL DA OBRA</h2>
            
            <hr class="waypoint animation_elastic_d1 is-hidden-mobile">
            
            <h1 class="waypoint animation_left_d3"><?=$q->total; ?></h1>

            <p class="waypoint animation_left_d2"><?='Última atualização '.$formattedDate; ?></p>
        </div>
    </div>
</section>
