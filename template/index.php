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


<!-- $qBanners -->
<?php include TEMPLATE.'sections/main-banners.php';  ?>



<?php get_footer(); ?>