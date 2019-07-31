<?php

session_start();

/**

 * Set the content width based on the theme's design and stylesheet.

 */

if ( ! isset( $content_width ) ) {

	$content_width = 780; /* pixels */

}



/**

 * Customizer additions.

 */

require_once get_template_directory() . '/inc/customizer.php';



/**

 * Custom template tags for this theme.

 */

require_once get_template_directory() . '/inc/template-tags.php';



/**

 * Custom functions that act independently of the theme templates.

 */

require_once get_template_directory() . '/inc/extras.php';



/**

 * Load Jetpack compatibility file.

 */

require_once get_template_directory() . '/inc/jetpack.php';





if ( ! function_exists( 'undiscovered_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 */

function undiscovered_setup() {



	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 * If you're building a theme based on Undiscovered, use a find and replace

	 * to change 'undiscovered' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'undiscovered', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'undiscovered' ),

	) );



	// Enable support for Post Formats.

	add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'quote', 'link' ) );

}

endif; // undiscovered_setup

add_action( 'after_setup_theme', 'undiscovered_setup' );



/**

 * Register widgetized area and update sidebar with default widgets.

 */

function undiscovered_widgets_init() {

	register_sidebar( array(

		'name'          => __( 'Sidebar left', 'undiscovered' ),

		'id'            => 'sidebar-left',

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );



	register_sidebar( array(

		'name'          => __( 'Sidebar right', 'undiscovered' ),

		'id'            => 'sidebar-right',

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

}

add_action( 'widgets_init', 'undiscovered_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function undiscovered_scripts() {

	// wp_enqueue_style( 'undiscovered-font-awesome-min-style', get_template_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_style( 'undiscovered-owl-carousel-min-style', get_template_directory_uri() . '/css/dist/assets/owl.carousel.min.css' );

	wp_enqueue_style( 'undiscovered-owl-theme-defaul-min-style', get_template_directory_uri() . '/css/dist/assets/owl.theme.default.min.css' );

	wp_enqueue_style( 'undiscovered-slicknav-style', get_template_directory_uri() . '/css/slicknav.css' );

	wp_enqueue_style( 'undiscovered-bxslider-style', get_template_directory_uri() . '/css/jquery.bxslider.css' );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );

	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css' );

	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/css/bootstrap-theme.css' );

	wp_enqueue_style( 'bootstrap-theme.min', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );

	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css' );

	// wp_enqueue_style( 'undiscovered-owl-theme-style', get_template_directory_uri() . '/carousel/owl-carousel/owl.theme.css' );

	// wp_enqueue_style( 'undiscovered-owl-transitions-style', get_template_directory_uri() . '/carousel/owl-carousel/owl.transitions.css' );

	// wp_enqueue_style( 'undiscovered-owl-style', get_template_directory_uri() . '/carousel/owl-carousel/owl.carousel.css' );

	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate_.css' );

	$font = str_replace("+", " ", undiscovered_options('font', 'Rokkitt'));

	$protocol = is_ssl() ? 'https' : 'http';

	$query_args = array(

		'family' =>	$font.':400,700'

	);

	wp_enqueue_style('undiscovered-fonts',

		add_query_arg($query_args, "$protocol://fonts.googleapis.com/css" ),

	array(), null);

	

	wp_enqueue_style( 'undiscovered-style', get_stylesheet_uri() );

	



// 	wp_enqueue_style( 'undiscovered-theme-settings-css', get_template_directory_uri() . '/custom.css', array(), null ); 

	$main_color      = undiscovered_options('primary_color', '#E83D52');

	$secondary_color = undiscovered_options('secondary_color', '#BE3243');

	$css = "

		body, button, input {

			font-family: '{$font}', serif;

		}



		a {

			color: {$main_color};

		}

		a:visited, a:hover, a:focus, a:active {

			color: {$secondary_color};

		}



		.slicknav_menu, #main #infinite-handle span, .comment-form .form-submit input {

			background: {$main_color};

		}

		.slicknav_btn, .slicknav_menu li a:hover, .slicknav_nav .slicknav_item:hover {

			background: {$secondary_color};

		}



		.main-navigation a {

			text-shadow: 2px -1px 1px {$secondary_color};

			color: #fff;

		}

		.main-navigation ul ul {

			border-color: {$secondary_color};

		}

		.main-navigation > div > ul > li > a {

			border-bottom: 1px solid {$main_color};

		}

		.main-navigation > div > ul > li:hover > a {

			border-bottom: 1px solid {$secondary_color};

		}

		.main-navigation ul ul a:hover {

			color: {$secondary_color};

		}



		.entry-content blockquote, 

		.format-link .entry-content p:first-child,

		#main #infinite-handle span,

		.comment-form .form-submit input {

			border-color: {$secondary_color};

		}

		.entry-content blockquote:before {

			color: {$secondary_color};

		}



		#main #infinite-handle span, .comment-form .form-submit input {

			text-shadow: 2px -1px 1px {$secondary_color};

		}



		#site-navigation {

			background: {$main_color};

			border-top-color: {$secondary_color};

		}

	";

	wp_add_inline_style( 'undiscovered-theme-settings-css', $css );



	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'undiscovered-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script(

		'undiscovered-bxslider',

		get_template_directory_uri() . '/js/jquery.bxslider.min.js',

		array( 'jquery' )

	);

	wp_enqueue_script(

		'undiscovered-slicknav-script',

		get_template_directory_uri() . '/js/jquery.slicknav.min.js',

		array( 'jquery' )

	);


	wp_enqueue_script(

		'undiscovered-uitotop-script',

		get_template_directory_uri() . '/js/jquery.ui.totop.js',

		array( 'jquery' )

	);

	wp_enqueue_script(

		'undiscovered-main-script',

		get_template_directory_uri() . '/js/main.js',

		array( 'jquery' )

	);

	wp_enqueue_script(

		'custom-js',

		get_template_directory_uri() . '/js/custom.js',

		array( 'jquery' )

	);

	wp_enqueue_script(

		'undiscovered-jssor-script',

		get_template_directory_uri() . '/js/jssor/jssor.js',

		array( 'jquery' )

	);



	wp_enqueue_script(

		'undiscovered-jssor-slider-script',

		get_template_directory_uri() . '/js/jssor/jssor.slider.js',

		array( 'jquery' )

	);



	wp_enqueue_script(

		'undiscovered-jssor-slider-min-script',

		get_template_directory_uri() . '/js/jssor/jssor.slider.min.js',

		array( 'jquery' )

	);

	wp_enqueue_script(

		'bootstrap.min',

		get_template_directory_uri() . '/js/bootstrap.min.js',

		array( 'jquery' )

	);


	wp_enqueue_script(

		'undiscovered-owl-carousel-min',

		get_template_directory_uri() . '/css/dist/owl.carousel.min.js',

		array( 'jquery' )

	);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'undiscovered_scripts' );



