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
    <?php foreach ($images as $index => $image ) { ?>
       <img src='<?php echo $image?>' class='sortable-image' data-id='<?php echo $image_array[$index] ?>'>
        <i class="fas fa-times remove-icon"></i>
    <?php }
    ?>

</div>