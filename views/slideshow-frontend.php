<?php
$count = count( $images );
?>
<div class="slideshow-container">
    <?php
    foreach ( $images as $index => $image ) {
        ++$index;
        $number_text = "$index/$count"
    ?>
        <div class="mySlides">
            <div class="numbertext"><?php echo esc_attr( $number_text ); ?></div>
            <img src="<?php echo esc_attr( $image ); ?>" style="width:100%" alt="<?php echo esc_attr($index); ?>">
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

