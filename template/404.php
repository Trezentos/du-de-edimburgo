<?php
$permalink = "page-404";

get_header(); ?>

<br><br><br>

<div class="text page-wrap has-text-centered marginTopHead">
	<h1>Erro 404</h1>
	<br><br><br>
	<h3>Página não encontrada! (<strong><?php echo $pagina; ?></strong>)</h3>
	<br>
	<p>Desculpe, parece que a página que você estava procurando não existe mais ou pode ter sido movida.</p>
	<br><br>
	<ul>
		<li><a href="<?=HTTP?>" style="color:#000" title="Página inicial"><h4>PÁGINA INICIAL</h4></a></li>
		<li><a href="<?=HTTP?>contato/" style="color:#000" title="Entre em contato"><br><h4>CONTATO</h4></a></li>
	</ul>
</div>

<br><br>
<?php get_footer(); ?>