add_filter( 'use_default_gallery_style', '__return_false' );



add_filter('body_class', 'add_logged_out_body_class');

function add_logged_out_body_class($classes) {

	if (! is_user_logged_in())

		$classes[] = 'logged-out';



	return $classes;

}

function register_my_menus() {

 register_nav_menus(

   array(

     'Sustainable_Husbandry-menu' => __( 'Sustainable Husbandry' ),

     'Organic_Blogs-menu' => __( 'Organic Blogs' ),

     'Online Store-menu' => __( 'Online Store' )

   )

 );

}

add_action( 'init', 'register_my_menus' );



add_filter('wp_nav_menu_items','add_todaysdate_in_menu', 10, 2);

function add_todaysdate_in_menu( $items, $args ) {

    global $woocommerce;

							// echo '<pre>';

							// print_r($woocommerce);



							// get cart quantity

							$qty = $woocommerce->cart->get_cart_contents_count();



							// get cart total

							$total = $woocommerce->cart->get_cart_total();



							// get cart url

							$cart_url = WC_Cart::get_cart_url();



							// if multiple products in cart

							if($qty>1){

								

								$display = $qty;



							// if single product in cart

							}elseif($qty==1){

							

								$display = 1;

							

							}else{

								

								$display = 0;

								

							}



    if( $args->theme_location == 'primary')  {

			$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page hidden-xs"><a href="#modal-search" class="search-class" data-toggle="modal"><span class="search-insert glyphicon glyphicon-search" aria-hidden="true"></span></a><a href="'.$cart_url.'"class="cart-link" style="display:none !important;"><span class="view-cart"></span><span class="count-cart">('.$display.')</span></a></li>';

		}

    return $items;

}



