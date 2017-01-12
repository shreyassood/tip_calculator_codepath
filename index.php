<!doctype html>

<?php

$GLOBALS["choices"] = array(10, 15, 20);

function validateTotal($total) {
	if(is_null($total)) {
		return false;
	}

	if($total == "") {
		return false;
	}

	if(is_numeric($total) && intval($total, 10) > 0) {
		return true;
	}

	return false;
}

function validateTip($percentage) {
	if(is_null($percentage)) {
		return false;
	}

	if(is_numeric($percentage)) {
		$value = intval($percentage, 10);
		foreach ($GLOBALS["choices"] as $choice) {
			if($choice == $value) {
				return true;
			}
		}
	}

	return false;
}



?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>The HTML5 Herald</title>
  <meta name="description" content="A simple tip-calculator app">
  <style>
  	.invalid 
  	{
  		color : red;
  	}
  </style>
</head>

<body>
	<h2>Tip Calculator</h2>

	<p>
		<form action="index.php">
		
		<div
			<?php 
			if (!isset($_GET["total"]) || !validateTotal($_GET["total"])) 
				{ 
					echo 'class = "invalid"'; 
				} 
			?>
		>
		Bill subtotal: $ <input type="text" name="total"

		<?php

		if(isset($_GET["total"]) && validateTotal($_GET["total"])) {
					echo 'value="' . $_GET["total"] . '"';
		}
		
		?>

		
		>
		</div>

		<br/>

		<div
			<?php 
			if (!isset($_GET["percentage"]) || !validateTip($_GET["percentage"])) 
				{ 
					echo 'class = "invalid"'; 
				} 
			?>
		>
			Tip percentage:
			<?php

			

			foreach ($GLOBALS["choices"] as $choice) {
				echo '<input type="radio" name="percentage" value="' . $choice . '"';

				if(isset($_GET["percentage"]) && validateTip($_GET["percentage"])) {
					if(intval($choice, 10) == intval($_GET["percentage"], 10)) {
						echo 'checked';
					}
				}

				echo '>' . $choice .' $';
			}

	  		?>
  		</div>

  		<br/>
  		<br/>
  		<input type="submit">
		</form>
	</p>
</body>

</html>