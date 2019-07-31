<?php 
	get_header('sustainable');
 ?>
 <!-- <section class="section-02">
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-1'); ?>">
	</div>
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-2'); ?>">
	</div>
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-3'); ?>">
	</div>
</section> -->
<section class="hover-nav" style="clear: both;display: block;padding: 15px 0;background: white;">
<div id ="owl-slidersheep" class="owl-carousel ">
		<?php query_posts(array('post_type' => 'sheepslider', 'posts_per_page' => -1 , 'order' => 'ASC' )); ?>
		<?php if(have_posts()): ?>
	<?php while (have_posts()) : the_post();?>
		<div class="row sus-banner">
	<div class="col-md-6 col-sm-12">
	<!-- <?php echo get_template_directory_uri();?>/img/flower.png -->
		<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-banner-sustainable banner-effect">
	</div>
	<div class="col-md-6 col-sm-12">
		<div class="sustainable-ban-right banner-effect">
			<h1 class="banner-title"><?php the_title(); ?></h1>
		<span class="banner-description"><?php the_content(); ?></span>
		</div>
	</div>
	</div>
	<?php endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>
</section>
<section class="section-02">
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-1'); ?>">
	</div>
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-2'); ?>">
	</div>
	<div class="col-img">
		<img data-toggle="modal" data-target="#modal-lamb" class="animation" style="cursor: pointer;" src="<?php the_field('img-3'); ?>">
	</div>
</section>
<div class="modal fade" id="modal-lamb" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
         <video width="100%" controls>
		  <source src="<?php echo get_template_directory_uri(); ?>/Lambs racing .mp4" type="video/mp4">
		</video>
        </div>
      </div>
      
    </div>
  </div>
<?php 
	$featured_products = new WP_Query( array(  
		    'post_type' => 'product',  
		    'meta_key' => '_featured',  
		    'meta_value' => 'yes',
		    'product_cat' => 'Lamb',  
		    'posts_per_page' => 4  
		)
		);
	if($featured_products->post_count > 0):
 ?>
<section class="section-03">
	<h1 class="feature-title">Featured Products</h1>
	<div class="row featured-product-content">
	<?php 
		if($featured_products->have_posts()):
			while($featured_products->have_posts()): $featured_products->the_post();
					?>
					<div class="col-md-3 col-sm-6 col-xs-12">
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
<?php endif; ?>
 <?php 
 	get_footer();
  ?>