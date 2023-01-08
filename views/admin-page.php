<?php
$image_array = get_option( KNOMIC_SLIDESHOW__ARRANGEMENT ) ?: [];
?>

<table class="form-table">
    <tbody>
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
</div>