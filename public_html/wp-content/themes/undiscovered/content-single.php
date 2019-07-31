	<?php if ( is_search() ) : ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php else : ?>
	<div class="entry-content">
		<!-- <?php the_post_thumbnail() ?> -->
		<div class="post-containerr">
			<div class="post-title"><?php the_title() ?></div>
			<div class="post-date"> <?php echo get_the_date(); ?></div>
			<div class="post-content">
				<?php the_post_thumbnail('single-post-size') ?>
				<?php the_content() ?>
			</div>
			 <?php
              // Get current page URL
              $crunchifyURL = get_permalink();

              // Get current page title
              $crunchifyTitle = str_replace( ' ', '%20', get_the_title());

              $twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
              $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
              $googleplus = 'https://plus.google.com/share?url='.$crunchifyURL;

            ?>
			<div class="share-icon"><span>Share post </span>
			<a href="<?php echo $facebookURL ?>" onclick="window.open('<?php echo $facebookURL ?>', 'newwindow', 'width=500, height=300'); return false;" class="social-icon">
			<img src="<?php echo get_template_directory_uri(); ?>/img/social/facebook.png" alt=""></a>
			<a href="<?php echo $twitterURL ?>" onclick="window.open('<?php echo $twitterURL ?>', 'newwindow', 'width=500, height=300'); return false;" class="social-icon">
			<img src="<?php echo get_template_directory_uri(); ?>/img/social/twitter.png" alt=""></a>
			<a href="<?php echo $googleplus ?>" onclick="window.open('<?php echo $googleplus ?>', 'newwindow', 'width=500, height=300'); return false;"  class="social-icon">
			<img src="<?php echo get_template_directory_uri(); ?>/img/social/googleplus.png" alt=""></a>
			</div>
		</div>
	</div>
	<?php endif; ?>
