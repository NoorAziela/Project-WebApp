<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title> D'Shah HomeMix Bundle </title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="css/proStyle.css" type="text/css" media="all" />
	 	<link rel="stylesheet" href="css/cart.css" type="text/css" media="all" />
	<link rel="shortcut icon" href="images/logo.png" />
	<script src="js/jquery-1.6.2.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/Myriad_Pro_700.font.js" type="text/javascript"></script>
	<script src="js/jquery.jcarousel.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/functions.js" type="text/javascript" charset="utf-8"></script>
	
	
		 <!-- Linking scripts -->
         <script src="../javascript/script.js"></script>
	
</head>
	
<div class="viewcart">
 	<?php
    $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	if(isset($_SESSION["cart_session"]))
    {
	    $total = 0;
		
		echo '<form method="post" action="cart_update.php">';
		echo '<table cellspacing="0">';
			  echo   '<thead>';
		  echo '<tr>';
		  echo '<td>Check:</td>';
		  echo '<td>Title:</td>';
		  echo '<td>Quantity:</td>';
		  echo '<td>Price:</td>';
		  echo '</tr>';
		  echo '</thead>';
		  
		$cart_items = 0;
		foreach ($_SESSION["cart_session"] as $cart_itm)
        {
           $id = $cart_itm["id"];
		   $results = $mysqli->query("SELECT title, price FROM book  WHERE id='$id'"); 
          if ($results) { 
		  
	        
			
          //fetch results set as object and output HTML
          while($obj = $results->fetch_object())
        {
			
		  
		    echo '<tr class="cart-itm">';
            echo '<td><input type="checkbox"></td>';
			echo '<td><h3>'.$obj->title.' (Code :'.$id.')</h3></td> ';
            echo '<td class="p-qty">Qty :<input type="number" name="qty" value="'.$cart_itm["qty"].'" size="2"   maxlength="5" /></td>';
		    echo '<td class="p-price" style="color:green"><b>'.$currency.$obj->price.'</b></td>';
			echo '<td><span class="remove-check"><a href="cart_update.php?removep='.$cart_itm["id"].'&return_url='.$current_url.'">&times;</a></span></td>';
            echo '</tr>';
			$subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
			$total = ($total + $subtotal);

			

			echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->title.'" />';
			echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$id.'" />';
			echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'"/>';
			$cart_items ++;
			      		    }}}

    
		echo '<span class="midigta"><a  class="a-btn" href="books.php?emptycart=1&return_url='.$current_url.'"><span class="a-btn-text">Continue Shopping</span></a></span>';
		echo '<span class="check-out-txt">';

    	echo '</table>';
		echo '<span> <h4 class="pricewayn"> Grand Total : <big style="color:green">'.$currency.$total.'</big> </h4></span> ';
		
		echo '<span class="midigta"> <a  class="a-btn" href="Pick-A-Book checkout/process.php"> <span class="a-btn-text"> Pay On Pick-A-Book</span></a></span>';
		echo '</span>';
		echo '</form>'; 

   }else{        
		echo '<span class="wacwayn"><i>Your Cart is Empty</i></span>';
	}
	
    ?>

</body>
</html>