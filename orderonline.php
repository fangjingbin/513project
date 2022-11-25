<?php

session_start();
// check if the user is logged in, if nor then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
 header("location: http://localhost/login.php");
exit;
}
?>

<?php

require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name640'=>$productByCode[0]["name640"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) { 
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}




}
?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="website.css" />
<link rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
<div class="heading">
    <h1 class="logo"><img src="logo.jpg" width="200" height="100" alt=""/></a></h1>
    <ul class="shell">
        <li class="button">
            <span>Home</span>
            <ul>
                <li><a href="index2.php" accesskey="1" title="">Home</a></li>
            </ul>
        </li>
        <li class="button">
            <span>about</span>
            <ul>
                <li><a href="aboutus.php" accesskey="2" title="">About US</a></li>
            </ul>
        </li>

        <li class="portrait">
            <ul class="information">
                <li>Orderonline</li>
                <li><a href="upload.php" accesskey="3" title="">Careers </a></li>
            </ul>
        </li>
        <li class="button">
            <span>contact</span>
            <ul>
                <li><a href="contactus.php" accesskey="5" title="">Contact Us</a></li>
            </ul>
        </li>
        <li class="button">
            <span>register</span>
            <ul>
                <li><a href="vip.php" accesskey="6" title="">register vip</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="hero">
    <div class="items">
      <br></br>
      <h1 class="color4">Oderonline</h1>
      <p class="color3">Strat buying bread you love!</p>
    </div>
  </div>
  <a href="logout.php" class="signout" > Sign Out </a>

  <div class="wrapper">
	<div id="welcome" class="container">


	<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>
<a id="btnEmpty" href="orderonline.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	






<?php		

#删减选中的产品代码之处
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<table>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>   " class="cart-item-image" /><?php echo $item["name640"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="orderonline.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr></table>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>

	
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
	
		<div class="image">
			
			<div class="image"><img src="<?php echo $product_array[$key]["image"]; ?>"/>
			<button class="quick_look" data-id="<?php echo $product_array[$key]["id"] ; ?>">Quick Look</button>
			</div>
			<form method="post" action="orderonline.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name640"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			<div class="txt-heading2">-------------------------------------------------------------------------------------------------------------------------------</div>
			</div>
			
			</form>
			
		</div>
	<?php
		}
	}
	
	?>
</div>
</div>	



    </div>
    <div id="demo-modal"></div>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
    $(".quick_look").on("click", function() {
        var product_id = $(this).data("id");
        	var options = {
        			modal: true,
        			height: 'auto',
        			width:'70%'
        		};
        	$('#demo-modal').load('get-product-info.php?id='+product_id).dialog(options).dialog('open');
    });

    $(document).ready(function() {
        	$(".image").hover(function() {
                $(this).children(".quick_look").show();
            },function() {
            	   $(this).children(".quick_look").hide();
            });
    });
    </script>

<footer  class="footer2">  
              The creator of this website is Courtier
                </footer>

</body>
</html>