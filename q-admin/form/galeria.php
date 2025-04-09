<?php
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;


//var_dump(phpinfo());
//exit;

# HEADERS
$_header['titulo'] = ($id ? 'Editar' : 'Nova') . ' Galeria - Estrutura';


add_javascript([
    "jquery.lightbox.min.js",
    "jquery.ui.widget.js",
    "jquery.iframe-transport.js",
    "jquery.fileupload.js",
    "jquery.rsv.js",
    "script.imagens.js",
]);

add_style([
    "css/lightbox.css"
]);

get_header_gestor();
get_barra_header();
?>

    <form name="form" id="form" action="" method="post" enctype="multipart/form-data" role="form">
        <div id="buttons">
            <div class="pull-left">
                <?php
                btn_save();
                //if ($q) btn_delete_form();
                ?>
            </div>
            <div class="pull-right">
                <?php
                // btn_add();
                btn_back();
                ?>
            </div>
        </div>


        <ul id="tab-nav" class="nav nav-tabs">
            <li <?= (isset($_POST) && $_POST['tab'] == 2 ? '' : 'class="active"') ?>><a href="#tab1" data-toggle="tab">Geral</a>
            </li>
            <li><a <?= ($q ? 'href="#tab2" data-toggle="tab"' : 'class="disable"') ?>>Galeria de Imagens</a></li>
        </ul>


        <div class="tab-content">
            <div id="tab1"
                 class="tab-pane <?= ($_GET["tab"] == "" ? "active" : ""); ?> waypoint animation_bottom animated">
                <fieldset>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>Título *</label>
                            <input type="text" class="form-control input-sm" id="titulo" name="titulo"
                                   value="<?= ($q ? $q->titulo : $_POST['titulo']); ?>" required/>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="permalink">Permalink *</label>
                            <input type="text" class="form-control input-sm" id="permalink" name="permalink"
                                   value="<?= ($q ? $q->permalink : $_POST['permalink']); ?>" required/>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="switch-wrap">
                                <div class="check-radio status">
                                    <?php get_checkbox_switch('status', 'Status', $q->status); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
            </div>


            <div id="tab2"
                 class="tab-pane <?= ($_GET["tab"] == "2" ? "active" : ""); ?> waypoint animation_bottom animated">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="buttons">
                            <div class="row">
                                <div class="col-xs-6">
                                    <button
                                            type="button"
                                            class="modal-btn btn btn-sm btn-primary"
                                            data-toggle="modal"
                                            data-target="#modal-upload"
                                            data-categoria="<?= $CAT_GAL ?>"
                                    >
                                        <span class="glyphicon glyphicon-picture"></span>
                                        Inserir imagens
                                    </button>
                                    <a href="javascript:void(0)" class="del-imagem btn btn-sm btn-danger"
                                       data-categoria="<?= $CAT_GAL ?>"><span class="glyphicon glyphicon-trash"></span>
                                        Apagar imagens</a>
                                </div>
                                <div class="col-xs-6">
                                    <div class="pull-right checkbox">
                                        <label>
                                            <input id="selecionar-todas" name="selecionar-todas" type="checkbox"
                                                   value="<?= $CAT_GAL ?>"/> Selecionar todas
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="lista-imagens"
                             class="<?= $CAT_GAL ?> row"><?= get_thumbs($q->id, $__TABLE__IMG, HTTP_UPLOADS_IMG, $CAT_GAL) ?></div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="id" value="<?= ($id ? $id : false); ?>"/>
        <input type="hidden" name="action" value="<?= ($id ? 'alterar' : 'adicionar'); ?>"/>
        <input type="hidden" name="cat_imagens" id="cat_imagens" value="<?= $CAT_GAL ?>"/>
        <input type="hidden" name="tabela" id="tabela" value="<?= $__TABLE__ ?>"/>
        <input type="hidden" name="tabela_img" id="tabela_img" value="<?= $__TABLE__IMG ?>"/>
    </form>


<?php include GESTOR_INCLUDES . 'modal-upload.php'; ?>


<?php get_footer_gestor(); ?>