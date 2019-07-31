<style>
p.demo_store {
    padding: 7px;
}

.header-container .logotype-img > img{
        margin-top: 31px;
}

#modal-search .col-md-12 > a > img{
        margin: 50px auto 0 auto;
            max-width: 200px;
}
</style>

<?php if(1528 != $post->ID){ ?>
<script type="text/javascript" src="https://www.telderersrainbowsendfarm.com/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js"></script>
<script type="text/javascript" src="https://www.telderersrainbowsendfarm.com/wp-content/plugins/contact-form-7/includes/js/scripts.js"></script>
<?php } ?>
<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      	<div class="row">
		<img src="<?php echo get_template_directory_uri(); ?>/img/form-logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo-form" />
			<?php echo do_shortcode('[contact-form-7 id="1570" title="application form"]'); ?>
		</div>
      </div>
    </div>
 </div>
<style type="text/css">
	.modal-custom{
		width: 89% !important;
	}
</style>
 <div class="modal fade" id="order-form" role="dialog">
    <div class="modal-dialog modal-lg modal-custom">
      <div class="modal-content">
      	<div class="row">
		<section class="order-form" style="background: white;">
		<div class="form-container">
			<div class="form-title">Meat Order Form</div>
			<div class="form-sub">Meat Chickens, Turkeys, Pigs & Lambs.</div>
			<?php echo do_shortcode('[contact-form-7 id="1568" title="Order Form"]'); ?>
		</div>
		</section>
		</div>
      </div>
    </div>
 </div>

 <div class="modal fade" id="modal-vid" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
         <video width="100%" controls>
		  <source src="<?php echo get_template_directory_uri(); ?>/VID_20160924_174414977.mp4" type="video/mp4">
		</video>
        </div>
      </div>
      
    </div>
  </div>
   <div class="modal fade" id="modal-application" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:764px !important;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">

         <!-- <style type="text/css">
  form.cpp_form{
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    font-size: 15px;
    font-weight: bold;
    color: #554466;
  }
  #cal1Container_0,
  #cal1Container{
    width: 100%;
  }
  form.cpp_form textarea,
  form.cpp_form input:not(.cp_subbtn){
    width: 100%;
    margin-bottom: 15px;
    font-size: 15px;
    font-family: "Open sans";
    font-weight: normal;
    padding: 5px 9px !important;
  }
  .restricted{
    text-align: center !important;
    background: red;
    color: white !important;
    line-height: normal !important;
    font-family: "Open sans" !important;
  }
  .oom{
    line-height: normal !important;
    font-family: "Open sans" !important;
  }
  .cp_subbtn{
    margin: 0 auto;
    width: 235px;
    display: block;
    background: #bc89d1!important;
    padding: 20px 0 !important;
    text-align: center;
    color: white !important;
    margin-top: 0px !important;
    margin-bottom: 40px;
    text-decoration: none;
    text-shadow: none !important;
    font-size: 15px !important;
    font-family: "open sans";
    box-shadow: none !important;
    outline: none !important;
    border: none !important;
  }
  .calhead,
  .calheader{
    font-size: 35px !important;
    position: inherit !important;
    top: 0;
    line-height: normal !important;
    font-family: "Open sans" !important;
    background: #554466 !important;
    color: white !important;
    margin: 0;
    padding: 0;
  }
  .calweekdaycell{
    font-size: 20px !important;
    line-height: normal !important;
    font-family: "Open sans" !important;
    color: #554466 !important;
  }
  .calbody .selectable{
    line-height: normal !important;
    font-family: "Open sans" !important;
    color: #554466 !important;
  }
  #listcal1{
    background: transparent;
    padding: 10px 5px;
  }
  #listcal1 > div{
    display: inline-block;
  }
  .calheader > a{
    position: absolute !important;
    top: 17px !important;
  }
  .reservation-header{
    text-align: center;
    font-size: 35px;
    color: #554466;
    font-weight: bold;
  }
  .yui-panel-container.yui-dialog.yui-simple-dialog.shadow{
    z-index: 2147483647 !important;
  }
  
</style> -->
<style type="text/css">
  .mc_bottomnav{display: none}
  input[type="text"],input[type="email"]{
    width: 100%;
  }
  #wpcf7-f2719-o3 > form > div:nth-child(8){
        display: inline-block;
  }
  #wpcf7-f2719-o3 > form > div:nth-child(9){
        display: inline-block;
      margin-top: 15px;
      margin-left: 14px;
  }
  .span {
    line-height: 32px;
}
  #wpcf7-f2719-o3 .wpcf7-submit{
    margin: 0 auto;
    width: 235px;
    display: block;
    background: #bc89d1!important;
    padding: 20px 0 !important;
    text-align: center;
    color: white !important;
    margin-top: 0px !important;
    margin-bottom: 40px;
    text-decoration: none;
    text-shadow: none !important;
    font-size: 15px !important;
    font-family: "open sans";
    box-shadow: none !important;
    outline: none !important;
    border: none !important;
    margin-top: 40px !important;
  }
