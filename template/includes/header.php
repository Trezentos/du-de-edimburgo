<?php

$pg = $_SEO["permalink"];

?>
<!doctype html>
	<html class="no-js" lang="pt-BR">
	<head>
		<?php if(!LOCALHOST && !IS_LIGHTHOUSE) { // ANALYTICS ?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_ANALYTICS; ?>"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', '<?php echo GOOGLE_ANALYTICS; ?>');
		</script>

		<?php } ?>

		<title><?php echo $_SEO["title"]; ?></title>

		<!-- METATAGS -->
		<meta charset="utf-8" />
		<meta name="title" content="<?php echo $_SEO["title"]; ?>">
		<meta name="description" content="Um oásis para toda a família acima de tudo." />

		<link rel="canonical" href="<?php echo PageCanomical()?>" />
		<link rel="stylesheet" href="https://use.typekit.net/bav3jmn.css">
        <link rel="stylesheet" href="https://use.typekit.net/jqb8zsp.css">

		<!-- FONTS -->
      <link rel="stylesheet" href="https://use.typekit.net/oed1sjk.css">




		<!-- MOBILE -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
		<meta name="mobile-web-app-capable" content="yes" />
		<meta name="format-detection" content="telephone=no">
		<meta name="Author" content="Quax - Sites & Sistemas (www.quax.com.br)" />

		<!-- ICONS -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo IMG ?>favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo IMG ?>favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo IMG ?>favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo IMG ?>favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo IMG ?>favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo IMG ?>favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo IMG ?>favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo IMG ?>favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo IMG ?>favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo IMG ?>favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo IMG ?>favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo IMG ?>favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo IMG ?>favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo HTTP ?>/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo IMG ?>favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">



		<meta property="og:site_name" content="<?php echo EMPRESA ?>">

		<?php if($_SEO["ativarTag"]){ ?>
		<meta property="og:title" content="<?php echo $_SEO["title_share"]; ?>">
		<meta property="og:image" content="<?php echo IMG; ?>favicon/apple-icon-152x152.png">
		<meta property="og:image:type"   content="image/jpeg">
		<meta property="og:image:width"  content="150">
		<meta property="og:image:height" content="150">
		<meta property="og:description"  content="<?php echo $_SEO["desc_share"]; ?>">
		<meta property="og:type" content="website">
		<?php }else{ ?>
			<meta property="og:image" content="<?php echo IMG; ?>favicon/apple-icon-152x152.png">
			<meta property="og:image:type" content="image/png">
		<?php } ?>

		<script>const HTTP 		= "<?php echo HTTP ?>"</script>
		<script>const PAGE 		= "<?php echo $pg ?>"</script>
		<script>const IS_MOBILE = "<?php echo $MOBILE ?>"</script>
		<script>const IS_TABLET = "<?php echo $TABLET ?>"</script>
	
		
  		<?php echo style_enqueue('home','return'); ?>


		<!-- INSERT CODE HEAD -->
		<?php if( !IS_LIGHTHOUSE ) echo $qConfig->incorporar_head; ?>

        <script type="importmap">
            {
              "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@v0.149.0/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@v0.149.0/examples/jsm/"
              }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

	</head>

<body id="topo">
<!-- MAIN -->
<main class="smooth-scroll-container">
    <div class="smooth-scroll-content">

	<header id="topo" class="pt50 pb50 pt30-tablet pb30-tablet pt40-mobile pb20-mobile ">

		<div class="wide-full">

			<nav class="is-relative" role="navigation" aria-label="main navigation">

				<div class="columns is-gapless is-mobile">

					<div class="column is-hidden-mobile">
						<nav class="links waypoint animation_left">
                            <ul>
                                <li><a target="_blank" href="https://www.gesseleempreendimentos.com.br/">A GESSELE</a></li>
                                <li><a target="_blank" href="https://www.gesseleempreendimentos.com.br/empreendimentos/">NOSSOS EMPREENDIMENTOS</a></li>
                            </ul>
                        </nav>
					</div>


					<div class="column is-3-desktop has-text-centered">
                        <img src="<?=IMG.'main-logo.svg'?>" class="waypoint animation_bottom main-logo" alt="">
					</div>

			
					<div class="column "
                    >
                        <div class="button-container waypoint animation_right">
                            <a href="https://api.whatsapp.com/send?phone=5547992452661&amp;text=Ol%C3%A1%20(%20Contato%20do%20site%20)" target="_blank" title="<?=EMPRESA?>" class="logo btn is-hidden-mobile">
                                <img src="<?=IMG.'icons/whats-icon.svg'?>" class="whats-icon is-hidden-tablet-only" alt="">
                                Fale com o comercial
                            </a>

                            <a href="<?=HTTP?>" title="<?=EMPRESA?>" class="logo btn is-hidden-tablet">
                                Consulte
                            </a>
                        </div>
					</div>

				</div>
			
			</nav>

		</div>

	</header>









	<div class="menu waypoint animation_bottom" >
		<div class="wrap">

			<img class="bt-close-menu waypoint animation_scale" src="<?=IMG?>icons/close.svg" alt="Fechar">

			<div class="container-menu has-text-centered">

				<ul class="waypoint animation_right_dd1">
					<li> <a href="#o-condominio"  		class="menu-item smooth-scroll-link">O Condomínio</a></li>
					<li> <a href="#lotes" 		class="menu-item smooth-scroll-link">Lotes</a></li>
					<li> <a href="#galeria" class="menu-item smooth-scroll-link">Galeria</a></li>
					<li> <a href="#casas" 		class="menu-item smooth-scroll-link" >Casas</a></li>
					<li> <a href="#balneario-camboriu" 		class="menu-item smooth-scroll-link" >Balneário Camboriú</a></li>
					<li> <a href="#wzx" 	class="menu-item smooth-scroll-link" >WZX e Horizontes Urbanismo</a></li>
					<li> <a href="#contato"  class="smooth-scroll-link menu-item">CONTATO</a></li>

				</ul>

			</div>

		</div>
	</div>

