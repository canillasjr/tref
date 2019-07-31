<?php get_header() ?>
<style type="text/css">
  .agri-button{
    display: inline-block !important;
  }
</style>
<div style="background: white">
<div class="agriContainer">
	<div class="agriTitle"><?php the_title() ?></div>
	<div class="agriBannerImg"><img src="<?php echo get_the_post_thumbnail_url(); ?>" class="img-baner-agri"></div>
	<div class="agriDescrription"><?php the_content() ?></div>
  <div class="button-form-container" style="text-align: center;">
  	<a href="#wf_form-modal" data-toggle="modal" class="agri-button">Application</a>
    <a href="#modal-application" data-toggle="modal" class="agri-button">Reservation</a>
  </div>
</div>
</div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
<style type="text/css">
  .modal-dialog.modal-lg{
    width: 100%;
    max-width: 1199px !important;
  }
</style>
<div class="modal fade" id="wf_form-modal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
       <section class="order-form" style="background: white;">

<style type="text/css">
  .form-container{
    max-width: 1113px;
      margin: 0 auto;
  }
  .farm-head{
    font-size: 36px;
      text-align: center;
      color: #554466;
      font-weight: bold;
  }
  .sub-head{
    color: #554466;
      font-size: 15px;
      text-align: center;
  }
  .section-title{
    font-size: 20px;
      color: #554466;
      font-weight: bold;
      padding: 10px 0;
  }
  .title-label{
    font-size: 15px;
      color: #554466;
  }
  .content-section{
    padding-bottom: 14px;
  }
  .select .title-label{
    display: inline-block;
      margin-right: 35px;
  }
  input{
    font-size: 15px;
      font-family: inherit;
  }
  .wf-submit-buttom input , .wf-submit-buttom input:hover{
    width: 235px;
      display: block;
      background: #F26522;
      padding: 20px 0;
      text-align: center;
      color: white;
      text-decoration: none;
      text-shadow: none;
      font-size: 15px;
      font-family: "open sans";
      box-shadow: none;
      outline: none;
      border: none !important;
  }
  .error{
      font-size: 13px;
      color: red;
  }