// comment text-area move to bottom

function wpb_move_comment_field_to_bottom( $fields ) {

	$comment_field = $fields['comment'];

	unset( $fields['comment'] );

	$fields['comment'] = $comment_field;

	return $fields;

} 

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );


add_action('wp_ajax_addCart' , 'addCart');

add_action('wp_ajax_nopriv_addCart' , 'addCart');



function addCart(){

	global $woocommerce;

	$product_id = $_POST['product_id'];

	$woocommerce->cart->add_to_cart($product_id);

	echo $woocommerce->cart->get_cart_contents_count();

	die();

}



function reload_cart(){

	global $woocommerce;

	echo $woocommerce->cart->get_cart_contents_count();

	die();

}



function comment_validation_init() {

 if(is_single() && comments_open() ) { ?>

		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

		<script type="text/javascript">

			jQuery(document).ready(function($) {

				$('#commentform').validate({



					rules: {

						author: {

							required: true,

							minlength: 2

						},



						email: {

							required: true,

							email: true

						},



						comment: {

							required: true,

						}

					},



					messages: {

						author: "Please fill the required field",

						email: "Please enter a valid email address.",

						 comment: "Please fill the required field"

					},



					errorElement: "div",

					errorPlacement: function(error, element) {

						element.after(error);

					}



				});

			});

		</script>

		<?php

	}

}

