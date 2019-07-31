<?php 
	get_header('home');
?>
<div class="home-page-container">


	<section class="farm-container desktop-banner">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="farm-text-container animation">
			<h1 class="farm-title"><?php the_field('home_page_banner_title')?></h1>
			<div class="farm-description"><?php the_field('home_page_banner_description')?></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-12 col-xs-12 img-banner">
		<img src="<?php the_field('home_page_banner')?>">
	</div>
	</section>
	<section class="farm-container responsive-banner">
	<div class="col-sm-12 col-xs-12 img-banner">
		<div class="farm-text-container animation">
			<h1 class="farm-title"><?php the_field('home_page_banner_title')?></h1>
			<img src="<?php the_field('home_page_banner')?>">
			<div class="farm-description"><?php the_field('home_page_banner_description')?></div>
		</div>
	</div>
	</section>
<section class="section-02">
	<div class="col-img img-banner">
		<img class="animation" src="<?php the_field('img-1'); ?>">
	</div>
	<div class="col-img img-banner">
		<img class="animation" src="<?php the_field('img-2'); ?>">
	</div>
	<div class="col-img img-banner">
		<img class="animation" src="<?php the_field('img-3'); ?>">
	</div>
</section>
<section class="section-03">
	<h1 class="feature-title">Featured Products</h1>
	<div class="row featured-product-content">
	<?php 
		$featured_products = new WP_Query( array(  
		    'post_type' => 'product',  
		    'meta_key' => '_featured', 
		    'orderby' => 'rand',
		    'meta_value' => 'yes',  
		    'posts_per_page' => 4  
		)
		);
		if($featured_products->have_posts()):
			while($featured_products->have_posts()): $featured_products->the_post();
					?>
					<div class="col-md-3 col-sm-6 col-xs-12 animation">
						<?php if ( has_post_thumbnail( get_the_ID() ) ) {
                        ?>
                        <img class="fea-product-image" src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'shop_single' ); ?>">
                        <?php
                    } else {
                        echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                    } ?>
						<div class="fea-product-title"><?php the_title() ?></div>
						
						<div class="price">
							<span class="price-label">Price: </span>
							<span class="price-ammount"><?php echo $product->get_price_html() ?></span>
							<div class="cart-container"><span class="addcart-icon" onclick="return addCart(<?php echo $post->ID;?>)"></span></div>
						</div>
						<a class="btn-buy" id="<?php echo $product->id; ?>" href="<?php echo get_permalink(); ?>"> Buy Now!</a>
					</div>
					<?php
				endwhile;
		endif;
	 ?>
	</div>


<div class="bottom-container"></div>

</section>
<section class="section-04">
	<div class="row">
	<?php $args = array( 'post_type' => 'post', 'category_name' => 'bees' , 'posts_per_page' => 1); ?>
	<?php $query = new WP_Query($args); ?>
	<?php if( $query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
		<span class="desktop-banner">
		<div class="col-md-6 col-sm-12 img-banner">
		<img src="<?php echo get_the_post_thumbnail_url() ?>">
		</div>
		<div class="col-md-6 col-sm-12">
		<div class="blog-container">
			<h1 class="blog-1-title"><?php the_title() ?></h1>
			<span class="blog-description"><?php the_excerpt() ?></span>
			<a href="<?php echo get_permalink(); ?>" class="blog-button">Read More</a>	
		</div>
		</div>
		</span>

		<span class="responsive-banner">
		<div class="col-md-6 col-sm-12  img-banner">
		<div class="blog-container">
			<h1 class="blog-1-title"><?php the_title() ?></h1>
			<img src="<?php echo get_the_post_thumbnail_url() ?>">
			<span class="blog-description"><?php the_excerpt() ?></span>
			<a href="<?php echo get_permalink(); ?>" class="blog-button">Read More</a>	
		</div>
		</div>
		</span>

	<?php endwhile;endif; ?>
	</div>
</section>
<section class="section-05">
	<div class="row">
	<?php $args = array( 'post_type' => 'post', 'category_name' => 'pigs' , 'posts_per_page' => 1); ?>
	<?php $query = new WP_Query($args); ?>
	<?php if( $query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
		<span class="desktop-banner">
		<div class="col-md-6 col-sm-12">
		<div class="blog-container">
			<h1 class="blog-1-title"><?php the_title() ?></h1>
			<span class="blog-description"><?php the_excerpt() ?></span>
			<a href="<?php echo get_permalink(); ?>" class="blog-button">Read More</a>	
		</div>
		</div>
		<div class="col-md-6 col-sm-12 img-banner">
		<img src="https://www.telderersrainbowsendfarm.com/wp-content/uploads/2017/02/b-01-1.png">
		</div>
		</span>

		<span class="responsive-banner">
		<div class="col-md-6 col-sm-12 img-banner">
		<div class="blog-container">
			<h1 class="blog-1-title"><?php the_title() ?></h1>
			<img src="<?php echo get_the_post_thumbnail_url() ?>">
			<span class="blog-description"><?php the_excerpt() ?></span>
			<a href="<?php echo get_permalink(); ?>" class="blog-button">Read More</a>	
		</div>
		</div>
		</span>
		<?php endwhile;endif; ?>
	</div>
</section>
</div>
<?php get_footer() ?>

