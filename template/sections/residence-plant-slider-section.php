<div class="residence-plant-slider-section bg-white mb150" id="diferenciados">
	<div class="wrap">
		<div class="plantas-nav mb50 pl90 pr90 pl80-tablet pr80-tablet pl0-mobile pr0-mobile waypoint animation_bottom" id="plantas-nav-<?=$permalinkApartamento; ?>">
        <?php foreach($qPlantas as $qPlanta){ ?>
			<a><?= $qPlanta->titulo; ?></a>
        <?php } ?>

		</div>
		<div 
			class="plantas-slide cycle-slideshow waypoint animation_bottom" 
			data-cycle-slides=".li" 
			data-cycle-timeout="0" 
			data-cycle-log="false" 
			data-cycle-pager="#plantas-nav-<?=$permalinkApartamento;?>"
    		data-cycle-pager-template=""
    	>
            <?php foreach($qPlantas as $qPlanta){ ?>
				<div class="li">

					<div class="columns is-multiline">
						<div class="column is-9 leg mt10 pl20-tablet pr20-tablet pl110 pl20-mobile pr20-mobile color-primary font-primary waypoint animation_left_dd1">
							<?= $qPlanta->quartos; ?>
							<?php if ($qPlanta->quartos && $qPlanta->metragem) { ?>
								<span class="is-hidden-mobile" >|</span>
								<br class="is-hidden-tablet">
							<? } ?>
							<strong><?= $qPlanta->metragem; ?></strong>
						</div>
						<div class="column is-3 side-icons has-text-centered waypoint animation_right_dd1 is-relative">
							<img src="<?= IMG.'icons/compass.svg'; ?>" class="compass-img is-hidden-mobile" >
						</div>

						<div class="column is-12">
							<div class="box-img">
								<a href="<?= verifySafariImgType(HTTP_UPLOADS_IMG.(!$MOBILE ?'big-': 'vertical-big-').$qPlanta->imagem_planta); ?>" data-fancybox="<?=$permalinkApartamento.'-planta'; ?>" data-caption="<?= $qPlanta->titulo; ?>">
									<img src="<?= verifySafariImgType(HTTP_UPLOADS_IMG.(!$MOBILE ?'thumb-': 'vertical-thumb-').$qPlanta->imagem_planta); ?>" alt="planta">
								</a>
								<p class="is-hidden-tablet">MONT BLANC RESIDENCE</p>
								
								<img src="<?= IMG.'icons/compass-side.svg'; ?>" class="compass-img-mobile is-hidden-tablet" >
							</div>
						</div>
					</div>
				</div>
            <?php } ?>
		</div>
	</div>
</div>

