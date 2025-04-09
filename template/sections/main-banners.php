<?php


?>

<!-- BANNER -->
<section class="main-banners animation_top animated">
	<div 
		class="cycle-slideshow" 
		data-cycle-slides=".li" 
		data-cycle-timeout="11500" 
		data-cycle-pause-on-hover="false" 
		data-cycle-log="false"
		data-cycle-speed="1000"
		data-cycle-pager="false"
	>
		<div class="cycle-pager waypoint animation_scale animated"></div>

		<?php foreach($qBanners as $qBanner) { ?>
            <div class="li" style="background-image: url(<?=verifySafariImgType(HTTP_UPLOADS_IMG.(!$MOBILE?$qBanner->imagem_desktop:$qBanner->imagem_mobile), 'jpg'); ?>); ">

                <div class="text-container columns is-gapless">
                    <div class="column is-1-widescreen is-1-tablet is-hidden-mobile"></div>
                    <div class="column is-5-widescreen is-5-tablet is-12-mobile is-relative animation_top_d1 animated">

                    </div>

                    <div class="column is-6-widescreen is-hidden-mobile"></div>
                </div>
            </div>
		<?php } ?>
	</div>
</section>