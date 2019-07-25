<?php
if (FEATURED_SLIDER_OFF == 'true'){
?>

    <div class="row">
        <?php $components->default->templates(array('templates' => $templates,
	        'cols' => $cols,
	        'rows' => $rows,
	        'title' => $title));
	    ?>
	</div>


<?php } else{ ?>

<div class="row swiper-featured swiper-container">
    <div class="swiper-wrapper">
        <?php $components->default->templates(array('templates' => $templates,
            'cols' => $cols,
	        'rows' => $rows,
	        'title' => $title));
	    ?>
	</div>
	<!-- Add Arrows -->
	<div class="swiper-button-arrow">
	    <div class="swiper-button-prev"></div>
	    <div class="swiper-button-next"></div>
    </div>
</div>

<?php } ?>
