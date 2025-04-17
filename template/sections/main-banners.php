<?php

?>

<!-- BANNER -->
<section class="main-banners">
	<div 
		class="cycle-slideshow" 
		data-cycle-slides=".li" 
		data-cycle-timeout="119500"
		data-cycle-pause-on-hover="false" 
		data-cycle-log="false"
		data-cycle-speed="1000"
		data-cycle-pager="false"
	>
<!--		<div class="cycle-pager waypoint animation_scale animated"></div>-->

<!--		--><?php //foreach($qBanners as $qBanner) { ?>
            <div class="li  animation_top animated" style="background-image: url(<?= IMG.'banner.jpg' ?>); ">

                <div class="text-container columns is-gapless is-relative">
                    <div class="column is-12-widescreen  " style="height: 100%;">
                        <div class="oasis-container">
                            <h1 class="mb95 mb50-tablet mb50-mobile">
                                Seu Oásis <br>
                                <span class="secondary-font">acima de tudo</span>
                            </h1>
                            <a href="" class="btn is-uppercase mb50">Agendar visita</a>
                            <img src="<?=IMG.'by-gessele.svg'?>" class="mb40 mb50-mobile" alt="">
                            <img src="<?=IMG.'gessele-marker.svg'?>" alt="">

                        </div>
                    </div>

                </div>
            </div>
<!--		--><?php //} ?>
	</div>
</section>