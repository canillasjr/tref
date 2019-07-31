<?php
$multiple_recipients ="antonio@junespringmultimedia.com ,antoniojr.canillas@gmail.com ,telderers.rainbowsendfarm@gmail.com ";
$subject = 'TREF, INC Application';

$message = '<p style="font-weight:bold">Personal and Billing Information</p>
      <p>Guest First Name, Middle Name, Last Name: '.$_POST['name'].'</p>
                  <p>E-mail: '.$_POST['email'].'</p>
                  <p>Day Phone/Evening Phone: '.$_POST['phone'].'</p>
                  <p>Billing Address: '.$_POST['billing_address'].'</p>
                  <p>Acceptance Packet Delivery Address: '.$_POST['delivery_address'].'</p>
                  <p>Credit card name: '.$_POST['credit_card_name'].'</p>
                  <p>Credit card number: '.$_POST['credit_card_number'].'</p>
                  <p>Credit card expiration date: '.$_POST['credit_card_expiration_date'].'</p>

                  <p style="font-weight:bold">Guest Travel Information</p>

                  <p>Arriving City: '.$_POST['arriving_city'].'</p>
                  <p>Arriving Date: '.$_POST['arriving_date'].'</p>
                  <p>Arrival Shuttle Service Required?: '.$_POST['arrival_service_required'].'</p>
                  <p>Departure City?: '.$_POST['departure_city'].'</p>
                  <p>Departure Date?: '.$_POST['departure_date'].'</p>
                  <p>Departure Shuttle Service Required?: '.$_POST['departure_service_required'].'</p>

                  <p style="font-weight:bold">Lodging Information</p>

                  <p>Rooms Requested?: '.$_POST['rooms_requested'].' is desired</p>
                  <p>Number of Adult Guests This Visit?: '.$_POST['adult_guest'].' </p>
                  <p>Number of Child Guests This Visit?: '.$_POST['child_guest'].'</p>
                  <p>Length of Stay?: '.$_POST['lenght_of_stay'].'</p>
                  <p>Total Nights?: '.$_POST['total_nights'].'</p>
                  <p>Special Meal Considerations?: '.$_POST['special_meal_consideration'].'</p>
                  <p>Type of Stay?: '.$_POST['type_of_stay'].'</p>
                  <p>Participate in Meal Preparation?: '.$_POST['particaipate_in_meal_preparation'].'</p>
                  <p>Special Accommodations Required?: '.$_POST['special_accommodations_required'].'</p>
                  <p>Guest Allergies We Need to be Informed of?: '.$_POST['guest_allergies'].'</p>
                  <p>Questions or Comments?:</p>
                  <p>'.$_POST['comments'].'</p>';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: '.$_POST['name'].' <'.$_POST['email'].'>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

mail($multiple_recipients,$subject,$message,$headers);
?>