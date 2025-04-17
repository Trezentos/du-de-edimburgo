<?php
$pg = $_SEO["permalink"];
?>

<footer class="waypoint animation_bottom " id="contato">
    <img src="<?=IMG.'gessele-empreendimentos.svg'?>" alt="">
</footer>

<div class="quax-assinatura waypoint animation_bottom">
    <a class="logo-quax" href="https://quax.com.br" target="_blank" title="QUAX - Sites & Sistemas">
        <div class="arrow-up"></div>
        <figure>
            <picture>
                <source srcset="<?=IMG.'quax-light.png'?>" alt="" type="image/png" >
                <img 	src="<?=IMG.'quax-light.webp'?>" alt="" type="image/webp" >
            </picture>
        </figure>
    </a>
</div>

<?php echo javascript_enqueue('home', 'return'); ?>


<!-- INSERT CODE BODY -->

</div> <!-- /CLOSE SCROLL-CONTENT -->
</main> <!-- /MAIN -->
</body>
</html>