<table class="form-table">
    <tbody>
    <tr>
        <th scope="row">
            <label for="slideshow-shortcode"><?php esc_attr_e('Slideshow Shortcode', 'slideshow'); ?></label>
        </th>
        <td>
            <div class="shortcode-container">
                <input type="text" class="slideshow-shortcode" value="[slideshow]" id="slideshow-shortcode" readonly>
                <button type="button" class="button button-secondary copy-shortcode" data-clipboard-target="#slideshow-shortcode"><?php esc_attr_e('Copy Shortcode', 'slideshow'); ?></button>
            </div>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <label for="upload-slideshow-images"><?php esc_attr_e('Add Slideshow Images', 'slideshow'); ?></label>
        </th>
        <td>
            <button type="button" class="button button-secondary" id="upload-slideshow-images" data-multiple="true" data-button-text="<?php esc_attr_e('Add Image to Slideshow', 'slideshow'); ?>" data-title="<?php esc_attr_e('Add Image to Slideshow', 'slideshow'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php esc_attr_e('Add Image to Slideshow', 'slideshow'); ?></button>
        </td>
    </tr>
    </tbody>
</table>

<div id="sortable">
    <?php foreach ($images as $index => $image ) { ?>
    <div class="image-container">
        <img src='<?php esc_attr_e( $image, 'slideshow')?>' class='sortable-image' data-id='<?php esc_attr_e( $image_ids[$index], 'slideshow') ?>'>
        <i class="fas fa-times remove-image"></i>
    </div>
    <?php }
    ?>

</div>