<?php
	$connect = mysqli_connect("localhost","telderer_user","yU%T4Q}aZ9HU","telderer_live");
	// $connect = mysqli_connect("localhost","staging_2016","stagingadmin2016","staging_telderers");
	extract($_POST);
	// if(!isset($submit)){header('Location:http://telderers.junespring.space/');};
	include(dirname(__FILE__).'/mpdf/mpdf.php');
	$sql = "SELECT * FROM  local_pick WHERE Sessionholder = '".$session."'";
	$result = mysqli_query($connect, $sql);
	$title.='<div class="t1">Product Order</div>';
	$title.='<div class="t2">Telderers Rainbows End Farm, LLC</div>';
	$title.='<div class="t3">Where the Best of Nature is Nurtured</div>';

	$date .= '<table>';
	$date .=	'<tr>';
	$date .=		'<th>DATE</th><th>Invoice #</th><th>Costumer ID</th>';
	$date .=	'</tr>';
	$date .=	'<tr>';
	$date .=		'<td>'.date(FjY).'</td><td>'.$session.'</td><td>'.$session.'</td>';
	$date .=	'</tr>';
	$date .= '</table>';

	$customer .= '
	<table class="customer">
		<tr>
		<td>
			<div class="">TO:</div>
			<div>'.$name.'</div>
			<div>'.$company_name.'</div>
			<div>'.$street_address.'</div>
			<div>'.$zip_code.'</div>
			<div>'.$phone.'</div>
		</td>
		<td>
			<div class="">Pick-Up By:</div>
			<div>'.$name.'</div>
			<div>'.$company_name.'</div>
			<div>'.$street_address.'</div>
			<div>'.$zip_code.'</div>
			<div>'.$phone.'</div>
		</td>
		</tr>
	</table>';
	


	$header = '<table>
	<tr><th>Salesperson</th><th>Job</th><th>Shipping Method</th><th>Delivery Date</th><th>Restock Fee</th><th>Order Deposit</th></tr>
	<tr><td></td><td></td><td>Local Pickup Only</td><td></td><td>25%</td><td>~ 10%</td></tr>
	</table>
	<table>
		<tr class="head-t">
			<th>Qty</th>
			<th>Item #</th>
			<th>Description</th>
			<th>Unit Price per Pound</th>
			<th>Deposit & Restock Fee</th>
			<th>Line Total</th>
		</tr>';

	while($row = mysqli_fetch_array($result)){   
			$html .= '<tr class="body-t">
			<td>'.$row["quantity"].'</td>
			<td>'.$row["item"].'</td>
			<td>'.$row["name"].'</td>
			<td>$ '.$row['price'].'</td>
			<td></td>
			<td></td>
		</tr>';
	} 
	$footer = '<tr>
			<td></td><td></td><td></td><td>Total Deposit:</td><td></td><td></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td>Subtotal</td><td></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td>Sales Tax</td><td></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td>Total</td><td></td>
		</tr>
	</table>';

	$footer.='</br></br><div style="margin-top:40px;"><span style="color:red;">Note: Please print the PDF Invoice, this will serve as your receipt upon pick up. Thank You. </span></div>';

	$mpdf = new mPDF();
	$stylesheet = file_get_contents(dirname(__FILE__)."/pdf.css");
	
	$mpdf->WriteHTML($stylesheet,1);
	
	$mpdf->WriteHTML($title);
	$mpdf->WriteHTML($date);
	$mpdf->WriteHTML($customer);
	$mpdf->WriteHTML($header);
	$mpdf->WriteHTML($html);
	$mpdf->WriteHTML($footer);

	$content = $mpdf->Output('','S');
	
	$filename = 'order_pickup.pdf';
   
    $mailto = 'antoniojr.canillas@gmail.com , telderers.rainbowsendfarm@gmail.com ';
    $subject = 'Order for Pickup';
    $message = '<p>A '.$name.' has an order for Local Pick-up today!  Please process the order and return the updated order form to '.$name.'. Please include Delivery Date, Salesperson, and any pick-up instructions.</p><br><p>Copyright 2016. telderersrainbowsendfarm.com</p>';

    
    $content = chunk_split(base64_encode($content));

    // a random hash will be necessary to send mixed content
    $separator = md5(time());

    // carriage return type (RFC)
    $eol = "\r\n";

    // main header (multipart mandatory)
    $headers = "From: ".$name." <".$email.">" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $body = "--" . $separator . $eol;
    $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol;
    $body .= $message . $eol;

    // attachment
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol;
    $body .= $content . $eol;
    $body .= "--" . $separator . "--";

    $me_b = "<p>Please present the attached pdf file to claim your purchase item/items.</p><br>
    		<p>Copyright 2016. telderersrainbowsendfarm.com</p>";
    // message
    $user_b = "--" . $separator . $eol;
    $user_b .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $user_b .= "Content-Transfer-Encoding: 8bit" . $eol;
    $user_b .= $me_b . $eol;

    // attachment
    $user_b .= "--" . $separator . $eol;
    $user_b .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $user_b .= "Content-Transfer-Encoding: base64" . $eol;
    $user_b .= "Content-Disposition: attachment" . $eol;
    $user_b .= $content . $eol;
    $user_b .= "--" . $separator . "--";




	$is_sent = @mail("antoniojr.canillas@gmail.com , telderers.rainbowsendfarm@gmail.com", $subject, $body, $headers);
	$is_sent = @mail("antoniojr.canillas@gmail.com", $subject, $user_b, $headers);
	$mpdf->Output(); // For sending Output to browser
	$mpdf->Output('order_pickup.pdf','D'); // For Download
	exit;


?>