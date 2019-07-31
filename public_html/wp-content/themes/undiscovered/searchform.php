<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'undiscovered' ); ?></span>
		<input type="hidden" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Product', 'placeholder', 'undiscovered' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">

		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Product', 'placeholder', 'undiscovered' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="category">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'undiscovered' ); ?>">
	<input type="hidden" class="search-submit" name="post_type" value="product">
</form>
