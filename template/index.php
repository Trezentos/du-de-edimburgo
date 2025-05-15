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
//        'ondulating-effect.js',
        'main.js',
//        'glass-animation.js',
        'counting-animation.js',
        !$MOBILE ? 'smooth-scroll.js' : '',
	]);
}


get_header();
?>

<?php include_once  TEMPLATE.'sections/main-banners.php'?>

<section class="features-section">
    <img src="<?=IMG.'planta-background.svg'?>" class="planta-background is-hidden-mobile" alt="">
    <div class="wrap has-text-centered">
        <div class="numbers">
            <div class="number-item waypoint animation_top">
                <strong class="waypoint contador">34</strong>
                <p class="waypoint animation_left">pavimentos</p>
            </div>
            <div class="number-item waypoint animation_top_d1">
                <strong class="waypoint contador" >54</strong>
                <p class="waypoint animation_bottom">apartamentos</p>
            </div>
            <div class="number-item waypoint animation_top">
                <strong class="waypoint contador">02</strong>
                <p class="waypoint animation_right">por andar</p>
            </div>
        </div>

        <div class="features mt70 mb70">
            <div class="feature-item waypoint animation_left">
                <img src="<?=IMG.'icons/beach-icon.svg'?>" alt="">
                <p>
                    300m <br>
                    da praia
                </p>
            </div>

            <div class="feature-item waypoint animation_left_d1">
                <img src="<?=IMG.'icons/wave-icon.svg'?>" alt="">
                <p>
                    Quadra <br>
                    Mar
                </p>
            </div>

            <div class="feature-item waypoint animation_bottom_d2">
                <img src="<?=IMG.'icons/pin-icon.svg'?>" alt="">
                <p>
                    Localização <br>
                    Privilegiada
                </p>
            </div>

            <div class="feature-item waypoint animation_right_d1">
                <img src="<?=IMG.'icons/pier-icon.svg'?>" alt="">
                <p>
                    Próximo ao novo <br>
                    Píer Turístico
                </p>
            </div>

            <div class="feature-item waypoint animation_right">
                <img src="<?=IMG.'icons/lotus-icon.svg'?>" alt="">
                <p>
                    Terraza Rooftpot <br>
                    Wellness

                </p>
            </div>
        </div>

        <a href="https://api.whatsapp.com/send?phone=5547992452661&amp;text=Ol%C3%A1%20(%20Contato%20do%20site%20)" target="_blank" class="btn waypoint animation_bottom">
            SAIBA MAIS SOBRE O EMPREENDIMENTO
        </a>
    </div>


</section>

<section class="short-section">
    <p class="waypoint animation_bottom"><span>Seu refúgio</span> no alto da cidade.</p>
</section>

<section class="gessele-apresenta"
         style="background-image: url(<?=IMG.($MOBILE ? 'gessele-apresenta-background-mobile.jpg' : 'gessele-apresenta-background.jpg')?>)"
>
<!--    <img-->
<!--            src="--><?php //=IMG.($MOBILE ? 'gessele-apresenta-background-mobile.jpg' : 'gessele-apresenta-background.jpg')?><!--"-->
<!--            alt=""-->
<!--    >-->

    <div class="wrap">
