<?php 

$count = 0;


foreach ($qApartamentos as $qApartamento) { 
    
    $qBanners = $db->get_results("SELECT * FROM ".$tables['EMPREENDIMENTOS_BANNERS']." WHERE id_empreendimento='".$qApartamento->id."' AND status='1' ORDER BY ordem ASC");
    $qPlantas = $db->get_results("SELECT * FROM ".$tables['EMPREENDIMENTOS_PLANTAS']." WHERE id_empreendimento='".$qApartamento->id."' AND status='1' ORDER BY ordem ASC");
    $qBannersArray=[];
	$qLgImages= [];

    foreach ($qBanners as $qBanner) {
    	array_push($qBannersArray, HTTP_UPLOADS_IMG.(!$MOBILE?$qBanner->imagem_desktop:$qBanner->imagem_mobile));
	}

    
?>

<section class="bg-white accordeon-container disable-animation-smartphone" data-min-height-accordeon="200px" data-acordeon-index="<?=$count++; ?>" id="<?= $qApartamento->permalink.'-section'; ?>">
	<div class="line waypoint animation_elastic_transformed"></div>
	<div class="head accordeon-btn  wrap column is-12 is-flex is-justify-content-space-between is-align-items-center ">

		<img class="fachada is-hidden-mobile header-img " src="<?=IMG?>icons/mont-blanc-gray.svg" alt="<?=EMPRESA?>">
		<h2 class="waypoint animation_bottom"><?= $qApartamento->titulo; ?></h2>
		<img class="fachada is-hidden-mobile header-img " src="<?=IMG?>icons/gwp-logo-gray.svg" alt="<?=EMPRESA?>">
		<div class="accordeon-functions ">
			<h3 class="waypoint animation_bottom_d1">Clique para conhecer <?= $count == 3 ? 'as ' : 'os ' ?>  <?= $qApartamento->titulo; ?></h3>
			<img class="acordeon-btn-img waypoint animation_bottom_d3" src="<?=IMG?>icons/plus.svg" >
		</div>
	</div>
    <?php residenceSlider(
		$qApartamento->permalink,
		[	
			$qApartamento->caracteristica_1, $qApartamento->caracteristica_2,
			$qApartamento->caracteristica_3, $qApartamento->caracteristica_4,
			$qApartamento->caracteristica_5, $qApartamento->caracteristica_6,
		],
		$qBanners,
		$qApartamento->titulo
	) ?>	

	<?php residencePlants(
		$qPlantas,
		$qApartamento->permalink
	) ?>
		

</section>
<?php }?>
