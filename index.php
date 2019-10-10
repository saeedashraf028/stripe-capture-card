<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon.png">
	<title>Security Deposit - Booking.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style.css">
</head>

<body>
<?php 
	//replace with your keys
	$p_key = 'pk_test_kSXR5rtXKYfadGycFWvXnWSz';
	$s_key = 'sk_test_nkV0xgoy1H71WDVZf8AVGwfp';
	
	
	$amount = '50000'; // enter amount here
	$msg = '';
	
	if(isset($_POST['stripeToken']) and $_POST['stripeToken']!='')
	{
		require_once('vendor/autoload.php');
		$token = $_POST['stripeToken'];
		try{
			\Stripe\Stripe::setApiKey($s_key);
			$charge = \Stripe\Charge::create([
				'amount' => $amount,
				'currency' => 'cad',
				'description' => 'Security Deposit booking.com reservation',
				'source' => $token,
				'capture' => false,
			]);
			
			if($charge){
				$msg = '<div class="label label-success">Payment Completed Successfully.</div>';
			}
			
		} catch(Exception $e){
			$msg = '<div class="label label-danger">'.$e->getMessage().'</div>';
		}
		
	}
?>

    <div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="header">
					<img src="assets/logo.png" class="img-responsive" />
				</div>
				<div class="response"><?php echo $msg ?></div>
				<div class="panel panel-default">
				  <div class="panel-body">
					<h1>Security Deposit</h1>
					<h4>Required to confirm your booking.com reservation</h4>
					
					<form action="" method="post">
						<script
							src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="<?=$p_key?>"

							data-amount="<?=$amount?>"
							data-locale="us-en"
							data-currency="cad"
							data-name="Security Deposit"
							data-description="Security Deposit booking.com reservation" 
							data-image="assets/logo-70.png"
							data-locale="auto"
							data-label="Pay Security Deposit",
							>
						</script>
					</form>
					
					
				  </div>
				</div>
			</div>
		</div><!--/*row -->
	</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
  $(function() {
    $(".stripe-button-el").replaceWith('<button type="submit" class="btn btn-default">Pay Security Deposit</button>');
  });
</script>
