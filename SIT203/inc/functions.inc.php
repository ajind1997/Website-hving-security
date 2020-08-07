<?php
function writeShoppingCart() {
	$cart = $_SESSION['cart'];
	if (!$cart) {
		return '<p>You have no items in your shopping cart</p>';
	} else {
		// Parse the cart session variable
		$items = explode(',',$cart);
		$s = (count($items) > 1) ? 's':'';
		return '<p>You have <a href="cart.php">'.count($items).' item'.$s.' in your shopping cart</a></p>';
	}
}

function showCart() {
	global $db;
	$cart = $_SESSION['cart'];
	if ($cart) {
		$items = explode(',',$cart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = '<form action="cart.php?action=update" method="post" id="cart">';
		$output[] = '<table>';
		foreach ($contents as $id=>$qty) {
		
			$sql = 'SELECT * FROM cdcatalog WHERE id = '.$id;
			
			// modified by Shang			
			$stmt = oci_parse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			oci_execute($stmt); 

			while(oci_fetch_array($stmt)) {				

				$name= oci_result($stmt,"NAME");
				$product = oci_result($stmt,"PRODUCT");
				//$country= oci_result($stmt,"COUNTRY");
				//$company = oci_result($stmt,"COMPANY");
				$banner = oci_result($stmt,"BANNER");
				//$year= oci_result($stmt,"YEAR");
						
	
			}
			$output[] = '<tr>';
			$output[] = '<td><a href="cart.php?action=delete&id='.$id.'" class="r">Remove</a></td>';
			$output[] = '<td>'.$title.' by '.$artist.'</td>';
			$output[] = '<td>AU$ '.$price.'</td>';
			$output[] = '<td><input type="text" name="qty'.$id.'" value="'.$qty.'" size="3" maxlength="3" /></td>';
			$output[] = '<td>AU$ '.($price * $qty).'</td>';
			$total += $price * $qty;
			$output[] = '</tr>';
		}
		$output[] = '</table>';
		$output[] = '<p>Grand total: <strong>AU$ '.$total.'</strong></p>';
		$output[] = '<div><button type="submit">Update cart</button></div>';
		$output[] = '</form>';
	} else {
		$output[] = '<p>You shopping cart is empty.</p>';
	}
	return join('',$output);
}

function redirectToHTTPS(){
  if($_SERVER['HTTPS']!="on")  {
	$redirect= "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("Location:$redirect");  }
  
}
?>
