<!--/MODAL UPLOAD/-->
<div id="modal-upload" class="modal fade bs-example-modal-lg">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Inserir imagens</h4>
			</div>
			<div class="modal-body">
				<form id="upload" method="post" action="" enctype="multipart/form-data">
					<div id="drop">
						<div class="center">
							<p>Solte as imagens em qualquer lugar para fazer o upload</p>
							<a class="btn btn-lg btn-default">Selecionar arquivos</a>
							<input type="file" name="file" multiple />
						</div>
					</div>
					<ul class="list-group"></ul>
				</form>
			</div>
		</div>
	</div>
</div>


<!--/MODAL LEGENDA/-->
<div id="modal-legenda" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Legenda</h4>
			</div>
			<div class="modal-body">
				<form id="form-legenda" method="post" action="" >
					<div class="form-group">
						<label class="sr-only" for="legenda">Legenda</label>
						<input class="form-control" type="text" name="legenda" id="legenda" />
						<input type="hidden" name="id" value="<?php echo ($id?$id:''); ?>" />
						<input type="hidden" name="id_img" value="" />
						<input type="hidden" name="tabela_img" id="tabela_img" value="<?=$__TABLE__IMG?>" />
						<input type="hidden" name="action" id="action" value="set_legenda" />
					</div>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</form>
			</div>
		</div>
	</div>
</div>