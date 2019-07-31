<?php
	$connect = mysqli_connect("localhost","telderer_user","yU%T4Q}aZ9HU","telderer_live");

	extract($_POST);
	$post = $type;
	switch ($post) {
		case 'update':
			?>
			<style type="text/css">
				input[name="update_qt"]
				{
					width: 50px;
				    text-align: center;
				    font-family: inherit;
				}
			</style>
			<div class="update-form">
				<input type="number" name="update_qt" id="keyup-event" value="<?php echo $num ?>">
			</div>
			<?php
			break;
		case 'edit':

			$sql = "UPDATE local_pick SET quantity = '".$num."' , price = '".$pricenew."' WHERE id=".$id."";
			mysqli_query($connect, $sql);
			echo $num;
			break;
		case 'deleteAll':

			$sql = "DELETE from local_pick where Sessionholder = '".$session."'";
			mysqli_query($connect, $sql);

			break;
		case 'delete':
			 $sql = "DELETE FROM local_pick WHERE id=".$id."";
			 mysqli_query($connect, $sql);
		echo "s";
			break;
		default:
			# code...
			break;
	}

?>