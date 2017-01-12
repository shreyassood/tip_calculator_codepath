<!doctype html>

<?php

$GLOBALS["choices"] = array(10, 15, 20);

$totalValid = isset($_GET["total"]) && validateTotal($_GET["total"]);
$tipValid = isset($_GET["percentage"]) && validateTip($_GET["percentage"]);

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
  <title>Tippy</title>
  <meta name="description" content="A simple tip-calculator app">
  <style>
  	.invalid 
  	{
  		color : red;
  	}
  	.result 
  	{
  		padding: 1em;
  		background-color:skyblue;
  	}
  </style>
</head>

<body>
	<h2>Tippy</h2>

	<p>
		<form action="index.php">
		
		<div
			<?php 
			if (isset($_GET["total"]) && !$totalValid) 
				{ 
					echo 'class = "invalid"'; 
				} 
			?>
		>
		Bill subtotal: $ <input type="text" name="total"

		<?php

		if(isset($_GET["total"]) && $totalValid) {
					echo 'value="' . $_GET["total"] . '"';
		} else {
			echo 'value="0"';
		}
		
		?>

		
		>
		</div>

		<br/>

		<div
			<?php 
			if (isset($_GET["percentage"]) && !$tipValid) 
				{ 
					echo 'class = "invalid"'; 
				} 
			?>
		>
			Tip percentage:
			<?php

			

			foreach ($GLOBALS["choices"] as $choice) {
				echo '<input type="radio" name="percentage" value="' . $choice . '"';

				if(isset($_GET["percentage"]) && $tipValid) {
					if(intval($choice, 10) == intval($_GET["percentage"], 10)) {
						echo 'checked';
					}
				} else {
					if($choice == 10) {
						echo 'checked';
					}
				}

				echo '>' . $choice .'%';
			}

	  		?>
  		</div>

  		<br/>
  		<input type="submit">
		</form>

		<br />
			<?php 
			if($tipValid && $totalValid) {

					echo '<div class="result"><b>';

					$subTotalAmount = intval($_GET["total"], 10);
					$tipAmount =  $subTotalAmount * intval($_GET["percentage"], 10) / 100.0;
					echo "Tip: $ " . $tipAmount . "\n<br/>\n";
					echo "Total: $ " . ($tipAmount + $subTotalAmount);

					echo '</b></div>';
				}
			?>

	</p>
</body>

</html>