</style>
<div class="form-container">
<form action="" id="wf-form" method="post">
  <div class="farm-head">TREF, INC</div>
  <div class="sub-head">Farmcation/WWoofing Application email to: telderers.rainbowsendfarm@gmail.com</div>
  <div class="table row">
  <div class="section-title" style="padding: 10px 15px;">Personal and Billing Information</div>
  <div class="col-md-6">
    <div class="row content-section">
      <div class="title-label">Guest First Name, Middle Name, Last Name</div>
      <input  class="form-control" type="text" name="name">
    </div>
    <div class="row content-section">
      <div class="title-label">E-mail</div>
      <input   class="form-control" type="email" name="email">
    </div>
    <div class="row content-section">
      <div class="title-label">Day Phone/Evening Phone</div>
      <input   class="form-control"  type="phone" name="phone">
    </div>
    <div class="row content-section">
      <div class="title-label">Billing Address</div>
      <textarea   class="form-control" type="text" name="billing_address"></textarea>
    </div>
    <div class="row content-section">
      <div class="title-label">Acceptance Packet Delivery Address</div>
      <textarea   class="form-control" type="text" name="delivery_address"></textarea>
    </div>
    <div class="row content-section">
      <div class="title-label">Credit card name</div>
      <input   class="form-control" type="text" name="credit_card_name">
    </div>
    <div class="row content-section">
      <div class="title-label">Credit card number</div>
      <input   class="form-control" type="text" name="credit_card_number">
    </div>
    <div class="row content-section">
      <div class="title-label">Credit card expiration date</div>
      <input   class="form-control" type="date" name="credit_card_expiration_date">
    </div>  
    <div class="section-title">Guest Travel Information</div>
    <div class="row content-section">
      <div class="title-label">Arriving City</div>
      <input   class="form-control" type="text" name="arriving_city">
    </div>
    <div class="row content-section">
      <div class="title-label">Arriving Date</div>
      <input   class="form-control" type="date" name="arriving_date">
    </div>
    <div class="row content-section select">
      <div class="title-label">Arrival Shuttle Service Required?</div>
      <span><input   type="radio" name="arrival_service_required" value="yes"><span>Yes</span></span>
      <span><input   type="radio" name="arrival_service_required" value="no"><span>No</span></span>
    </div>  
  </div>
  <div class="col-md-6">
  
    <div class="row content-section ">
      <div class="title-label">Departure City?</div>
      <input   class="form-control" type="text" name="departure_city">
    </div>
    <div class="row content-section select">
      <div class="title-label">Departure Date?</div>
      <input   class="form-control" type="date" name="departure_date">
    </div>
    <div class="row content-section select">
      <div class="title-label">Departure Shuttle Service Required? </div>
      <span><input   type="radio" name="departure_service_required" value="yes"><span>Yes</span></span>
      <span><input   type="radio" name="departure_service_required" value="no"><span>No</span></span>
    </div>
    <div class="section-title">Lodging Information</div>
    <div class="row content-section select">
      <div class="title-label ">Rooms Requested?</div>
      <select   name="rooms_requested">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
    </div>
    <div class="row content-section select">
      <div class="title-label">Number of Adult Guests This Visit? </div>
          <select   name="adult_guest">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
    </div> 
    <div class="row content-section select">
      <div class="title-label">Number of Child Guests This Visit? </div>
          <select   name="child_guest">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
    </div>
    <div class="row content-section select">
      <div class="title-label">Length of Stay?</div>
          <select   name="lenght_of_stay">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
    </div>
    <div class="row content-section select">
      <div class="title-label">Total Nights?</div>
          <select   name="total_nights">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
    </div>
    <div class="row content-section select">
      <div class="title-label">Special Meal Considerations?</div>
      <span><input  type="radio" name="special_meal_consideration" value="yes"><span>Yes</span></span>
      <span><input  type="radio" name="special_meal_consideration" value="no"><span>No</span></span>
    </div>
    <div class="row content-section select">
      <div class="title-label">Type of Stay?</div>
      <select   name="type_of_stay">
        <option value="Farmcation">Farmcation</option>
        <option value="WWoofing">WWoofing</option>
      </select>
    </div>
    <div class="row content-section select">
      <div class="title-label">Participate in Meal Preparation?</div>
      <span><input   type="radio" name="particaipate_in_meal_preparation" value="yes"><span>Yes</span></span>
      <span><input  type="radio" name="particaipate_in_meal_preparation" value="no"><span>No</span></span>
    </div>
    <div class="row content-section select">
      <div class="title-label">Special Accommodations Required?</div>
      <select   name="special_accommodations_required">
        <option value="Wheel Chair Accessible">Wheel Chair Accessible</option>
        <option value="Disability Bathroom">Disability Bathroom</option>
        <option value="etc">etc</option>
      </select>
    </div>
    <div class="row content-section select">
      <div class="title-label">Guest Allergies We Need to be Informed of? </div>
      <span><input   type="radio" name="guest_allergies" value="yes"><span>Yes</span></span>
      <span><input   type="radio" name="guest_allergies1" value="no"><span>No</span></span>
    </div>
    <div class="row content-section">
      <div class="title-label">Questions or Comments?</div>
      <textarea   name="comments" rows="5" type="text"></textarea>
    </div>
    <div class="alert-success-custom"></div>
    <div class="wf-submit-buttom"><input type="submit" name="submit-form" value="Submit"></div>
  </div>
  </div>
   </form>
</div>
</section>  
 </div>
    </div>
  </div>

