<?php

# Apartamentos --------------------------------------------------------------------------------------------------- 
$qApartamentos = $db->get_results("SELECT * FROM ".$tables['EMPREENDIMENTOS']." WHERE status=1 ORDER BY ordem ASC");

# BANNERS
$qBanners = $db->get_results("SELECT * FROM ".$tables['BANNERS']." WHERE status=1 ORDER BY ordem ASC");


# BANNERS MEIO
$qGaleria = $db->get_results("SELECT * FROM ".$tables['GALERIA_IMG']." ORDER BY ordem ASC");

global $MOBILE;
                                    
# -----------------------------------------------------------------------------------------------------------------


# ADD JS + CSS EXTRA
if( !IS_LIGHTHOUSE )
{
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
		'progress-item.js',
		'parallax.js',
        !$MOBILE ? 'smooth-scroll.js' : '',


	]);
}


get_header();
?>




<section class="metric-section is-relative">
    <img src="<?=IMG.'planta-white-background.svg'?>" class="planta-background" alt="">
    <div class="wrap">
        <div class="container">
            <h2 class="title primary-font-semicondensed">
                Ambientes nobres para um <br>
                <span class="secondary-font">Família Real.</span>
            </h2>

            <div class="tipos-container">
                <div class="tipo-box">
                    <p class="big">Tipo 1</p>
                    <img src="<?=IMG.'icons/map-left.svg'?>" alt="">
                    <p class="description primary-font-condensed">
                        140,36 m² | 3 suítes <br>
                        2 vagas
                    </p>
                </div>

                <div class="tipo-box">
                    <p class="big">Tipo 2</p>
                    <img src="<?=IMG.'icons/map-right.svg'?>" alt="">
                    <p class="description primary-font-condensed">
                        141,81 m² | 3 suítes <br>
                        2 vagas
                    </p>
                </div>
            </div>

            <p class="secondary-font">O luxo feito sob medida para você.</p>
        </div>


    </div>
</section>

<section>
      <div class="wrap">
          <div class="container">
              <div class="left-content">
                  <img src="<?=IMG.'icons/philip-duque-icon.svg'?>" alt="">
              </div>
              <div class="right-content">
                  <img src="<?=IMG.'philip-duque-familia.jpg'?>" alt=""></img>
              </div>
          </div>
      </div>
</section>

<?php get_footer(); ?>