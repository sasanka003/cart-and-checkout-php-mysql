<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel= apple-touch-icon type= image/png href= https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png />

<link rel= shortcut icon type= image/x-icon href= https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico />

<link rel= mask-icon type= image/x-icon href= https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg color= #111 />



<title>E-commerce Cart</title>  

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css'>
<link rel='stylesheet' href='nav.css'>


<script>
window.console = window.console || function(t) {};
</script>

<script>
window.console = window.console || function(t) {};
</script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style type="text/css">
	.alert, #loader {
    	display: none;
    }

    .glyphicon, #itemCount {
    	font-size: 18px;
    }
</style>
<body>
<?php require "nav/nav.php";?>

<section>
	<div class="container">
	
		<?php 
			require_once('db/DbConnect.php');
			$db   = new DbConnect();
			$conn = $db->connect();
	
			require 'classes/customer.class.php';
			$objCustomer = new customer($conn);
			$objCustomer->setEmail('durgesh@gmail.com');
			$customer = $objCustomer->getCustomerByEmailId();
			$_SESSION['cid'] = $customer['id'];
	
			require 'classes/cart.class.php';
			$objCart = new cart($conn);
			$objCart->setCid($customer['id']);
			$cartItems = $objCart->getAllCartItems();
		?>
		<div class="row">
			<div class="col-md-12 text-right">
				<a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span><sup id="itemCount"><?php echo count($cartItems); ?></sup></a>
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="alert alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
					<div id="result"></div>
				</div>
				<center><img src="images/loader.gif" id="loader"></center>
			</div>
	
			<?php 
	
				require 'classes/workshop.class.php';
				$objWorkshop = new workshop($conn);
				$workshops = $objWorkshop->getAllWorkshops();
				foreach ($workshops as $key => $workshop) {
			?>
		  <div class="col-sm-6 col-md-3">
			<div class="thumbnail">
			  <img src="images/<?= $workshop['image']; ?>" alt="" style="width: 200px; height: 200px;">
			  <div class="caption">
				<h3><?= $workshop['title']; ?></h3>
				<p><?= substr($workshop['description'], 0, 60) . '...'; ?></p>
				<p>
					<div class="row">
						<div class="col-sm-6 col-md-6">
							<strong> <span style="font-size: 18px;">&#x20b9;</span><?= number_format( $workshop['price'], 2 ); ?></strong>
						</div>
						<div class="col-sm-6 col-md-6">
							<?php 
								$disButton = "";
								if( array_search($workshop['id'], array_column($cartItems, 'pid')) !==false ) {
									$disButton = "disabled";
								}
							 ?>
							<button id="cartBtn_<?=$workshop['id'];?>" <?php echo $disButton; ?> class="btn btn-success" onclick="addToCart(<?=$workshop['id'];?>, this.id)" role="button">Book Seat</button>
						</div>
					</div>
				</p>
			  </div>
			</div>
		  </div>
		<?php } ?>
		</div>
		<div class="row">
			<div class="col-md-12 text-right">
				<a href="cart.php" class="btn btn-success">Seats <span class="glyphicon glyphicon-play"></span></a>
			</div>
		</div>
	</div>
	
	<div style="position: fixed; bottom: 10px; right: 10px; color: green;">
		<strong>
			Durgesh Sahani
		</strong>
	</div>
	</body>
	<script type="text/javascript">
	function addToCart(wId, btnId) {
		
		$('#loader').show();
		$.ajax({
			url: "action.php",
			data: "wId=" + wId + "&action=add",
			method: "post"
		}).done(function(response) {
			var data = JSON.parse(response);
			$('#loader').hide();
			$('.alert').show();
			if(data.status == 0) {
				$('.alert').addClass('alert-danger');
				$('#result').html(data.msg);
			} else {
				$('.alert').addClass('alert-success');
				$('#result').html(data.msg);
				$('#'+btnId).prop('disabled',true);
				$('#itemCount').text( parseInt( $('#itemCount').text() ) + 1);
			}
			
		})
	}
	</script>
</section>

</html>