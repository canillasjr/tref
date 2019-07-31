<?php get_header() ?>
<?php //require_once("".$_SERVER['SERVER_NAME']."\wp-content\themes\undiscovered\php\localpickup.php"); 
	  include(dirname(__FILE__).'/php/localpickup.php');
		$local = new local_pickup();

?>
<?php 
if(isset($_POST['sku'])){
if (empty($_SESSION['sessionholder'])) {
	
	function randomstring() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
    	return implode($pass); //turn the array into a string
	}
 	$_SESSION['sessionholder'] = randomstring();
 	$data = array(
			'Sessionholder' => $_SESSION['sessionholder'],
			'quantity' => 1,
			'name' => $_POST['pname'],
			'item' => $_POST['sku'],
			'invoice' => $_SESSION['sessionholder'],
			'price' => $_POST['price']
		);
		$local->insert('local_pick',$data);
}else{
	
		if($local->compare_sku('local_pick' , $_SESSION['sessionholder'] , $_POST['sku']) == false){
		$data = array(
			'Sessionholder' => $_SESSION['sessionholder'],
			'quantity' => 1,
			'name' => $_POST['pname'],
			'item' => $_POST['sku'],
			'invoice' => $_SESSION['sessionholder'],
			'price' => $_POST['price']
		);
		$local->insert('local_pick',$data);
		}
	}
}
?>

<style type="text/css">
.body-t .glyphicon{
	cursor: pointer;
}
	.subscribe-container{
		display: none !important;
	}
	section{
		background: white;
	}
	table{
		    background: white;
		    max-width: 1093px !important;
		    margin: 0 auto !important;
		    border: 1px solid #ddd;
		    font-size: 15px;
	}
	.title-t{
		font-size: 45px;
	    text-align: center;
	    color: #554466;
	    font-weight: bold;
	    padding-top: 23px;
	}
	.sub-t{
		text-align: center;
	    font-size: 21px;
	    color: #554466;
	}
	.t-t{
		text-align: center;
	    margin-bottom: 49px;
	    font-size: 16px;
	    color: #554466;
	}
	th{
		color: #554466 !important;
	}
	a.btn-submit-t {
	    background: #bc89d1;
	    margin: 34px 10px;
	    display: inline-block;
	    width: 200px;
	    text-align: center;
	    color: white;
	    padding: 18px 5px;
	    font-size: 15px;
	}
	.btn-container{
		text-align: center;
	}
	.quantity-con{
		position: relative;
	}
	button.btn-submit-t {
    background: #bc89d1;
    margin: 34px 10px;
    display: inline-block;
    width: 200px;
    text-align: center;
    color: white;
    padding: 21px 5px;
    font-size: 15px;
    box-shadow: none;
    font-family: 'Open Sans' !important;
	}
</style>

<section >
<div class="title-t">Product Order</div>
<div class="sub-t">Telderer's Rainbows End Farm, LLC</div>
<div class="t-t">Where the Best of Nature is Nurtured</div>
<input type="hidden" name="ses" id="ses" value="<?php echo $_SESSION['sessionholder'] ?>" >

<div id="container-section-ajax">
	<table  class="table table-striped" style="margin-bottom: 10px !important;">
	<tr><th>Salesperson</th><th>Job</th><th>Shipping Method</th><th>Delivery Date</th><th>Restock Fee</th><th>Order Deposit</th></tr>
	<tr><td></td><td></td><td>Local Pickup Only</td><td></td><td>25%</td><td>~ 10%</td></tr>
	</table>
	<table class="table table-striped table-responsive">
		<tr class="head-t">
			<th>Action</th>
			<th>Qty</th>
			<th>Item #</th>
			<th>Description</th>
			<th>Unit Price per Pound</th>
			<th>Deposit & Restock Fee</th>
			<th>Line Total</th>
		</tr>
		<?php $result = $local->show('local_pick' , $_SESSION['sessionholder'] ); ?>
		<?php while($row = mysqli_fetch_array($result)){ ?>
		<tr class="body-t">
			<td><i class="glyphicon glyphicon-edit" data-id="<?php echo $row['id'] ?>"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-trash" data-id="<?php echo $row['id'] ?>"></i></td>
			<td class="quantity-con"><?php echo $row['quantity'] ?></td>
			<td><?php echo $row['item'] ?></td>
			<td><?php echo $row['name'] ?></td>
			<td data-price="<?php echo $row['price'] ?>" id="price-l">$ <span></span></td>
			<td id="dr-data"></td>
			<td id="l-data"></td>
		</tr>
		<?php } ?>
		<tr>
			<td></td><td></td><td></td><td></td><td>Total Deposit:</td><td id="total-dp"></td><td></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td>Subtotal</td><td -d="sub-t"></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td>Sales Tax</td><td id="tax-t"></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td>Total</td><td id="total-to"></td>
		</tr>
	</table>
</div>

	<div class="btn-container"><a href="javascript:void(0)" data-target="#submit" data-toggle="modal" class="btn-submit-t">Submit</a><button class="btn-submit-t cancel">Cancel</button><a href="http://www.telderersrainbowsendfarm.com/online-store/" class="btn-submit-t">Continue Shopping</a></div>
</section>

