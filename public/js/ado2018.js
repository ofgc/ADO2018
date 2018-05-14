$(document).ready(function(){
	$("#alert_fail").hide();
	$("#alert_success").hide();
	$("#images_profile").fileinput({
	    theme: 'explorer-fa',
	    language: 'es',  
	    required: false,
	    maxFileCount: 1,
	    indicatorErrorTitle: 'Error en la subida de ficheros',
	    uploadUrl: 'actualizarProfile',
	    validateInitialCount: true,
	    uploadAsync: false,         
	    overwriteInitial: false,
	    initialPreviewAsData: true,
	    removeFromPreviewOnError: true,
	    allowedFileExtensions: ["jpg","png"],
	    // botones de fuera del cuadrado de imagen
	    'showUpload' : false,
	    'showCaption': true,
	    'showCancel': false,
	    'showRemove': false,
	    fileActionSettings : {
	    // Para quitar el botoncito de subir en la imagen
	    showUpload : false,
	    },
	    uploadExtraData: function (previewId, index) {
	        var info = 
	        {
					_token: $("input[name='_token']").val(),
	        		usernameProfile: $('#usernameProfile').val(),
	        		emailProfile : $('#emailProfile').val(),
                    idProfile: $('#idProfile').val(),
		        	nombreProfile: $('#nameProfile').val(),
		        	passwordProfile: $('#passwordProfile').val(),
	        };
	        return info;
	    }
	});
	$('#images_profile').on('fileuploaded', function (event, data, previewId, index) {
        $('#images').fileinput('reset');
    });
    $('#images_profile').on('filebatchuploadcomplete', function (event, data, previewId, index) {
        console.log("3");
        $("#alert_success").show();
        $("#alert_success").fadeToggle(5000);
    });
    $('#images_profile').on('filebatchuploaderror', function (event, data, previewId, index) {
        console.log("4");  
        $("#alert_fail").show(); 
        $("#alert_fail").fadeToggle(5000);
    });

    $('#button_profile').click(function(){

            $("#images_profile").fileinput('upload');

    }); 

});