<script type="text/javascript">
  jQuery('#wf-form').validate({
                    rules: {
                        "name": {
                            required: true,
                          
                        },
                  "email": {
                            required: true,
                            email: true
                        },
                  "phone": {
                            required: true,
                        },
                              "billing_address": {
                    required: true,
                        },
                        "delivery_address": {
                            required: true,
                        },
                        "credit_card_name": {
                            required: true,
                        },
                        "credit_card_number": {
                            required: true,
                        },
                        "credit_card_expiration_date": {
                            required: true,
                        },
                        "arriving_city": {
                            required: true,
                        },
                        "arriving_date": {
                            required: true,
                        },
                        "departure_city": {
                            required: true,
                        },
                        "departure_date": {
                            required: true,
                        },
                        "rooms_requested": {
                            required: true,
                        },
                        "adult_guest": {
                            required: true,
                        },
                        "child_guest": {
                            required: true,
                        },
                        "lenght_of_stay": {
                            required: true,
                        },
                        "total_nights": {
                            required: true,
                        },
                        "type_of_stay": {
                            required: true,
                        },
                        "special_accommodations_required": {
                            required: true,
                        },
                        "comments": {
                            required: true,
                        }
                    },
submitHandler: function(form) {
var name = jQuery('input[name="name"]').val();
var email = jQuery('input[name="email"]').val();
var phone = jQuery('input[name="phone"]').val();
var billing_address = jQuery('textarea[name="billing_address"]').val();
var delivery_address = jQuery('textarea[name="delivery_address"]').val();
var credit_card_name = jQuery('input[name="credit_card_name"]').val();
var credit_card_number = jQuery('input[name="credit_card_number"]').val();
var credit_card_expiration_date = jQuery('input[name="credit_card_expiration_date"]').val();
var arriving_city = jQuery('input[name="arriving_city"]').val();
var arriving_date = jQuery('input[name="arriving_date"]').val();
var arrival_service_required = jQuery('input[name="arrival_service_required"]').val();
var departure_city = jQuery('input[name="departure_city"]').val();
var departure_date = jQuery('input[name="departure_date"]').val();
var departure_service_required = jQuery('input[name="departure_service_required"]').val();
var rooms_requested = jQuery('input[name="rooms_requested"]').val();
var adult_guest = jQuery('input[name="adult_guest"]').val();
var child_guest = jQuery('input[name="child_guest"]').val();
var lenght_of_stay = jQuery('input[name="lenght_of_stay"]').val();
var total_nights = jQuery('input[name="total_nights"]').val();
var special_meal_consideration = jQuery('input[name="special_meal_consideration"]').val();
var type_of_stay = jQuery('input[name="type_of_stay"]').val();
var particaipate_in_meal_preparation = jQuery('input[name="particaipate_in_meal_preparation"]').val();
var special_accommodations_required = jQuery('input[name="special_accommodations_required"]').val();
var guest_allergies = jQuery('input[name="guest_allergies"]').val();
var comments = jQuery('textarea[name="comments"]').val();


jQuery.post("http://telderers.junespring.space/wp-content/themes/undiscovered/submit-wfform.php?function=email",{name:name,email:email,phone:phone,billing_address:billing_address,delivery_address:delivery_address,credit_card_name:credit_card_name,credit_card_number:credit_card_number,credit_card_expiration_date:credit_card_expiration_date,arriving_city:arriving_city,arriving_date:arriving_date,arrival_service_required:arrival_service_required,departure_city:departure_city,departure_date:departure_date,departure_service_required:departure_service_required,rooms_requested:rooms_requested,adult_guest:adult_guest,child_guest:child_guest,lenght_of_stay:lenght_of_stay,total_nights:total_nights,special_meal_consideration:special_meal_consideration,type_of_stay:type_of_stay,particaipate_in_meal_preparation:particaipate_in_meal_preparation,special_accommodations_required:special_accommodations_required,guest_allergies:guest_allergies,comments:comments},function(data){

jQuery('.alert-success-custom').html('<span style="font-size:15px"> Message Successfully Send !! </span>');

jQuery('input[name="name"]').val("");
jQuery('input[name="email"]').val("");
jQuery('input[name="phone"]').val("");
jQuery('textarea[name="billing_address"]').val("");
jQuery('textarea[name="delivery_address"]').val("");
jQuery('input[name="credit_card_name"]').val("");
jQuery('input[name="credit_card_number"]').val("");
jQuery('input[name="credit_card_expiration_date"]').val("");
jQuery('input[name="arriving_city"]').val("");
jQuery('input[name="arriving_date"]').val("");
jQuery('input[name="departure_city"]').val("");
jQuery('input[name="departure_date"]').val("");
jQuery('textarea[name="comments"]').val("");
console.log(data);
}                       
);


}
                });
</script>


<?php get_footer() ?>