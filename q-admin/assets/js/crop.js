
// convert bytes into friendly format
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};


// update info by cropping (onChange and onSelect events handler)
function updateInfo(id, e) {
    $('#'+id+'_x1').val(e.x);
    $('#'+id+'_y1').val(e.y);
    $('#'+id+'_w').val(e.w);
    $('#'+id+'_h').val(e.h);
};

function fileSelectHandler(campoFile, preview, largura, altura) {

    var jcrop_api, boundx, boundy;

    // get selected file
    var oFile = $('#'+campoFile)[0].files[0];

    var __Parent = $('#'+campoFile).parent();

    // hide errors
    __Parent.find('.error').hide();


    // check for image type (jpg and png are allowed)
    var rFilter = /^(image\/jpeg|image\/png)$/i;
    if (! rFilter.test(oFile.type)) {
        __Parent.find('.error').html('Por favor selecione uma imagem do formato "JPG" ou "PNG".').show();
        return;
    }

    console.log(oFile.size);

    // check for file size
    if (oFile.size > 8 * 1024 * 1024) {
        __Parent.find('.error').html('Você selecionou uma imagem muito grande, por favor selecione uma imagem com menos de 8MB.').show();
        return;
    }

    // preview element
    var oImage = document.getElementById(preview);

    // prepare HTML5 FileReader
    var oReader = new FileReader();
        oReader.onload = function(e) {

        // e.target.result contains the DataURL which we can use as a source of the image
        oImage.src = e.target.result;
        oImage.onload = function () { // onload event handler

            // display step 2
            __Parent.find('.step2').fadeIn(800);

            // display some basic image info
            var sResultFileSize = bytesToSize(oFile.size);
            
            // destroy Jcrop if it is existed
            if (typeof jcrop_api != 'undefined') {
                jcrop_api.destroy();
                jcrop_api = null;
                $('#'+preview).width(oImage.naturalWidth);
                $('#'+preview).height(oImage.naturalHeight);
            }

            setTimeout(function(){
                // initialize Jcrop

                $('#'+preview).Jcrop({
                    minSize: [370, 248], // min crop size
                    boxWidth: 970,
                    boxHeight: 600,
                    aspectRatio : largura/altura, // keep aspect ratio 1:1
                    bgFade: true, // use fade effect
                    bgOpacity: .3, // fade opacity
                    setSelect: [0, largura, altura, 0],
                    onChange: function(coords){updateInfo(campoFile, coords);},
                    onSelect: function(coords){updateInfo(campoFile, coords);},
                }, function(){

                    // use the Jcrop API to get the real image size
                    var bounds = this.getBounds();
                    boundx = bounds[0];
                    boundy = bounds[1];

                    // Store the Jcrop API in the jcrop_api variable
                    jcrop_api = this;
                });
            },100);

            $('html, body').animate({scrollTop: ( $('#'+preview).offset().top -60 )}, 1500);

        };
    };

    // read selected file as DataURL
    oReader.readAsDataURL(oFile);
}