<div class="wrap">
    <h1 class="wp-heading-inline">Knomic Slideshow</h1>
    <hr class="wp-header-end">
    <div id="poststuff">
        <div class="postbox">
            <div class="postbox-header">
                <h2 class="hndle ui-sortable-handle">Add Images to Slideshow</h2>
            </div>
            <div class="inside">
                <table class="form-table">
                    <tbody>
                    <tr valign="top">
                        <th scope="row">
                            <label for="slideshow-shortcode"><?php esc_attr_e('Slideshow Shortcode', 'slideshow'); ?></label>
                        </th>
                        <td>
                            <div class="shortcode-container">
                                <input type="text" class="slideshow-shortcode" value="[<?php echo esc_attr(KNOMIC_SLIDESHOW_SHORTCODE); ?>]" id="slideshow-shortcode" readonly>
                                <button type="button" class="button button-secondary copy-shortcode" data-clipboard-target="#slideshow-shortcode"><?php esc_attr_e('Copy Shortcode', 'slideshow'); ?></button>
                            </div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">
                            <label for="upload-slideshow-images"><?php esc_attr_e('Add Slideshow Images', 'slideshow'); ?></label>
                        </th>
                        <td>
                            <button type="button" class="button button-secondary" id="upload-slideshow-images" data-multiple="true" data-button-text="<?php esc_attr_e('Add Image to Slideshow', 'slideshow'); ?>" data-title="<?php esc_attr_e('Add Image to Slideshow', 'slideshow'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php esc_attr_e('Add Image to Slideshow', 'slideshow'); ?></button>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row"></th>
                        <td>
                            <span class="description">Choose your desired images for slideshow. You can only add 5 images at the moment. Copy shortcode and put in POST or PAGE. Minimum width and height for image is 814 and 610 respectively.</span>
                        </td>
                    </tr>
                    <?php wp_nonce_field( 'knomic_slideshow_image_select', 'knomic_slideshow_image_select' ); ?>
                    </tbody>
                </table>
                <div id="sortable">
		            <?php
		            if ( $images ) {
			            foreach ($images as $index => $image ) { ?>
                            <div class="image-container">
                                <img src='<?php echo esc_url( $image )?>' class='sortable-image' data-id='<?php echo esc_attr( $image_ids[$index] ) ?>' alt='<?php echo esc_attr( $image_ids[$index] ) ?>'>
                                <i class="fas fa-times remove-image"></i>
                            </div>
			            <?php }
		            } else { ?>
                        <div class="no-image-added">No image added</div>
		            <?php } ?>
                </div>
	            <?php wp_nonce_field( 'knomic_slideshow_image_remove', 'knomic_slideshow_image_remove' ); ?>
	            <?php wp_nonce_field( 'knomic_slideshow_image_sort', 'knomic_slideshow_image_sort' ); ?>
            </div>
        </div>
    </div>
</div>