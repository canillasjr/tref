<?php 
	get_header('sustainable');
 ?>
 <section class="section-02">
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-1'); ?>">
	</div>
	<div class="col-img">
		<img class="animation" src="<?php the_field('img-2'); ?>">
	</div>
	<div class="col-img hover-" style="position: relative;">
		<img  class="animation " style="cursor: pointer;" src="<?php the_field('img-3'); ?>">
		<a target="_blank" href="<?php echo get_template_directory_uri(); ?>/turkeys on pasture.mp4" class="target-hover"><span>Click here to view Video</span></a>
	</div>
</section>
<div class="modal fade" id="modal-turk" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
         <video width="100%" controls>
		  <source src="<?php echo get_template_directory_uri(); ?>/turkeys on pasture.mp4" type="video/mp4">
		</video>
        </div>
      </div>
      
    </div>
  </div>
 <?php 
 	get_footer();
  ?>