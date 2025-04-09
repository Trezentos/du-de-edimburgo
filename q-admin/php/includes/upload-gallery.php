<div class="row">
	<div class="col-xs-12">

		<div id="buttons">
			<div class="row">
				<div class="col-xs-6">
					<button type="button" class="modal-btn btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-upload" data-categoria="<?=$CAT_GAL?>"><span class="glyphicon glyphicon-picture"></span> Inserir imagens</button>
					<a href="javascript:void(0)" class="del-imagem btn btn-sm btn-danger" data-categoria="<?=$CAT_GAL?>"><span class="glyphicon glyphicon-trash"></span> Apagar imagens</a>
				</div>
				<div class="col-xs-6">
					<div class="pull-right checkbox">
						<label>
							<input id="selecionar-todas" name="selecionar-todas" type="checkbox" value="<?=$CAT_GAL?>" /> Selecionar todas
						</label>
					</div>
				</div>
			</div>
		</div>
		
		<div id="lista-imagens" class="<?=$CAT_GAL?> row"><?php echo get_thumbs($q->id, $__TABLE__IMG, HTTP_UPLOADS_IMG, $CAT_GAL) ?></div>

	</div>
</div>