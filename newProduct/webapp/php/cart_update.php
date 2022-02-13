<?php

//empty cart by distroying current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy();
	header('Location:'.$return_url);
}

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	$id	= filter_var($_POST["id"], FILTER_SANITIZE_STRING); //book code
	$qty 	= filter_var($_POST["qty"], FILTER_SANITIZE_NUMBER_INT); //book code
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	
	//MySqli query - get details of item from db using book code
	$results = $mysqli->query("SELECT title,price FROM tbl_lab3 WHERE id ='$id' LIMIT 1");
	$obj = $results->fetch_object();
	
	if ($results) { //we have the book info 
		
		//prepare array for the session variable
		$new_book = array(array('title'=>$obj->title, 'id'=>$id , 'qty'=>$qty, 'price'=>$obj->price));
		
		if(isset($_SESSION["cart_session"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["cart_session"] as $cart_itm) //loop through session array
			{
				if($cart_itm["id"] == $id){ //the item exist in array

					$book[] = array('title'=>$cart_itm["title"], 'id'=>$cart_itm["id"], 'qty'=>$qty, 'price'=>$cart_itm["price"]);
					$found = true;
				}else{
					//item does not exist in the list, just retrive old info and prepare array for session var
					$book[] = array('title'=>$cart_itm["title"], 'id'=>$cart_itm["id"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
				}
			}
			
			if($found == false) //we did not find item in array
			{
				//add new user item in array
				$_SESSION["cart_session"] = array_merge($book, $new_book);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["cart_session"] = $book;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["cart_session"] = $new_book;
		}
		
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["cart_session"]))
{
	$id	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["cart_session"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["id"]!=$id){ //item does not exist in the list
			$book[] = array('title'=>$cart_itm["title"], 'id'=>$cart_itm["id"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
		}
		
		//create a new product list for cart
		$_SESSION["cart_session"] = $book;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}
?>