<?php
$images =
    [
        "https://upload.wikimedia.org/wikipedia/commons/a/af/%22_13_-_ITALY_-_gatto_nero_nella_scatola_-_black_cat_in_the_box_-_sancazz_paper_box.jpg",
        "https://upload.wikimedia.org/wikipedia/commons/2/27/%28Unknown%29_-_Still_003.jpg",
        "https://upload.wikimedia.org/wikipedia/commons/c/c0/Cat_Briciola_with_pretty_and_different_colour_of_eyes.jpg"
        ];
$count = count( $images );
?>
<div class="container">
    <?php
    foreach ( $images as $index => $image ) {
        ++$index;
        $number_text = "$index/$count"
    ?>
        <div class="mySlides">
            <div class="numbertext"><?php esc_attr_e("$number_text"); ?></div>
            <img src="<?php esc_attr_e( "$image", 'slideshow' ); ?>" style="width:100%" alt="<?php esc_attr_e($index); ?>">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <?php }
    ?>
    <!-- The dots/circles -->
    <div style="text-align:center">
		<?php
		foreach ( $images as $image ) {
			?>
            <span class="dot"></span>
		<?php }
		?>
    </div>
</div>