<!--        class="background-image"-->
        <div class="container">
            <img src="<?=IMG.'by-gessele-bege.svg'?>" class="by-gessele-img waypoint animation_left" alt="">

            <p class="waypoint animation_left">
                Apresenta <br>
                <strong>Spa Villa & Balmoral House</strong> <br>

                <span class="secondary-font is-hidden-mobile">
                    Um oásis para toda a
                    família acima de tudo.
                </span>
            </p>

            <span class="secondary-font is-hidden-tablet">
                Um oásis para toda a <br class="is-hidden-tablet">
                família acima de tudo.
            </span>

            <div class="glass-container mt60-mobile waypoint animation_bottom">
                <div class="container">
                    <p class="primary-font-condensed">
                        <span class="secondary-font">Balmoral House:</span> <br class="is-hidden-mobile ">
                        Espaço exclusivo, inspirado na residência de <br class="is-hidden-mobile is-hidden-tablet-only">
                        veraneio da realeza britânica, ideal para encontros, <br class="is-hidden-mobile is-hidden-tablet-only">
                        celebrações e momentos  inesquecíveis. <br class="is-hidden-mobile is-hidden-tablet-only">

                        <br class="is-hidden-tablet">
                        Sua casa de campo particular. <br><br>

                        <span class="secondary-font mt20-mobile">
                            Spa Villa:
                        </span> <br class="is-hidden-mobile ">
                        Um refúgio nobre, um espaço wellness exclusivo, <br class="is-hidden-mobile is-hidden-tablet-only">
                        sofisticado e acolhedor, onde o luxo se encontra com <br class="is-hidden-mobile is-hidden-tablet-only">
                        o bem-estar.
                    </p>
                </div>
            </div>

            <span class="secondary-font mt60-mobile sign-title waypoint animation_bottom">Projetos de Spa e Paisagismo assinados.</span>
        </div>
    </div>
</section>




<section class="metric-section is-relative">
    <img src="<?=IMG.'planta-white-background.svg'?>" class="planta-background " alt="">
    <div class="wrap">
        <div class="container">
            <h2 class="title primary-font-semicondensed waypoint animation_bottom">
                Ambientes dignos de uma <br><br class="is-hidden-tablet">
                <span class="secondary-font">Família Real.</span>
            </h2>

            <div class="tipos-container">
<!--                <a-->
<!--                        href="--><?php //= IMG.'planta-1.png'?><!--"-->
<!--                        class="fancybox"-->
<!--                        title="Planta do tipo 1"-->
<!--                        rel="plantas"-->
<!--                        data-fancybox="galeria-apartamento"-->
<!--                        data-caption="Platna do tipo 1"-->
<!--                >-->
                    <div class="tipo-box waypoint animation_left">
                        <p class="big">Tipo 1</p>
                        <img src="<?=IMG.'icons/map-left.svg'?>" alt="">
                        <p class="description primary-font-condensed">
                            140,36 m² | 3 suítes <br class="is-hidden-mobile">
                            2 vagas
                        </p>
                    </div>
<!--                </a>-->
<!--                <a-->
<!--                        href="--><?php //= IMG.'planta-2.png'?><!--"-->
<!--                        class="fancybox"-->
<!--                        title="Planta do tipo 2"-->
<!--                        rel="plantas"-->
<!--                        data-fancybox="galeria-apartamento"-->
<!--                        data-caption="Platna do tipo 2"-->
<!--                >-->
                    <div class="tipo-box waypoint animation_right">
                        <p class="big">Tipo 2</p>
                        <img src="<?=IMG.'icons/map-right.svg'?>" alt="">
                        <p class="description primary-font-condensed">
                            141,81 m² | 3 suítes <br class="is-hidden-mobile">
                            2 vagas
                        </p>
                    </div>
<!--                </a>-->
            </div>

            <p class="secondary-font mt100-mobile waypoint animation_bottom">O luxo feito sob medida para você.</p>
        </div>


    </div>
</section>

<section class="philip-section">
      <div class="wrap wide">
          <div class="container">
              <div class="left-content">
                  <div class="content">
<!--                      <img class="mb30 spin"  src="--><?php //=IMG.'icons/philip-duque-icon.svg'?><!--" alt="">-->
<!--                      --><?php //roundedLog() ?>
                      <div class="rounded-icon waypoint animation_left">
                          <img src="<?=IMG.'rounded-circle.png'?>" alt="" class=" circle spin">
                          <img src="<?=IMG.'rounded-circle-center.png'?>" alt="" class="middle-content">
                      </div>

                      <div class="text-container mt30">
                          <p class="mb30 big waypoint animation_left">
                              <strong>
                                  Inspirado no <br>
                                  <span>Duque de Edimburgo,</span> <br>
                                  Inspirado em Você.
                              </strong>
                          </p>

                          <p class="primary-font-condensed waypoint animation_bottom_d1">
                              <strong style="font-weight: 400;">Philip Duque de Edimburgo</strong> by Gessele é a <br>
                              união entre tradição, inovação e <br>
                              valorização dos momentos em família.
                          </p>
                      </div>
                  </div>
              </div>
              <div class="right-content mt80-mobile waypoint animation_right_d1">
                  <img src="<?=IMG.'philip-duque-familia.jpg'?>" alt="">
              </div>
          </div>
      </div>
