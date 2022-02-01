<?php
	session_start();
	require 'config.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pdesc= $_POST['pdesc'];
	  $pprice = $_POST['pprice'];
	  $pqty = $_POST['pqty'];
	  $ppoints = $_POST['ppoints'];
	  $pimage = $_POST['pimage'];
	  $total_price = $pprice * $pqty;

	  $stmt = $conn->prepare('SELECT Product_ID FROM cart WHERE Product_ID=?');
	  $stmt->bind_param('s',$pname);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $prodid = $r['Product_ID'] ?? '';

	  if (!$prodid) {
	    $query = $conn->prepare('INSERT INTO cart (Product_Name,Product_Description,Price,Quantity,Item_Points,Total_Price,Product_Image) VALUES (?,?,?,?,?,?)');
	    $query->bind_param('ssssss',$pname,$pdesc,$pprice,$pqty,$ppoints,$total_price,$pimage);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $conn->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['Quantity'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE ID=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	// Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
	  $Name = $_POST['Name'];
	  $Email = $_POST['Email'];
	  $Phone = $_POST['Phone'];
	  $Products = $_POST['Products'];
	  $Grand_Total = $_POST['Grand_Total'];
	  $Address = $_POST['Address'];
	  $Payment_Type = $_POST['Payment_Type'];

	  $data = '';

	  $stmt = $conn->prepare('INSERT INTO orders (Name,Email,Address,Phone_Number,Payment_Type,Products,Amount_Paid)VALUES(?,?,?,?,?,?,?)');
	  $stmt->bind_param('sssssss',$Name,$Email,$Address,$Phone_Number,$Payment_Type,$Products,$Grand_Total);
	  $stmt->execute();
	  $stmt2 = $conn->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $Products . '</h4>
								<h4>Your Name : ' . $Name . '</h4>
								<h4>Your E-mail : ' . $Email . '</h4>
								<h4>Your Phone : ' . $Phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($Grand_Total,2) . '</h4>
								<h4>Payment Mode : ' . $Pmode . '</h4>
						  </div>';
	  echo $data;
	}
?>