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

    let originalList =  $('.sortable-image').map(function() {
        return $(this).data('id');
    }).get()

    let clipboard = new ClipboardJS('.copy-shortcode');
    clipboard.on('success', function(e) {
        toastr.success('Copied', 'Success')
        e.clearSelection();
    });
    clipboard.on('error', function(e) {
        alert("Failed to copy shortcode. Please try again.");
    });

    $( function() {
        $("#sortable").sortable({
            axis: "x",
            stop: function( event, ui ) {
                let data = $('.sortable-image').map(function() {
                    return $(this).data('id');
                }).get()
                if ( mapChange( originalList, data ) ) {
                    originalList = data
                    $.ajax({
                        method: 'POST',
                        url: ajaxurl,
                        data: { action: 'knomic_update_slide_arrangement' ,map: data,},
                        success: function (response) {
                            if ( ! response.success ) {
                                toastr.error(response.data.message, 'Error')
                                return;
                            }
                            toastr.success(response.data.message, 'Success')
                            // setTimeout(function() {
                            //     window.location.reload();
                            // }, 6000);
                        },
                    })
                }
            }
        })
    })

    $('#upload-slideshow-images').click(function(e) {
        e.preventDefault();
       if ( originalList.length < 10 ) {
           let image = wp.media({
               title: 'Upload Image',
               // mutiple: true if you want to upload multiple files at once
               multiple: false
           }).open()
               .on('select', function(e){
                   // This will return the selected image from the Media Uploader, the result is an object
                   let uploaded_image = image.state().get('selection').first();
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
                           },
                       })
                   }

               });
       }
    });

    $('.remove-image').click( function (e) {
        let parent = $(this).parent(),
            id = parent.find('.sortable-image').data('id');

        if ( confirm('Do you want to remove this image from slideshow?') ) {
            $.ajax({
                method: 'POST',
                url: ajaxurl,
                data: { action: 'knomic_remove_image_from_slide', id: id },
                success: function (response) {
                    if ( ! response.success ) {
                        toastr.error(response.data.message, 'Error')
                        return;
                    }
                    toastr.success(response.data.message, 'Success')
                    parent.fadeOut();
                    parent.remove();
                }
            })
        }

    })
});


function mapChange( list1, list2 ) {
    if (  list1.size !== list2.size ){
        return true;
    }
    for ( let i = 0; i < list1.length; i++ ) {
        if ( list1[i] !== list2[i] ) {
            return true;
        }
    }
    return false;
}