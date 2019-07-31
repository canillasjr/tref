<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
<meta name="keywords" content="Telderer’s Rainbows End Farm,Rainbows End Farm,Wisconsin Livestock,Livestock breeders,Wisconsin Livestock Breeders,Livestock,Livestock market,Livestock for sale,Livestock supplies,Pasture Raised Chicken,Cattle for sale,Cow for sale,
Pastured Eggs,Family Farm,Pasture Animals,Grass Fed Lamb,Organic Chicken,Pig Meat,Pig Raising,Buy Pigs,Buy Sheep,Buy Honey,Chicken Raising,Chicken Coop,Organic Poultry
">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header container rainbow-header sustainable-container" role="banner">
	<div class="header-container">
		<div class="row menu-head desktop-menu">
			<div class="col-md-2 col-sm-2 logo-container">
				<?php if ( undiscovered_options( 'logotype' ) ) : ?>
					<a class="logotype-img" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo undiscovered_options( 'logotype' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				<?php else : ?>
					<a class="logotype-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="col-md-10 col-sm-10">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php wp_nav_menu(array(
						'container'      => 'ul',
	                    'container_id'   => '',
	                    'menu_class'     => 'dropdown',
	                    'menu_id'        => '',
	                    'depth'          => '',
	                    'theme_location' => 'primary',
	                    'walker'         => '',
					)); ?>
				</nav>
			</div>
		</div>
		<span class="icon-box responsive-menu">
					<?php if ( undiscovered_options( 'logotype' ) ) : ?>
							<a class="logotype-img" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo undiscovered_options( 'logotype' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
						<?php else : ?>
							<a class="logotype-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
				</span>
		<nav class="navbar responsive-menu">
		    <div class="navbar-header">
		    	<!-- <a href="#modal-search" class="search-class pull-right" data-toggle="modal"></a> -->
		    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="menu-text"> MENU </span>
		      	</button>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
					<?php wp_nav_menu(array(
						'container'      => 'ul',
	                    'container_id'   => '',
	                    'menu_class'     => 'nav navbar-nav',
	                    'menu_id'        => '',
	                    'depth'          => '',
	                    'theme_location' => 'primary',
	                    'walker'         => '',
					)); ?>
					<div class="search-container-menu"><a href="#modal-search" class="responsive-search" data-toggle="modal">Search</a></div>
		    </div>
		</nav>
		<div class="row sus-banner">
		<div class="col-md-6 col-sm-12">
		<!-- <?php echo get_template_directory_uri();?>/img/flower.png -->
			<img src="<?php the_field('banner-img'); ?>" class="img-banner-sustainable banner-effect">
		</div>
		<div class="col-md-6 col-sm-12">
			<div class="sustainable-ban-right banner-effect">
				<h1 class="banner-title"><?php the_field('banner_title'); ?></h1>
			<span class="banner-description"><?php the_field('banner_description'); ?></span>
			
			<?php if(is_page(26) || is_page(28) || is_page(1510) || is_page(30) || is_page(1512)){
?>
<a href="<?php echo get_permalink(1800); ?>" class="banner-button">Shop Now!</a>
<?php
				}elseif(is_page(1508)){
					?>
<a href="<?php echo get_permalink(1802); ?>" class="banner-button">Shop Now!</a>
					<?php

				}else{
					?>
<a href="<?php echo get_permalink(46); ?>" class="banner-button">Visit Our Store Now!</a>
					<?php } ?>
			


			</div>
		</div>
		</div>
	</div>
	</header>
	<div id="content" class="site-content container">
<style type="text/css">
.target-hover{
	display: none;
}
	.hover-:hover  a{
		display: flex;
	    position: absolute;
	    top: 0;
	    height: 100%;
	    width: 100%;
	    background: rgba(5,5,2,0.5);
	    color: white;
	    cursor: pointer;
	}
	.hover-:hover  a span{
		    display: block;
		    text-align: center;
		    vertical-align: middle;
		    position: relative;
		    margin: auto auto;
		    font-size: 20px;
	}
</style>