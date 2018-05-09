$(document).ready(function(){
	$("#alert_fail").hide();
	$("#alert_success").hide();

		// $("#images").fileinput({
		// 	theme: 'fa',
  //           uploadUrl: "actualizarProfile",
  //           uploadExtraData: function() {
  //               return {
  //                   _token: $("input[name='_token']").val(),
  //                   usernameProfile: $('#usernameProfile').val(),
  //                   idProfile: $('#idProfile').val(),
		//         	nombreProfile: $('#nameProfile').val(),
		//         	passwordProfile: $('#passwordProfile').val(),
  //               };
  //           },
  //           allowedFileExtensions: ['jpg', 'png', 'gif'],
  //           overwriteInitial: false,
  //           maxFilesNum: 1,
  //           slugCallback: function (filename) {
  //               return filename.replace('(', '_').replace(']', '_');
  //           }
  //       });
	$("#images").fileinput({
	    theme: 'fas',
	    language: 'es',  
	    required: false,
	    maxFileCount: 1,
	    indicatorErrorTitle: 'Error en la subida de ficheros',
	    uploadUrl: 'actualizarProfile',
	    validateInitialCount: true,
	    uploadAsync: true,         
	    overwriteInitial: false,
	    initialPreviewAsData: true,
	    removeFromPreviewOnError: true,
	    allowedFileExtensions: ["jpg","png"],
	    // botones de fuera del cuadrado de imagen
	    'showUpload' : true,
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
                    idProfile: $('#idProfile').val(),
		        	nombreProfile: $('#nameProfile').val(),
		        	passwordProfile: $('#passwordProfile').val(),
	        };
	        return info;
	    }
	});
	$('#images').on('fileuploaded', function (event, data, previewId, index) {
        $('#images').fileinput('reset');
    });
    $('#images').on('filebatchuploadcomplete', function (event, data, previewId, index) {
        console.log("3");
        $("#alert_success").show();
        $("#alert_success").fadeToggle(5000);
    });
    $('#images').on('filebatchuploaderror', function (event, data, previewId, index) {
        console.log("4");  
        $("#alert_fail").show(); 
        $("#alert_fail").fadeToggle(5000);
    });
});