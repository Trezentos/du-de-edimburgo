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

$galerias = $db->get_results("SELECT * FROM  adm_galeria ORDER BY criado ASC");

$galeriaImages = $db->get_results("SELECT * FROM  adm_galeria_imagens ORDER BY ordem ASC");

$itemsTitles = [];

?>

<section class="gallery-section pt110  " id="galeria">
    <div class="wrap ">
        <div class="title-container mb125 is-relative">
            <h2 class="big waypoint animation_left">lazer</h2>
            <div class="image-container">
                <img src="<?= IMG . 'icons/reserva-do-sol-complete-icon.svg ' ?>" class="waypoint animation_bottom_d1"
                     alt="Reserva do Sol Icone">
            </div>
            <h2 class="big waypoint animation_left">6500 m²</h2>
        </div>
        <div class="sliders-container pl50-tablet pr50-tablet">
            <div class="gallery-options  ">

                <div
                        class="owl-carousel owl-theme carousel-buttons is-hidden-tablet "
                >
                    <?php foreach ($galerias as $index => $galeria): ?>
                        <button
                                id="<?= 'galeria-' . $galeria->id ?>"
                                onclick="setCarrouselActive(this)"
                                class="waypoint animation_left gallery-title <?= $index == 0 ? 'active' : '' ?>"
                        >
                            <?=$galeria->titulo?>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div
                        class="is-hidden-mobile options-desktop"
                >
                    <?php foreach ($galerias as $index => $galeria): ?>
                        <button
                                id="<?= 'galeria-' . $galeria->id ?>"
                                onclick="setCarrouselActive(this)"
                                class="waypoint animation_left <?= $index == 0 ? 'active' : '' ?>"
                        >
                            <?= $galeria->titulo ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>


            <div class="all-galleries ">
                <?php foreach ($galerias as $galeria): ?>
                    <div
                            class="owl-carousel owl-theme carousel-galeria"
                            id="<?= 'galeria-' . $galeria->id ?>"
                    >
                        <?php foreach ($galeriaImages as $imagem) : ?>
                            <?php if ($galeria->id != $imagem->id_galeria) continue; ?>
                            <div class="item" style="background-image: url(); ">
                                <a
                                        class="fancybox"
                                        data-fancybox="gallery-image-id-<?= $galeria->id ?>"
                                        data-caption="<?= $imagem->legenda ?>"
                                        href="<?= verifySafariImgType(HTTP_UPLOADS_IMG . 'lg-' . $imagem->arquivo, 'jpg'); ?>"
                                >

                                    <?php if ($imagem->legenda) { ?>
                                        <h2 class="carousel-title"><?= $imagem->legenda ?></h2>
                                    <?php } ?>
                                    <img src="<?= verifySafariImgType(HTTP_UPLOADS_IMG . 'lg-' . $imagem->arquivo, 'jpg'); ?>"
                                         alt="">
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>

                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>