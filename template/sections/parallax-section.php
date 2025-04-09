<?php 

add_style([
	'css/owl.carousel.min.css', 
	'css/owl.theme.default.min.css', 
	'css/jquery.fancybox.min.css'
]);

add_javascript([
	'owl.carousel.min.js',
	'jquery.maskedinput.js',
	'jquery.cycle2.min.js',
	'jquery.fancybox.min.js',
	'gallery-section.js',
]);
// 520 container
// 774 foto

/*
 * 126
 * 520
 * 126
 * */

?>

<section class="parallax-section  pt0 pb0 pt0-mobile pb0-mobile is-relative" >
    <h2 class="mb100 mb30-mobile mb50-tablet ">
        <span class="waypoint animation_bottom">BALNEÁRIO CAMBORIÚ</span>
    </h2>
	<div class="sliders-container">
		<div 
			class="middle-gallery-carrousel " 
		>
			<a 
				class="fancybox item parallax-container " 
				data-fancybox="middle-galley-carrousel-fancybox" 
				href="<?=verifySafariImgType(IMG.'balneario-camboriu-parallax.webp'); ?>"
				data-caption="Vista de Balneário Camboriú"
			>

                <picture>
                    <source srcset="<?=IMG."balneario-camboriu-parallax-mobile.png"; ?>" media="(max-width: 578px)">
                    <img
                            src="<?=IMG."balneario-camboriu-parallax.webp"; ?>"
                            alt="Balneário Camboriú"
                            class="js-parallax"
                            data-start="<?=$MOBILE ? '3' : '120'?>"
                            data-end="<?=$MOBILE ? '3' : '-120'?>"
                    >
                </picture>

			</a>
			
		</div>
	</div>
</section>