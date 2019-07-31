<?php get_header() ?>
<div style="background: white">
<div class="agriContainer">
	<div class="agriTitle"><?php the_title() ?></div>
	<div class="agriDescrription"><?php the_content() ?></div>
	<a href="<?php echo get_permalink(46); ?>" class="agri-button">Visit Our Store Now!</a>
</div>
</div>
<style type="text/css">
	.subscribe-container{
		display: none !important;
	}
	.agriDescrription{
		padding-top: 0 !important;
	}
</style>
<?php get_footer() ?>