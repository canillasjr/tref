<?php get_header() ?>
<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous">
<style type="text/css">
	.gallery-title{
		font-size: 35px;
	    text-align: center;
	    color: #3c2415;
	    padding: 25px;
	}
	.photo-gallery-container{
		background-color: white;
	}
	.images-gallery{
		max-width: 1500px;
    	padding: 10px 68px;
    	margin: 0 auto;
	}
	.nav-container{
		    position: absolute;
	    top: 45%;
	    width: 98%;
	    margin-left: -2%;
	}
	.prev-gal{
		display: inline-block;
    	float: left;
    	font-size: 38px;
	    width: 57px;
	    text-align: center;
	    border-radius: 50%;
	    background: white;
	    cursor: pointer;
	}
	.next-gal{
		display: block;
    	float: right;
    	font-size: 38px;
	    width: 57px;
	    text-align: center;
	    border-radius: 50%;
	    background: white;
	    cursor: pointer;
	}
	.fa.fa-angle-left{
		line-height: 0px;
	    font-size: 50px;
	}
	.fa.fa-angle-right{
		line-height: 0px;
	    font-size: 50px;
	}
	.modal-dialog.modal-lg{
		margin: 0 auto !important;
	}
	.modal-open #image-gallery{
		display: flex !important;
    	align-items: center;
    	padding-right: 0 !important;
	}
	.close:focus,
	.close:visited,
	.close:active,
	.close:hover,
	.close{
		font-size: 36px;
	    position: absolute;
	    right: -18px;
	    top: -16px;
	    background: white;
	    width: 40px;
	    text-align: center;
	    border-radius: 53%;
	    display: block;
	    text-shadow: none;
	    opacity: 1;
	    color: gray !important;
	    border: 2px solid white;
	}
	.zoom-gal{

	}
	.borderthumbnail:hover img{
		  -webkit-transition: all 0.5s linear;
          transition: all 0.5s linear;
          -webkit-transform: scale3d(1.2, 1.2, 1);
          transform: scale3d(1.2, 1.2, 1);

	}
	@media screen and (max-width: 520px){
		.next-gal,.prev-gal{
		    background: rgba(0, 0, 0, 0.5);
		    font-size: 28px;
		    width: 45px;
		}
		.fa.fa-angle-left , .fa.fa-angle-right {
		    font-size: 35px;
   			color: white;
		}
	}
</style>
<div class="photo-gallery-container">
	<div class="gallery-title"><?php the_title() ?></div>
	<div class="images-gallery">
		<?php 

$images = get_field('gallery-images');

if( $images ): ?>
    <div class="row galery-cont">
        <?php foreach( $images as $image ): ?>
            <div class="col-md-4 col-sm-6 col-xs-12" style="padding: 10px !important; overflow: hidden;">
                <a class="borderthumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $image['title']; ?>" data-caption="<?php echo $image['caption']; ?>" data-image="<?php echo $image['url']; ?>" data-target="#image-gallery">
     	 <img width="100%"  src="<?php echo $image['sizes']['gallery-size']; ?>" alt="">
     </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
	</div>
</div>

	<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-body img-responsive" style="padding: 3% !important">
	                <a href="#" class="close" data-dismiss="modal">×</a>
	                <!--h4 class="modal-title title-gallery" id="image-gallery-title"></h4-->
	                <img id="image-gallery-image" class="img-responsive" src="">
	                <div class="nav-container">
	                	<div class="prev-gal" id="show-previous-image"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
	                	<div class="next-gal" id="show-next-image"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
<style type="text/css">
	.subscribe-container{
		display: none !important;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {

 
		 loadGallery(true, 'a.borderthumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current){
        $('#show-previous-image, #show-next-image').show();
        if(counter_max == counter_current){
            $('#show-next-image').hide();
        } else if (counter_current == 1){
            $('#show-previous-image').hide();
        }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr){
        var current_image,
            selector,
            counter = 0;

        $('#show-next-image, #show-previous-image').click(function(){
            if($(this).attr('id') == 'show-previous-image'){
                current_image--;
            } else {
                current_image++;
            }

            selector = $('[data-image-id="' + current_image + '"]');
            updateGallery(selector);
        });

        function updateGallery(selector) {
            var $sel = selector;
            current_image = $sel.data('image-id');
            $('#image-gallery-caption').text($sel.data('caption'));
            $('#image-gallery-title').text($sel.data('title'));
            $('#image-gallery-image').attr('src', $sel.data('image'));
            disableButtons(counter, $sel.data('image-id'));
        }

        if(setIDs == true){
            $('[data-image-id]').each(function(){
                counter++;
                $(this).attr('data-image-id',counter);
            });
        }
        $(setClickAttr).on('click',function(){
            updateGallery($(this));
        });
    }
	});
</script>
<?php get_footer() ?>