add_action('wp_footer', 'comment_validation_init');





 		$labels = null;



		$labels = array(



		 'name'               => _x( 'Rainbows End Boutique', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'Rainbows End Boutique', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'Rainbows End Boutique', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'Rainbows End Boutique', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'Rainbows End Boutique', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New Rainbows End Boutique Post', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New Rainbows End Boutique Post', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit Rainbows End Boutique Post', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View Rainbows End Boutique Post', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All Rainbows End Boutique Post', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search Rainbows End Boutique Post', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent Rainbows End Boutique Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No Rainbows End Boutique Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No Rainbows End Boutique Post found in Trash.', 'your-plugin-textdomain' )



		);



		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'rainbows-end-boutique' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'rainbowsEndBoutique', $args );



		 $labels = null;



		$labels = array(



		 'name'               => _x( 'Sheep Slider', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'Sheep Slider', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'Sheep Slider', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'Sheep Slider', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'Sheep Slider', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New Sheep Slider', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New Sheep Slider', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit Sheep Slider Post', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View Sheep Slider Post', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All Sheep Slider Post', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search Sheep Slider Post', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent Sheep Slider Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No Sheep Slider Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No Sheep Slider Post found in Trash.', 'your-plugin-textdomain' )



		);



		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'sheep-slider' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'sheepslider', $args );



		 $labels = null;



		$labels = array(



		 'name'               => _x( 'Special Events', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'Special Events', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'Special Events', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'Special Events', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'Special Events', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New Special Events', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New Special Events', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit Special Events Post', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View Special Events Post', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All Special Events Post', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search Special Events Post', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent Special Events Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No Special Events Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No Special Events Post found in Trash.', 'your-plugin-textdomain' )



		);



		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'special-events' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'specialevents', $args );



		  $labels = null;



		$labels = array(



		 'name'               => _x( 'Sustainable Tips', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'Sustainable Tips', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'Sustainable Tips', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'Sustainable Tips', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'Sustainable Tips', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New Sustainable Tips', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New Sustainable Tips', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit Sustainable Tips Post', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View Sustainable Tips Post', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All Sustainable Tips Post', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search Sustainable Tips Post', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent Sustainable Tips Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No Sustainable Tips Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No Sustainable Tips Post found in Trash.', 'your-plugin-textdomain' )



		);



		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'sustainable-tips' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'sustainable_tips', $args );



		 $labels = null;



		$labels = array(



		 'name'               => _x( 'Poultry', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'Poultry', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'Poultry', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'Poultry', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'Poultry', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New Poultry', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New Poultry', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit Poultry', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View Poultry', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All Poultry', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search Poultry', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent Poultry Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No Poultry Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No Poultry Post found in Trash.', 'your-plugin-textdomain' )



		);

		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'poultry-sub' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'poultry_sub', $args );



		  $labels = null;



		$labels = array(



		 'name'               => _x( 'HoneyBee', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'HoneyBee', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'HoneyBee', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'HoneyBee', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'HoneyBee', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New HoneyBee', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New HoneyBee', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit HoneyBee', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View HoneyBee', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All HoneyBee', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search HoneyBee', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent HoneyBee Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No HoneyBee Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No HoneyBee Post found in Trash.', 'your-plugin-textdomain' )



		);

		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'honeybee-sub' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'honeybee_sub', $args );



		  $labels = null;



		$labels = array(



		 'name'               => _x( 'Pigs', 'post type general name', 'your-plugin-textdomain' ),



		 'singular_name'      => _x( 'Pigs', 'post type singular name', 'your-plugin-textdomain' ),



		 'menu_name'          => _x( 'Pigs', 'admin menu', 'your-plugin-textdomain' ),



		 'name_admin_bar'     => _x( 'Pigs', 'add new on admin bar', 'your-plugin-textdomain' ),



		 'add_new'            => _x( 'Add New', 'Pigs', 'your-plugin-textdomain' ),



		 'add_new_item'       => __( 'Add New Pigs', 'your-plugin-textdomain' ),



		 'new_item'           => __( 'New Pigs', 'your-plugin-textdomain' ),



		 'edit_item'          => __( 'Edit Pigs', 'your-plugin-textdomain' ),



		 'view_item'          => __( 'View Pigs', 'your-plugin-textdomain' ),



		 'all_items'          => __( 'All Pigs', 'your-plugin-textdomain' ),



		 'search_items'       => __( 'Search Pigs', 'your-plugin-textdomain' ),



		 'parent_item_colon'  => __( 'Parent Pigs Post:', 'your-plugin-textdomain' ),



		 'not_found'          => __( 'No Pigs Post found.', 'your-plugin-textdomain' ),



		 'not_found_in_trash' => __( 'No Pigs Post found in Trash.', 'your-plugin-textdomain' )



		);

		 $args = null;



			$args = array(

			 'menu_icon' => 'dashicons-media-text',



			 'labels'             => $labels,



			 'description'        => __( 'Description.', 'your-plugin-textdomain' ),



			 'public'             => true,



			 'publicly_queryable' => true,



			 'show_ui'            => true,



			 'show_in_menu'       => true,



			 'query_var'          => true,



			 'rewrite'            => array( 'slug' => 'pig-sub' ),



			 'capability_type'    => 'post',



			 'has_archive'        => true,



			 'hierarchical'       => false,



			 'menu_position'      => null,



			 'supports'           => array( 'title','editor', 'thumbnail','custom-fields' )



			);

		 register_post_type( 'pig_sub', $args );



add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );





// Beboy added Custom fields Variation



// Add Variation Settings

add_action( 'woocommerce_product_after_variable_attributes', 'variation_settings_fields', 10, 3 );



// Save Variation Settings

add_action( 'woocommerce_save_product_variation', 'save_variation_settings_fields', 10, 2 );



/**

 * Create new fields for variations

 *

*/

