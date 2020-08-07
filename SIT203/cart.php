<?php
// Include database connection
require_once('inc/global-connect.inc.php');
// Include functions
require_once('inc/functions.inc.php');
// Start the session
session_start();
// Process actions
//$cart = $_SESSION['cart'];
//print_r($cart);
//$cart='';
//$action = $_GET['action'];

switch ($action) {
    case 'add':
        //echo "In add case. ";
        $dbuser = "ajind"; // your deakin login 
        $dbpass = "ANOOP"; // your oracle access password 
        $db = "SSID";
        $connect = oci_connect($dbuser, $dbpass, $db);

        if (!$connect) {
        echo "An error occurred connecting to the database";
        exit;
        }

        $query = "SELECT * FROM Products WHERE id=".$_GET['id'];

 // check the sql statement for errors and if errors report them 
		$stmt = oci_parse($connect, $query);

		if(!$stmt) {
		echo "An error occurred in parsing the sql string.\n";
		exit;
		}
		oci_execute($stmt);
		
		while(oci_fetch($stmt))
		{
            $id =oci_result($stmt,"ID");
			$price =oci_result($stmt,"PRICE");
            $product =oci_result($stmt,"PRODUCT");
            $picture = oci_result($stmt,"PICTURE");
            //$tempTotal = $price;
            
            $itemArray = array( $id => array( 'id' => $id, 'product' => $product, 'price' => $price, 'picture' => $picture, 'qnt' => 1 ) );
            //print_r($itemArray);
            
            if(!empty($_SESSION["cart"]))
            {
                //echo "<br> &&&&&&&&&&&& <br>";
                //print_r(array_keys($_SESSION['cart']));
                if(in_array($id,array_keys($_SESSION['cart'])))
                {
                  //  echo "matched";
                    foreach($_SESSION["cart"] as $k=>$v) {
                        if($id==$k) {
                            if(empty($_SESSION["cart"][$k]["qnt"])) {
                                $_SESSION["cart"][$k]["qnt"] = 1;
                            }
                            $_SESSION["cart"][$k]["qnt"] += 1;
                        }
                    }
                }
                else {
                    $_SESSION["cart"] = array_merge( $_SESSION["cart"], $itemArray );
                }
            }
            else {

                $_SESSION["cart"] = $itemArray;
            }
		}
		
		oci_close($connect);

        /* *****************************************
        if ($cart) {
			$cart .= ','.$_GET['id'];
		} else {
			$cart = $_GET['id'];
		}
       
        ******************************* */
        break;

    case 'delete':
        if(!empty($_SESSION["cart"])) {
            foreach($_SESSION["cart"] as $k=>$p) {
                
                if($_GET["id"]==$p["id"]) {
                
                    unset($_SESSION["cart"][$k]);
                }
                if(empty($_SESSION["cart"])) {
                    unset($_SESSION["cart"]);
                }
            }
        }
    /*
		if ($cart) {
			$items = explode(',',$cart);
			$newcart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newcart != '') {
						$newcart .= ','.$item;
					} else {
						$newcart = $item;
					}
				}
			}
			$cart = $newcart;
        }
        $_SESSION['cart'] = $cart;
    */
        break;
    case 'update':
    /*
	if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$brand = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;
						} else {
							$newcart = $item;
						}
					}
				}
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$brand;
					} else {
						$newcart = $brand;
					}
				}
			}
        }
        $cart = $newcart;
    $_SESSION['cart'] = $cart;
	}
    */
	break;
}

?>

<?php
/*
	    $dbuser = "ajind"; // your deakin login 
		$dbpass = "ANOOP"; // your oracle access password 
		$db = "SSID";
		$connect = oci_connect($dbuser, $dbpass, $db);

		if (!$connect) {
		echo "An error occurred connecting to the database";
		exit;
		}
   
        

if($_GET['action']=="add")
{	$id = $_GET['id'];
	$query = "SELECT * FROM Products WHERE id=".$_GET['id'];

 // check the sql statement for errors and if errors report them 
		$stmt = oci_parse($connect, $query);

		if(!$stmt) {
		echo "An error occurred in parsing the sql string.\n";
		exit;
		}
		oci_execute($stmt);
		
		while(oci_fetch($stmt))
		{
			
			$price =oci_result($stmt,"PRICE");
			$product =oci_result($stmt,"PRODUCT");
			$tempTotal = $price;

		}
		
		oci_close($connect);
}

if($_GET['action']=="update")
{
	$qnt = $_GET['qt'];
	$tempTotal = $price*$qnt;	
}
*/
	
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	
	<meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Universal Your furniture Shop">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz, modified by Shang Gao Deakin Uni June 2018.">
    <meta name="keywords" content="">

	<title>
        Universal : Your Furniture Shop
    </title>
	
	<meta name="keywords" content="">
	
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/styles.css" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
	
	    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">

	<script>
		
		
		
	/*
    function updateBasket(id)
		{						
		
			console.log("id"+id);
			window.location.href = "cart.php?action=update&qt="+document.getElementById("quantity").value+"&id="+id;
		}
		*/
		
	</script>
	
