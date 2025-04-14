<?php

?>

<!-- BANNER -->
<section class="main-banners animation_top animated">
	<div 
		class="cycle-slideshow" 
		data-cycle-slides=".li" 
		data-cycle-timeout="119500"
		data-cycle-pause-on-hover="false" 
		data-cycle-log="false"
		data-cycle-speed="1000"
		data-cycle-pager="false"
	>
		<div class="cycle-pager waypoint animation_scale animated"></div>

<!--		--><?php //foreach($qBanners as $qBanner) { ?>
            <div class="li" style="background-image: url(<?= IMG.'banner.jpg' ?>); ">

                <div class="text-container columns is-gapless">
                    <div class="column is-3-widescreen is-hidden-mobile"></div>

                    <div class="column is-6-widescreen  is-relative animation_top_d1 animated">
                        <div class="oasis-container">
                            <img src="<?=IMG.'oasis-main-text.svg'?>" class="mb70" alt="">
                            <a href="" class="btn is-uppercase mb50">Agendar visita</a>
                            <img src="<?=IMG.'by-gessele.svg'?>" class="mb40" alt="">
                            <img src="<?=IMG.'gessele-marker.svg'?>" alt="">

                        </div>
                    </div>

                    <div class="column is-3-widescreen  is-hidden-mobile"></div>
                </div>
            </div>
<!--		--><?php //} ?>
	</div>
</section>