<!-- ajax -->
<script type="text/javascript">

	
		jQuery(document).ready(function(){
		
		//update trigger keyup

		

		// price
		jQuery('.body-t #price-l').each(function(){
			 var rprice = parseFloat(jQuery(this).attr('data-price'));
			 var quantity = parseFloat(jQuery(this).parent().find('.quantity-con').text());
			 jQuery(this).find('span').text(rprice);
			 jQuery(this).attr('data-price', rprice/quantity);
			 
		})
		// edit
		jQuery(document).on('click' , '.glyphicon.glyphicon-edit' , function(e){
			e.preventDefault();
			var type = "update";
			var select = jQuery(this).parent().find('+ td');
			var num = jQuery(this).parent().find('+ td').text();
			jQuery(this).removeClass('glyphicon-edit');
			jQuery(this).addClass('glyphicon-check');

			jQuery.post('http://www.telderersrainbowsendfarm.com/wp-content/themes/undiscovered/php/form-submit.php',{type:type,num:num},function(data){
				console.log(data);
				select.html(data);
				jQuery('#keyup-event').keyup(function(){
					var nnum = jQuery(this).val();
					if(nnum < 1){
						alert("Must Insert Value 1 above");
						jQuery(this).val(1);
								
					}else{
						var select = jQuery(this).parent().parent().parent().find('#price-l > span');
						var cprice = jQuery(this).parent().parent().parent().find('#price-l').attr('data-price');
						var nprice = parseFloat(nnum) * parseFloat(cprice);
						select.text("$ "+ nprice.toFixed(2) );
					 	jQuery(this).parent().parent().parent().find('#price-l span').text(nprice.toFixed(2));
					}
				});
			});
		});
		// update submit
		jQuery(document).on('click' , '.glyphicon.glyphicon-check' , function(e){
			var type = "edit";
			var select = jQuery(this).parent().find('+ td');
			var id = jQuery(this).attr('data-id');
			var pricenew = jQuery(this).parent().find('+ td + td + td + td#price-l > span').text();
			var num = jQuery(this).parent().find('+ td .update-form input').val();
			jQuery(this).removeClass('glyphicon-check');
			jQuery(this).addClass('glyphicon-edit');
			console.log(id);
			jQuery.post('http://www.telderersrainbowsendfarm.com/wp-content/themes/undiscovered/php/form-submit.php',{type:type,num:num,id:id,pricenew:pricenew},function(data){
				select.html(data);
				console.log(data);
			});
		});
		// delete
		jQuery(document).on('click' , '.glyphicon.glyphicon-trash' , function(e){
			var txt;
			var r = confirm("Are you sure you want to delete this item?");

			if (r == true) {
				var id = jQuery(this).attr('data-id');
			   var type = "delete";
			   var select = jQuery(this).parent().parent();
			   	console.log(id);
			   jQuery.post('http://www.telderersrainbowsendfarm.com/wp-content/themes/undiscovered/php/form-submit.php',{type:type,id:id},function(data){
			   	console.log(data);
				select.remove();
			
			});

			} else {
			    

			}
		});
		//deleteAll
		jQuery(document).on('click' , '.btn-submit-t.cancel' , function(e){
			var txt;
			var r = confirm("Are you sure you want to delete this item?");
			if (r == true) {
				var session = jQuery('#ses').val();
			   var type = "deleteAll";
			   var select = jQuery(this).parent().parent();
			   console.log(session);
			   jQuery.post('http://www.telderersrainbowsendfarm.com/wp-content/themes/undiscovered/php/form-submit.php',{type:type,session:session},function(data){
			   	console.log(data);
				//select.remove();
				window.location.href = "http://www.telderersrainbowsendfarm.com/order-local-pick-ups/";
			
				});

			} else {
			    

			}
		});
	});
</script>




<div id="submit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <style type="text/css">
	.form-container-a{
		max-width: 806px;
   		margin: 0 auto;
	}
	.head{
		font-size: 20px;
	    font-weight: bold;
	    color: #554466;
	    padding-bottom: 11px;
	}
	.l-txt{
		font-size: 15px;
    	color: #554466;
	}
	.submit-btn{
		width: 100%;
	    text-align: center;
	    color: white !important;
	    font-size: 15px !important;
	    font-family: inherit;
	    max-width: 200px;
	    margin: 0 auto;
	    display: block;
	    padding: 20px 5px !important;
	    border: none !important;
	    background: #bc89d1 !important;
	    text-shadow: none !important;
	    box-shadow: none !important;
	    margin-top: 15px !important;

	}input{
		font-family: inherit !important;
	}
</style>
<div class="form-container-a">
	<form target="_blank" class="" method="post" action="http://www.telderersrainbowsendfarm.com/wp-content/themes/undiscovered/orderpdf.php">
	<div class="row">
		<div class="col-sm-12">
			<div class="head">Pick-Up By:</div>
			<div class="af-box">
				<div class="l-txt">Name:</div>
				<input type="text" name="name" class="form-control" required>
				<input type="hidden" name="session" value="<?php echo $_SESSION['sessionholder'] ?>">
			</div>
			<div class="af-box">
				<div class="l-txt">Email:</div>
				<input type="email" name="email" class="form-control" required >
			</div>
			<div class="af-box">
				<div class="l-txt">Company Name:</div>
				<input type="text" name="company_name" class="form-control" >
			</div>
			<div class="af-box">
				<div class="l-txt">Street Address:</div>
				<input type="text" name="street_address" class="form-control" required>
			</div>
			<div class="af-box">
				<div class="l-txt">City, ST ZIP Code:</div>
				<input type="text" name="zip_code" class="form-control" required>
			</div>
			<div class="af-box">
				<div class="l-txt">Phone:</div>
				<input type="text" name="phone" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-12">
			<input type="submit" name="submit" class="submit-btn" value="Submit">
		</div>
	</div>
		
	</form>
</div>
      </div>
      
    </div>

  </div>
</div>










<?php get_footer() ?>