</head>

<body id= "body" >
<!--
*****************************************************************************************************************
<div id="shoppingcart">

<h1>Your Shopping Cart</h1>

<?php
//echo writeShoppingCart();
?>

</div>

<div id="contents">

<h1>Please check quantities...</h1>

<?php
//echo showCart();
?>

<p><a href="index.php">Back to bookshop...</a></p>

</div> 
***************************************************************************************************
-->


<!-- *** TOPBAR ***
 _________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="col-md-6 offer" data-animate="fadeInDown">
                <a href="#" class="btn btn-success btn-sm" data-animate-hover="shake">Offer of the day</a>  
				<a href="#">Get flat 35% off on orders over $500!</a>
            </div>
            <div class="col-md-6" data-animate="fadeInDown">
                <ul class="menu">
                    <li><a href="#" data-toggle="modal" data-target="#login-modal">
                        <?php 
                            if (!isset($_SESSION['id'])){
                                echo "Login";
                            }
                            else {
                                echo "Hi ".$_SESSION['fname'];
                            }
                        ?>
                        
                    </a>
                    </li>
                    <li><a href="register.html">Register</a>
                    </li>
                    <li><a href="contact.html">Contact</a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="customer-orders.html" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email-modal" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password-modal" placeholder="password">
                            </div>

                            <p class="text-center">
                                <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="register.html"><strong>Register now</strong></a>
						! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- *** TOP BAR END *** -->

    <!-- *** NAVBAR ***
 _________________________________________________________ -->

    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">

                <a class="navbar-brand home" href="index.html" data-animate-hover="bounce">
                    <img src="img/logo.png" alt="Universal logo" class="hidden-xs">
                    <img src="img/logo-small.png" alt="Universal logo" class="visible-xs"><span class="sr-only">Universal - go to homepage</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                    <a class="btn btn-default navbar-toggle" href="cart.php">
                        <i class="fa fa-shopping-cart"></i>  <span class="hidden-xs">items in cart</span>
                    </a>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">

                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.html">Home</a>
                    </li>
														
					<li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Shop <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-6"> <!-- col-sm-3 is changed to col-sm-6 by Shang-->
                                            <h5>Furniture</h5>
                                            <ul>												
                                                <li><a href="shop-furniture.html?type=CHAIR">Chairs</a>
                                                </li>
                                                <li><a href="shop-furniture.html?type=BED">Beds</a>
                                                </li>												
                                                <li><a href="shop-furniture.html?type=TABLE">Tables</a>
                                                </li>
												<li><a href="shop-furniture.html?type=STORAGE">Storage</a>
                                                </li>
												
                                            </ul>
                                        </div>                                        
                                        <div class="col-sm-6"> <!-- col-sm-3 is changed to col-sm-6 by Shang-->
                                            <h5>Accessories</h5>
                                            <ul>
                                                <li><a href="shop-accessories.html?type=HOMEDECO">Home Deco</a>
                                                </li>
                                                <li><a href="shop-accessories.html?type=RUG">Textiles & Rugs</a>
                                                </li>
												<li><a href="shop-accessories.html?type=LIGHTING">Lighting</a>
                                                </li>
												<li><a href="shop-accessories.html?type=PLANTSTAND">Plant pots & Stands</a>
                                                </li>												
                                            </ul>
                                        </div>                                        
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>                   

                    <li class="dropdown yamm-fw">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Site <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h5>Shop</h5>
                                            <ul>
                                                <li><a href="index.html">Homepage</a>
                                                </li>
                                                <li><a href="shop-furniture.html">Shop - furniture</a>
                                                </li>
												<li><a href="shop-accessories.html">Shop - accessories</a>
                                                </li> 
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>User</h5>
                                            <ul>
                                                <li><a href="register.html">Register / login</a>
                                                </li>
                                                <li><a href="customer-orders.html">Orders history</a>
                                                </li>
                                                <li><a href="customer-order.html">Order history detail</a>
                                                </li>
                                                <li><a href="customer-account.html">Customer account / change password</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Order process</h5>
                                            <ul>
                                                <li><a href="cart.php">Shopping cart</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h5>Information</h5>
                                            <ul>                                                
                                                <li><a href="aboutus.html">About us</a>
                                                </li>
												<li><a href="terms.html">Terms and conditions</a>
                                                </li>
												<li><a href="faq.html">FAQ</a>
                                                </li>                                                                                                
                                                <li><a href="contact.html">Contact</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.yamm-content -->
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->

            <div class="navbar-buttons">

                <div class="navbar-collapse collapse right" id="basket-overview">
                    <a href="cart.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="hidden-sm">items in cart</span></a>
                </div>
                <!--/.nav-collapse -->

                <div class="navbar-collapse collapse right" id="search-not-mobile">
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                        <span class="sr-only">Toggle search</span>
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>

            <div class="collapse clearfix" id="search">

                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">

			<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>

		    </span>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!-- /.container -->
    </div>
    <!-- /#navbar -->

    <!-- *** NAVBAR END *** -->

    <div id="all">

        


