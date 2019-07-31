<?php 
	/* Template Name: Rainbows End Boutique*/
 ?>
<?php get_header('blogs') ?>
<?php 
	$i = 1;
	$query = new WP_Query(array('post_type' => 'rainbowsendboutique','order' => 'ASC'));
	if($query->have_posts()):
		while ($query->have_posts()) { $query->the_post();
		if(($i % 2) != 0){
			?>
			<section class="section-04 ">
				<div class="row">
					<div class="col-md-6">
					<div class="blog-container">
						<h1 class="blog-1-title"><?php the_title() ?></h1>
						<div class="blog-description"><?php the_content() ?></div>
					</div>
					</div>
					<div class="col-md-6 img-banner">
					<img src="<?php echo get_the_post_thumbnail_url(); ?>">
					</div>
				</div>
			</section>
			<?php
		}else{
			?>
			<section class="section-05 desktop-banner">
				<div class="row">
					<div class="col-md-6 img-banner">
					<img src="<?php echo get_the_post_thumbnail_url(); ?>">
					</div>
					<div class="col-md-6">
					<div class="blog-container">
						<h1 class="blog-1-title"><?php the_title() ?></h1>
						<div class="blog-description"><?php the_content() ?></div>
					</div>
					</div>
				</div>
			</section>
			<?php
		}
		?>	
		<?php
		$i++;
		}
	endif;
 ?>
<?php get_footer() ?>