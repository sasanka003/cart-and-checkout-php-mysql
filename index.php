<!DOCTYPE html>
<html>
<head>
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
			require 'classes/customer.class.php';
			$objCustomer = new customer($conn);
			$objCustomer->setEmail('durgesh@gmail.com');
			$customer = $objCustomer->getCustomerByEmailId();
			$_SESSION['cid'] = $customer['id'];
			
			$objCart->setCid($customer['id']);

		?>


	
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
				<a href="cart.php" class="btn btn-success"><i class="bx bxs-cart icon-single"></i> Cart</a>
			</div>
		</div>
	</div>
	
	<div style="position: fixed; bottom: 10px; right: 10px; color: green;">
        <a href="https://www.instagram.com/your_instagram_username" target="_blank" rel="noopener noreferrer">
            <i class="material-icons" style="vertical-align: middle;">camera_alt</i>
            <strong style="margin-left: 5px;">
                Instagram
            </strong>
        </a>
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
				$('#itemCount').text( data.data.itemCount);
				$('#itemCountMobile').text(data.data.itemCount);
			}
			
		})
	}
	</script>
</section>

</html>