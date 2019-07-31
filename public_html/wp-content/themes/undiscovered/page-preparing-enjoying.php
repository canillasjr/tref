<?php  get_header() ?>
<div class="sus-tips">
	<div class="tips-header"><?php the_title() ?></div>

	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php $query = new WP_Query(array('post_type' => 'sustainable_tips', 'posts_per_page' => -1 , 'order' => 'ASC')); ?>

		<?php while ($query->have_posts()) : $query->the_post();?>

			<div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="headingThree">
		      <h4 class="panel-title content-collapse">
		        <a class="collapsed title-collapse" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $post->ID; ?>" aria-expanded="false" aria-controls="collapse<?php echo $post->ID; ?>">
		          <?php the_title() ?>
		        </a>
		      </h4>
		    </div>
		    <div id="collapse<?php echo $post->ID; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapse<?php echo $post->ID; ?>">
		      <div class="panel-body content-box">
		        <?php the_content() ?>
		      </div>
		    </div>
		  </div>

	  	<?php endwhile; ?>

	  	<?php wp_reset_query(); ?>
	  	</div>

</div>
<?php get_footer() ?>