<section class="blogs-container-even" id="pigs">
	<div class="row blog-cat-box">
		<div class="category-title">Hey Piggy, Piggy!</div>
		<div class="row">
			<?php $args = array( 'post_type' => 'post', 'category_name' => 'pigs' , 'posts_per_page' => 3); ?>
			<?php $query = new WP_Query($args); ?>
			<?php if( $query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
			<div class="col-md-4 blog-single-container">
				<div class="align-box">
				<?php the_post_thumbnail('blog-post-size') ?>
				<div class="blog-title"><a style="font-size: 16px;color: #3C2415;font-weight: bold;margin-top: 34px;font-style: italic;" href="<?php echo get_permalink() ?>"><?php the_title() ?></a></div>
				<div class="blog-date"><?php echo get_the_date(); ?></div>
				<div class="blog-post-description"><?php the_excerpt() ?></div>
				<a href="<?php echo get_permalink() ?>" class="blog-readmore">Read More</a>
				</div>
			</div>
		<?php endwhile;endif; ?>
		</div>
	</div>	
</section>