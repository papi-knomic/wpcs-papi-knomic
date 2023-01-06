<?php
$images =
    [
        "https://upload.wikimedia.org/wikipedia/commons/a/af/%22_13_-_ITALY_-_gatto_nero_nella_scatola_-_black_cat_in_the_box_-_sancazz_paper_box.jpg",
        "https://upload.wikimedia.org/wikipedia/commons/2/27/%28Unknown%29_-_Still_003.jpg",
        "https://upload.wikimedia.org/wikipedia/commons/c/c0/Cat_Briciola_with_pretty_and_different_colour_of_eyes.jpg"
        ];
?>
<div id="slideshow-example" data-component="slideshow">
    <?php
    foreach ( $images as $image ) {
    ?>
	<div role="list">
		<div class="slide">
			<img src="<?php echo $image ?>" alt="">
		</div>
	</div>
    <?php }
    ?>
</div>