</style>
<div class="reservation-header">Reservation</div>
<?php echo do_shortcode('[my_calendar id="my-calendar"]'); ?>
<?php //echo do_shortcode(' [CPABC_APPOINTMENT_CALENDAR calendar="1"]'); ?>
<?php echo do_shortcode(' [contact-form-7 id="2719" title="Schedule form"]'); ?>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">

    var array = ["2017-07-15","2017-07-16","2017-07-17","2017-07-18","2017-07-19","2017-07-20","2017-07-21","2017-07-22","2017-07-23","2017-07-24","2017-07-25","2017-07-26","2017-07-27","2017-07-28","2017-07-29","2017-07-30","2017-07-31"]


jQuery('#date,#datef').datepicker({
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ array.indexOf(string) == -1 ]
    }
});
  </script>

	<!-- Modal fullscreen -->

			<div class="modal modal-fullscreen fade" id="modal-search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header">

							<div class="row">
								<span aria-hidden="true" class="close" data-dismiss="modal">&times;</span>
								<div class="col-md-12">
									<a class="logotype-img img-responsive"  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

										<img src="<?php echo undiscovered_options( 'logotype' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />

									</a>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-12">

								<div class="modal-body">

									<div class="site-search">

										<?php get_search_form(); ?>

									</div>

								</div>

							</div>

						</div>

						<div class="row">

							<div class="col-md-12">

								<div class="modal-social">

									<?php social_icons_list(); ?>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>





	</div><!-- #content -->
	<style type="text/css">
		
	</style>
	<div class="subscribe-container">
		<div  id="contact-slide"  class="contact pull-right">
		<div class="slide-content">
			<?php echo do_shortcode('[contact-form-7 id="232" title="Subscribe"]'); ?>
		</div>
		</div>
		<div class="subscribe-box">
			<div class="sub-col-txt"><span class="subscribe-text">Receive exclusive promotions, new products, and links to our monthly ad!</span></div>
			<div class="sub-col-btn"><button data-toggle="toggle" data-target="#contact-slide" class="subscribe-button">Subscribe Now!</button></div>
		</div>
	</div>
	<footer id="colophon" class="site-footer container" role="contentinfo">
	<div class="footer-container">
	<div class="row">
		<div class="logo-menu-container">
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="footer-logo"> 
				<?php if ( undiscovered_options( 'logotype' ) ) : ?>
					<a class="logotype-img" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo undiscovered_options( 'logotype' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
				<?php else : ?>
					<a class="logotype-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="social-icons">
				<?php social_icons_list(); ?>
			</div>
		</div>
		<div class="col-md-9">
			<div class="col-md-4 col-sm-12 col-xs-12"><?php wp_nav_menu( array('theme_location' => 'Sustainable_Husbandry-menu')) ?></div>
			<div class="col-md-4 col-sm-12 col-xs-12"><?php wp_nav_menu( array('theme_location' => 'Organic_Blogs-menu')) ?></div>
			<div class="col-md-4 col-sm-12 col-xs-12"><?php wp_nav_menu( array('theme_location' => 'Online Store-menu')) ?></div>
		</div>
		</div>
		<div class="copyright-container row">
		<div class="col-md-4 col-sm-12 col-xs-12">
			<span class="copyright">Copyright <?php echo date("Y"); ?>. <a href="<?php echo get_site_url(); ?>" class="link-name">telderersrainbowsendfarm.com</a></span>
		</div>
		<div class="col-md-4 col-sm-12 col-xs-12">
			<span class="copyright"><a class="link-bold" href="https://junespringmultimedia.com" target="_blank">Logo Design</a> and <a class="link-bold" href="https://junespringmultimedia.com" target="_blank">Website Design</a> by <span class="link-name">June Spring Multimedia</span></span>
		</div>
		<div class="col-md-4 col-sm-12 col-xs-12">
			<span class="copyright"><a class="link-bold" target="_blank" href="https://junespringmultimedia.com/web-hosting/">Web Hosting</a> by <span class="link-name">June Spring Multimedia</span></span>
		</div>
		</div>
		</div>
	</div>

	</footer>
</div><!-- #page -->
<span data="<?php echo get_template_directory_uri(); ?>" id="directory-url"></span>

<?php wp_footer(); ?>
</body>
</html>
