<?php
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;



# HEADERS
$_header['titulo'] = 'Editar Configurações';
$_header['icon']   = 'cog';


get_header_gestor();
get_barra_header();
?>

<form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
	<div id="buttons">
		<div class="pull-left">
			<button class="btn btn-sm btn-success" type="submit" name="submit"><span class="glyphicon glyphicon-ok"></span> Salvar</button>
		</div>
	</div>

	<ul id="tab-nav" class="nav nav-tabs">
		<li class="<?=($_GET["tab"]==""?"active":""); ?>"><a href="#tab1"  data-toggle="tab">Dados do Site</a></li>
		<li class="<?=($_GET["tab"]=="2"?"active":""); ?>"><a href="#tab2" data-toggle="tab">Envio de E-mails</a></li>
		<li class="<?=($_GET["tab"]=="3"?"active":""); ?>"><a href="#tab3" data-toggle="tab">Analytics e Código Html</a></li>
		<li class="<?=($_GET["tab"]=="4"?"active":""); ?>"><a href="#tab4" data-toggle="tab">Instagram Token</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab1" class="tab-pane <?=($_GET["tab"]==""?"active":""); ?> waypoint animation_bottom animated">

		<fieldset>
		
			<h3>Dados do Site</h3>
			<br>

			<div class="row">
				<div class="form-group col-md-6">
					<label>Título do Site <small>( Usado no título da página - Title )</small></label>
					<input type="text" class="form-control input-sm" name="nome_empresa" required value="<?php echo $q->nome_empresa; ?>" >
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-3">
					<label>Telefone Fixo</label>
					<input type="text" class="form-control input-sm" name="telefone" value="<?php echo $q->telefone; ?>" />
				</div>
				<div class="form-group col-md-3">
					<label>Celular e WhatsApp</label>
					<input type="text" class="form-control input-sm" name="celular" required value="<?php echo $q->celular; ?>" />
				</div>
				<!-- <div class="form-group col-md-3">
					<label>Celular Adicional</label>
					<input type="text" class="form-control input-sm" name="celular2" value="<?php echo $q->celular2; ?>" />
				</div> -->

				<div class="form-group col-md-6">
					<label>Texto Botão WhatsApp</label>
					<input type="text" class="form-control input-sm" name="texto_whatsapp" value="<?php echo $q->texto_whatsapp; ?>" />
				</div>

			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label>E-mail de contato * <!-- ( Utilize a vírgula para separar os e-mails. Exemplo: email@mail.com, email2@mail.com ) --></label>
					<input type="text" class="form-control input-sm" name="email_contato" required value="<?php echo $q->email_contato; ?>" />
				</div>
			</div>

			<br><br>

			<h3>Redes Sociais</h3>
			<br>

			<div class="row">
				<div class="form-group col-md-6">
					<label>INSTAGRAM</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
						<input type="text" class="form-control input-sm" name="instagram" value="<?php echo ($q?$q->instagram:$_POST['instagram']);?>"/>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label>FACEBOOK</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
						<input type="text" class="form-control input-sm" name="facebook" value="<?php echo ($q?$q->facebook:$_POST['facebook']);?>"/>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label>YOUTUBE</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
						<input type="text" class="form-control input-sm" name="youtube" value="<?php echo ($q?$q->youtube:$_POST['youtube']);?>"/>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label>TWITTER</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
						<input type="text" class="form-control input-sm" name="twitter" value="<?php echo ($q?$q->twitter:$_POST['twitter']);?>"/>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label>LINKEDIN</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
						<input type="text" class="form-control input-sm" name="linkedin" value="<?php echo ($q?$q->linkedin:$_POST['linkedin']);?>"/>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label>BEHANCE</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
						<input type="text" class="form-control input-sm" name="behance" value="<?php echo ($q?$q->behance:$_POST['behance']);?>"/>
					</div>
				</div>
			</div>

			<br>

			<input type="hidden" name="id" value="<?php echo ($id?$id:""); ?>" />
			<input type="hidden" name="action" value="<?php echo ($id?'alterar':'adicionar'); ?>" />
		</fieldset>

	</div>




	







	<div id="tab2" class="tab-pane <?=($_GET["tab"]=="2"?"active":""); ?> waypoint animation_bottom animated">
		<h3>Dados de SMTP <small>(E-mail de envio)</small></h3>
		<br>

		<div class="row">
			<div class="form-group col-md-4">
				<label>Servidor de saída</label>
				<input type="text" class="form-control input-sm" name="smtp_host" required value="<?php echo $q->smtp_host; ?>" />
			</div>
			<div class="form-group col-md-1">
				<label>Porta</label>
				<input type="text" class="form-control input-sm" name="smtp_port" required value="<?php echo $q->smtp_port; ?>" />
			</div>
			<div class="form-group col-md-4">
				<label>Nome de usuário</label>
				<input type="text" class="form-control input-sm" name="smtp_user" required value="<?php echo $q->smtp_user; ?>" />
			</div>
			<div class="form-group col-md-3">
				<label>Senha</label>
				<input type="text" class="form-control input-sm" name="smtp_pass" required value="<?php echo $q->smtp_pass; ?>" />
			</div>
			<div class="form-group col-md-12">
				<label>Responder para ( Reply )</label>
				<input type="text" class="form-control input-sm" name="email_reply" required value="<?php echo $q->email_reply; ?>" />
			</div>
		</div>
	</div>













	<div id="tab3" class="tab-pane <?=($_GET["tab"]=="3"?"active":""); ?> waypoint animation_bottom animated">

		<!-- <h3>Inserir código de Widget TradingView - Embed Code</h3>
		<div class="row">
			<div class="form-group col-md-12">
				<textarea class="form-control input-sm" rows="20" name="codigo_widget" placeholder="Cole o código aqui"><?php echo $q->codigo_widget; ?></textarea>
			</div>
		</div> -->

		<h3>Inserir código na tag HEAD <small>(O código será adicionado em todas as páginas.)</small></h3>
		<div class="row">
			<div class="form-group col-md-12">
				<textarea class="form-control input-sm" rows="6" name="incorporar_head" placeholder="Cole o código aqui"><?php echo $q->incorporar_head; ?></textarea>
			</div>
		</div>
		
		<h3>Inserir código na tag BODY <small>(O código será adicionado em todas as páginas.)</small></h3>
		<div class="row">
			<div class="form-group col-md-12">
				<textarea class="form-control input-sm" rows="6" name="incorporar_body" placeholder="Cole o código aqui"><?php echo $q->incorporar_body; ?></textarea>
			</div>
		</div>

		<h3><i class="fa fa-google"></i> Google Analytics</h3>
		<br>

		<div class="row">
			<div class="form-group col-md-3">
				<label>ID de acompanhamento</label>
				<input type="text" class="form-control input-lg" name="google_analytics" value="<?php echo $q->google_analytics; ?>" />
			</div>
		</div>
	</div>









	<div id="tab4" class="tab-pane <?=($_GET["tab"]=="4"?"active":""); ?> waypoint animation_bottom animated">
		<h3><i class="fa fa-instagram"></i> Token de acesso</h3>
		<div class="row">
			<div class="form-group col-md-12">
				<textarea class="form-control input-sm" rows="2" name="instagram_token" placeholder="Cole o código aqui"><?php echo $q->instagram_token; ?></textarea>
			</div>
		</div>


		<div class="row">
            <div class="col-md-12">
                <h4>Ajuda</h4>
                <div class="well">
                    <div class="col">
                        <style>
	                        details {
	                            cursor: pointer;
	                            /*font-size: 16px;*/
	                        }

	                        details:hover { opacity: 0.8; }
                        </style>
                        <details>
                            <summary><strong>Primeiro Acesso</strong></summary>
                            <p>
                            	<br>
                                <a target="_blank" href="https://developers.facebook.com/">Acesse aqui</a>, no menu clique em <em>Meus aplicativos</em>, e <strong style="color: #45b134;">Criar aplicativo</strong>, selecione a opção <em>Consumidor</em>, avance. Será solicitado a sua senha do facebook novamente, preencha.</p>

                            <p>No card do Instagram, clique em configurar role a página até o final e clique em <em>Create New App</em> > <em>Criar aplicativo</em>.</p>

                            <p>Na seção User Token Generator, clique no botão azul <em>Add or Remove Instagram Testers</em> ou no menu lateral clique em <em>Funções</em> > <em>Funções</em>.</p>

                            <p>Procure a seção Testadores do Instagram e clique em <em>Adicionar Testadores do Instagram</em> digite seu usuário do Instagram e envie.</p>

                            <p>
                                Acesse seu perfil do <a href="https://www.instagram.com/" target="_blank">Instagram</a> clique na engrenagem (configurações), selecione Aplicativos e sites e depois vá na aba Convites do Testador e aceite seu aplicativo. Pronto, agora é só seguir o passo a passo abaixo para gerar uma nova chave.
                            </p>
                        </details>
                        <hr>

                        <details>
                            <summary><strong>Gerar um novo Token</strong></summary>
                            <p>
                            	<br>
                                <a target="_blank" href="https://developers.facebook.com/apps">Acesse aqui</a> e clique no seu Aplicativo. No menu lateral, procure por <em>Exibição básica do Instagram > Exibição básica</em> role a página até <em>User Token Generator</em>, e clique em Generate Token.
                        </details>
                    </div>
                </div>
            </div>

        </div>

	</div>





</form>

<?php get_footer_gestor(); ?>