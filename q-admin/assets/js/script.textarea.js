(function($){
	

	let MODE_SKIN;

	if (localStorage.theme == "dark"){
		MODE_SKIN = "dark";
	}
	else
	{
		MODE_SKIN = "lightgray";
	}



	$(window).on('load', function () {
		// TEXTAREA
		$('textarea.tinymce').tinymce({
			script_url : HTTP_GESTOR + 'tinymce/tinymce.min.js',
			language: "pt_BR",
			skin: MODE_SKIN,
			height: 550,
			image_advtab: true,
			relative_urls: false,
			nonbreaking_force_tab: true,
			paste_data_images: true,
			paste_as_text: true,
			menu: {
				//file	: {title : 'File'  , items : 'newdocument'},
				edit	: {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
				insert 	: {title : 'Insert', items : 'link media | template hr'},
				view	: {title : 'View'  , items : 'visualaid'},
				format 	: {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
				table	: {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
				tools	: {title : 'Tools' , items : 'spellchecker code'}
			},
			plugins: [ "advlist autolink link image code table media nonbreaking paste searchreplace responsivefilemanager" ],
			toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image media code table | responsivefilemanager",

			external_filemanager_path: HTTP_GESTOR+"filemanager/",
			filemanager_crossdomain: true,
			filemanager_title:"Inserir Mídias" ,
			external_plugins: { "filemanager" : HTTP_GESTOR+"filemanager/plugin.min.js"}
		});


		$('textarea.tinymce-small').tinymce({
			script_url : HTTP_GESTOR + 'tinymce/tinymce.min.js',
			language: "pt_BR",
			skin: MODE_SKIN,
			height: 230,
			image_advtab: true,
			relative_urls: false,
			nonbreaking_force_tab: true,
			paste_data_images: true,
			paste_as_text: true,
			menu: {
				//file	: {title : 'File'  , items : 'newdocument'},
				edit	: {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
				insert 	: {title : 'Insert', items : 'link media | template hr'},
				view	: {title : 'View'  , items : 'visualaid'},
				format 	: {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
				table	: {title : 'Table' , items : 'inserttable tableprops deletetable | cell row column'},
				tools	: {title : 'Tools' , items : 'spellchecker code'}
			},
			plugins: [ "advlist autolink link image code table media nonbreaking paste searchreplace responsivefilemanager" ],
			toolbar1: "undo redo | styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image media code table | responsivefilemanager",

			external_filemanager_path: HTTP_GESTOR+"filemanager/",
			filemanager_crossdomain: true,
			filemanager_title:"Inserir Mídias" ,
			external_plugins: { "filemanager" : HTTP_GESTOR+"filemanager/plugin.min.js"}
		});


		$('textarea.tinymce-basic').tinymce({
			script_url : HTTP_GESTOR + 'tinymce/tinymce.min.js',
			language: "pt_BR",
			skin: MODE_SKIN,
			height: 200,
			image_advtab: true,
			relative_urls: false,
			nonbreaking_force_tab: true,
			paste_data_images: true,
			paste_as_text: true,
			menu: {
				format 	: {title : 'Format', items : 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
				tools	: {title : 'Tools' , items : 'spellchecker code'}
			},
			plugins: [ "advlist autolink link image code table media nonbreaking paste searchreplace responsivefilemanager" ],
			toolbar1: "styleselect | bold italic | alignleft aligncenter alignright",
		});
	});
})(window.jQuery);