<?php

	if ($titulo == 'Coberturas duplex') {
		$titulo = 'COBERTURAS';
	}
	else if ($titulo == 'Diferenciados') {
		$titulo = 'DIFERENCIADOS';
	} 
	else {
		$titulo = 'TIPOS';
	}


?>


<div class="residence-slider-section pb90 pb180-mobile bg-white waypoint animation_bottom">
	<div class="wrap ">
		

		<div class="tipos-container mt120 mt30-mobile">
			<h2 class="mb40-mobile"><?= $titulo ?></h2>

			<div class="tipos-descriptions">
				<?php foreach($comodos as $comodo){ ?>
					<?php if ($comodo) { ?>
						<p><?= $comodo;?></p>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="wrap wide pr0-mobile pl0-mobile mt40-mobile">

		<div class="sliders-container">
			<div 
				class="is-relative owl-carousel owl-theme empreendimento-slider" 
			>
				<?php foreach($qBanners as $qBanner){ ?>
					<div class="item">
						<a 
							href="<?=verifySafariImgType(HTTP_UPLOADS_IMG.'lg-'.$qBanner->imagem_desktop); ?>" 
							class="fancybox" 
							data-fancybox="<?=$permalink.'-galeria'; ?>" 
						>
							<img src="<?=verifySafariImgType(HTTP_UPLOADS_IMG.(!$MOBILE?$qBanner->imagem_desktop:$qBanner->imagem_mobile)); ?>" alt="">
						</a>
					</div>
				<?php } ?>	
			</div>
		</div>
	</div>
</div>