</section>

<section class="description-section is-relative">
    <img src="<?=IMG.'planta-white-background.svg'?>" class="planta-background" alt="">

    <div class="wrap">
       <div class="container">
           <h2 class="secondary-font mb20-mobile waypoint animation_left">Um empreendimento nobre</h2>

           <p class="primary-font-condensed waypoint animation_left">

               O novo empreendimento – <strong>Philip Duque de Edimburgo</strong> – é um convite para viver <br>
               em um <strong>verdadeiro oásis</strong> de paz e sofisticação.

               <br><br>
               Inspirado em Balmoral, reflete a harmonia entre a natureza exuberante e o conforto refinado <br>
               da vida em família, <strong>valorizando raízes, conexões e memórias duradouras.</strong> <br style="display: block"><br>
               <br class="is-hidden-tablet" style="display: inline;">
               Na privilegiada <strong>QUADRA MAR</strong>, cada detalhe foi pensado para oferecer uma experiência única de bem-estar.
               <br><br>

               Aqui, o luxo se revela na segurança que acolhe, na tecnologia que simplifica e no design que conecta. <br style="display: block" class="is-hidden-tablet"><br class="is-hidden-tablet" style="display: inline;">
               <br><br>
               <strong>No Terazza, um espaço wellness exclusivo</strong> convida ao relaxamento, com ambientes que elevam os sentidos e oferecem uma
               <br>
               pausa revigorante para corpo e mente, e uma casa de campo, um refúgio exclusivo projetado para a família.

               <br style="display: block">
               <br style="display: block">

               <strong>BEM-ESTAR ELEVADO A UM NOVO PATAMAR. <br class="is-hidden-tablet" style="display: inline;"> UM OÁSIS DE PAZ.</strong>
               <br><br>
           </p>

           <a href="https://api.whatsapp.com/send?phone=5547992452661&amp;text=Ol%C3%A1%20(%20Contato%20do%20site%20)" target="_blank" class="btn green primary-font-condensed mt20 mt40-mobile waypoint animation_bottom_d1">
               DESCUBRA COMO VIVER <br class="is-hidden-tablet">
               UMA VIDA NOBRE
           </a>
       </div>
    </div>
</section>

<section class="localizacao">
    <h2 class="primary-font-semicondensed waypoint animation_top">
        Uma Localização <br>
        <span class="secondary-font ">Exclusiva e  Estratégica</span>
    </h2>


    <div class="map-container">
        <div class="map-overlay"></div>
        <iframe id="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1492.760692680906!2d-48.590836944306815!3d-27.143599130464153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94d8afb7ab34fd9b%3A0xbe7dcfd2bd2380ea!2sAv.%20Nereu%20Ramos%20%26%20Rua%20313-B%20-%20Castelo%20Branco%2C%20Itapema%20-%20SC%2C%2088220-000!5e0!3m2!1spt-BR!2sbr!4v1744655238128!5m2!1spt-BR!2sbr" width="100%" height="800" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<section class="talk-to-us-section has-text-centered ">
    <img src="<?=IMG.'main-logo.svg'?>" class="waypoint animation_top" alt="">

    <p class="mt20 mt70-mobile mb70-mobile mb40 primary-font-condensed waypoint animation_top">Saiba mais sobre o <br class="is-hidden-tablet"> empreendimento.</p>

    <a href="https://api.whatsapp.com/send?phone=5547992452661&amp;text=Ol%C3%A1%20(%20Contato%20do%20site%20)" target="_blank" class="btn primary-font-condensed waypoint animation_bottom">
        CONVERSE COM O NOSSO TIME
    </a>
</section>

<?php get_footer(); ?>