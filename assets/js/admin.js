jQuery(document).ready(function($){
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $( function() {
        $("#sortable").sortable({})
    })
    $('#upload-slideshow-images').click(function(e) {
        e.preventDefault();

        var image = wp.media({
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
            .on('select', function(e){
                // This will return the selected image from the Media Uploader, the result is an object
                var uploaded_image = image.state().get('selection').first();
                // We convert uploaded_image to a JSON object to make accessing it easier
                // Output to the console uploaded_image
               if ( uploaded_image ) {
                   let image = uploaded_image.toJSON(),
                       id = image.id,
                       url = image.url;
                   $.ajax({
                       method: 'POST',
                       url: ajaxurl,
                       data: { action: 'knomic_add_image_to_slide' ,id: id, url: url },
                       success: function (response) {
                           if ( ! response.success ) {
                               toastr.error(response.data.message, 'Error')
                               return;
                           }
                           toastr.success(response.data.message, 'Success')
                           setTimeout(function() {
                               window.location.reload();
                           }, 6000);
                       },
                       error: function (response) {

                           // console.log(response)
                       }
                   })
               }

            });
    });
});