<div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.html">Home</a>
                        </li>
                        <li>Shopping cart</li>
                    </ul>
                </div>

                <div class="col-md-9" id="basket">

<?php
            if(empty($_SESSION["cart"]))
            {
                ?>
				<div class="box">
					<p>You shopping cart is empty.</p>
				</div>
				
            
<?php
            }
                    
?>					
			<!-- Form Starts      
			action="cart.php?action=update"
            -->	
            
            <?php
            if(!empty($_SESSION["cart"]))
            {
                //echo "hi**************** ";
                //print_r($_SESSION["cart"]);
                $total_quantity = 0;
                $total_price = 0;
                    ?>
            
            <div class="box">
					<form method="post" action="cart.php?action=update" ><h1>Shopping cart</h1>
        <p class="text-muted">You currently have item(s) in your cart.</p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Product</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                        <th>Discount</th>
                        <th colspan="2">Total</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
                
                    foreach($_SESSION["cart"] as $item) {
                        $itemPrice = $item["qnt"]*$item["price"]; 
                    
                ?>
                
                
                <tr>
            <td>
			
                <a href="detail.html?id=<?php echo $item['id'];?>">
                    <img src="<?php echo $item['picture'];?>" alt="">
                </a>
			
				<?php echo $item["product"]; ?>
            </td>
            <td><a href="detail.html?id=5"></a>
            </td>
            <td>
                <input id="quantity" type="number" name="qty" value=<?php echo $item["qnt"]; ?> class="form-control">
            </td>
            <td>$<?php echo $item["price"]; ?></td>
            <td>$0</td>
            <td>AU$<?php echo $itemPrice; ?></td>
            <td><a href="cart.php?action=delete&amp;id=<?php echo $item["id"];?>"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php
            $total_price += ($item["price"]*$item["qnt"]); 
                    }
        ?>
            </tbody><tfoot><tr><th colspan="5">Total</th><th colspan="2"><?php echo $total_price; ?></th></tr>
            </tfoot>
        </table>
    </div>
    <div class="box-footer">
    <div class="pull-left">
        <a href="shop-furniture.html" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
    </div>
    <div class="pull-right">
        <button type="-&quot;submit&quot;" class="btn btn-primary"><i class="fa fa-refresh"></i> Update basket</button>
        <a href="check.html" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
        </a>
    </div>
</div>
</form>


<!-- Form Ends -->
					
					
                    </div>
                    <!-- /.box -->
                    <?php
}
                ?>

                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Order summary</h3>
                        </div>
                        <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order subtotal</td>
                                        <th>$<?php echo $total_price; ?></th>
                                    </tr>
                                    <tr>
                                        <td>Shipping and handling</td>
                                        <th>$20</th>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <th>$<?php echo ($total_price+20); ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>					

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>

</body>
</html>