function variation_settings_fields( $loop, $variation_data, $variation ) {



	// Text Field

	woocommerce_wp_text_input(

		array(

			'id'          => '_variation_title[' . $variation->ID . ']',

			'label'       => __( 'Title', 'woocommerce' ),

			'placeholder' => 'Title',

			'desc_tip'    => 'true',

			'description' => __( 'Enter the custom value here.', 'woocommerce' ),

			'value'       => get_post_meta( $variation->ID, '_variation_title', true )

		)

	);





	// Text Field

	woocommerce_wp_text_input(

		array(

			'id'          => '_variation_asin[' . $variation->ID . ']',

			'label'       => __( 'ASIN', 'woocommerce' ),

			'placeholder' => 'ASIN',

			'desc_tip'    => 'true',

			'description' => __( 'Enter  ASIN here.', 'woocommerce' ),

			'value'       => get_post_meta( $variation->ID, '_variation_asin', true )

		)

	);





	// Hidden field

	woocommerce_wp_hidden_input(

	array(

		'id'    => '_hidden_field[' . $variation->ID . ']',

		'value' => 'hidden_value'

		)

	);



}



/**

 * Save new fields for variations

 *

*/

function save_variation_settings_fields( $post_id ) {



	// Text Field

	$title_field = $_POST['_variation_title'][ $post_id ];

	if( ! empty( $title_field ) ) {

		update_post_meta( $post_id, '_variation_title', esc_attr( $title_field ) );

	}



	// Text Field

	$asin_field = $_POST['_variation_asin'][ $post_id ];

	if( ! empty( $asin_field ) ) {

		update_post_meta( $post_id, '_variation_asin', esc_attr( $asin_field ) );

	}





	// Hidden field

	$hidden = $_POST['_hidden_field'][ $post_id ];

	if( ! empty( $hidden ) ) {

		update_post_meta( $post_id, '_hidden_field', esc_attr( $hidden ) );

	}



}



// Add New Variation Settings

add_filter( 'woocommerce_available_variation', 'load_variation_settings_fields' );

/**

 * Add custom fields for variations

 *

*/

function load_variation_settings_fields( $variations ) {



	// duplicate the line for each field

	$variations['title_field'] = get_post_meta( $variations[ 'variation_id' ], '_variation_title', true );

	$variations['asin_field'] = get_post_meta( $variations[ 'variation_id' ], '_variation_asin', true );



	return $variations;

}



add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            // < 2.1

add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  // 2.1 +

  

function woo_custom_product_add_to_cart_text() {

  

    return __( 'Add to Cart', 'woocommerce' );

  

}



// Shop random order. View settings drop down order by Woocommerce > Settings > Products > Display

add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );

function custom_woocommerce_get_catalog_ordering_args( $args ) {

    $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

    if ( 'random_list' == $orderby_value ) {

        $args['orderby'] = 'rand';

        $args['order'] = '';

        $args['meta_key'] = '';

    }

    return $args;

}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );

add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );

function custom_woocommerce_catalog_orderby( $sortby ) {

    $sortby['random_list'] = 'Random';

    return $sortby;

}



add_image_size( 'gallery-size', 374, 394, true );

add_image_size( 'blog-post-size', 490, 506, true );

add_image_size( 'single-post-size', 746, 443, true );

add_image_size( 'product-woo-size', 289, 270, true );



add_image_size( 'on-image', 551, 466);





function advanced_search_query($query) {



    if($query->is_search()) {

        // category terms search.

        if (isset($_GET['category']) && !empty($_GET['category'])) {

            $query->set('tax_query', array(array(

                'taxonomy' => 'product_cat',

                'field' => 'slug',

                'terms' => array($_GET['category']) )

            ));

        }



    }    



    return $query;

}

add_action('pre_get_posts', 'advanced_search_query', 1000);







/**



 * Allows RSIS to set WooCommerce shipment tracking fields



 */



add_filter('is_protected_meta', 'rsis_is_protected_meta_filter', 10, 2);



function rsis_is_protected_meta_filter($protected, $meta_key) {



    switch ($meta_key) {



        case '_tracking_number':



        case '_tracking_provider':



        case '_custom_tracking_provider':



        case '_custom_tracking_link':



        case '_date_shipped':



            return false;



        default:



            return $protected;



    }



}



