<?php
	Class local_pickup{
	
		public function __construct(){
		      
		  }
		function connection(){
				$connect = mysqli_connect("localhost","telderer_user","yU%T4Q}aZ9HU","telderer_live");

			return $connect;
		}

		function insert($table , $values){

			$sql = "INSERT INTO ".$table." (Sessionholder,quantity,name,item,invoice,price) VALUES ( '".$values['Sessionholder']."','".$values['quantity']."','".$values['name']."','".$values['item']."','".$values['invoice']."','".$values['price']."')";
			
			$result = mysqli_query($this->connection(), $sql);
			mysqli_close($this->connection());
		}
		function compare_sku($table , $session , $sku){
			
			$sql = "SELECT * FROM ".$table." WHERE Sessionholder = '".$session."' AND item = '".$sku."'";
			$result = mysqli_query($this->connection(), $sql);
			$count = mysqli_num_rows($result);
			if($count >= 1){
				return true;
			}else{
				return false;
			}
		}

		function show($table , $session){

			$sql = "SELECT * FROM ".$table." WHERE Sessionholder = '".$session."'";
			$result = mysqli_query($this->connection(), $sql);
			return $result;
		}

		
		// function display($session){
		// 	 $row1 = $this->show('local_pick' , $session); 
		
		// 	 while($row1){
		// 	$content ="<tr class='body-t'>
		// 		<td>".$row1['quantity']."</td>
		// 		<td>".$row1['item']."</td>
		// 		<td>".$row1['name']."</td>
		// 		<td>".$row1['price']."</td>
		// 		<td>".$row1['price']."</td>
		// 		<td>".$row1['price']."</td>
		// 		</tr>";

		// 	echo "sfda";
		// 	 }

		// }

	}
?>