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

?>

<section class="descritive-section bg-secondary pt0 pb0 pt0-mobile disable-animation-smartphone" id="detalhes">
	<div class="wrap wide pl0-mobile pr0-mobile pl0-tablet pr0-tablet  ">
		<div 
			class=" is-relative " 
			
		>
            
			<div class="columns pt0 mb0 is-gapless ">
				<div class="column is-6 is-relative img-container carousel-descritive owl-carousel owl-theme">
					<?php foreach($qBannersDescritivos as $qBanner) { ?>
						<div class="item">
							<a 	
								href="<?=verifySafariImgType(HTTP_UPLOADS_IMG.'lg-'.$qBanner->imagem_desktop, 'jpg');?>"
								class="fancybox " 
								data-fancybox="gallery-descritive" 
								data-caption="Mont Blanc"
							>
								<img 
									class="fachada " 
									src="<?=verifySafariImgType(HTTP_UPLOADS_IMG.(!$MOBILE? $qBanner->imagem_desktop : $qBanner->imagem_mobile ), 'jpg');?>" 
									alt="fachada <?=EMPRESA?>"
								>
							</a>
						</div>
						<?php } ?>
					</div>


				<div class="column is-6 bg-secondary mb0 pb0 is-flex is-align-items-center">
					<div class="fachada-description  ">
						<p>FRENTE MAR</p>
						<p>20 pavimentos</p>
						<p>70,80 METROS DE ALTURA</p>
						<p>52 apartamentos</p>
						<ul>
							<li>4 DIFERENCIADOS</li>
							<li>44 Apartamentos TIPO</li>
							<li>4 Coberturas Duplex</li>
							<li>4 apartamentos por andar</li>
						</ul>
						<p>1 Pavimento Inteiro de Lazer</p>
						<p>Estilo NeoClássico</p>
						<p>2 Elevadores</p>
						<p>2 Frentes -&nbsp;&nbsp;<span>Av. Beira Mar e Rua Minas Gerais.</span></p>
						<p>3 Salas Comerciais</p>						
					</div>
				</div>
			</div>

		
		
			
		</div>
		
	</div>

</section>