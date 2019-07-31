<?php get_header() ?>
<div style="background: white">
<div class="agriContainer">
	<div class="agriTitle"><?php the_title() ?></div>
	<div class="agriBannerImg"><img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-baner-agri"></div>
	<div class="agriDescrription"><?php the_content() ?></div>
	<a href="<?php echo get_permalink(46); ?>" class="agri-button">Visit Our Store Now!</a>
</div>
</div>
<style type="text/css">
	.subscribe-container{
		display: none !important;
	}
</style>
<?php get_footer() ?>