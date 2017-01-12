<!doctype html>

<?php

$GLOBALS["choices"] = array(10, 15, 20);

$totalValid = isset($_POST["total"]) && validateTotal($_POST["total"]);
$tipValid = isset($_POST["percentage"]) && validateTip($_POST["percentage"]);

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
		<form action="index.php" method="post">
		
		<div
			<?php 
			if (isset($_POST["total"]) && !$totalValid) 
				{ 
					echo 'class = "invalid"'; 
				} 
			?>
		>
		Bill subtotal: $ <input type="text" name="total"

		<?php

		if(isset($_POST["total"]) && $totalValid) {
					echo 'value="' . $_POST["total"] . '"';
		} else {
			echo 'value="0"';
		}
		
		?>

		
		>
		</div>

		<br/>

		<div
			<?php 
			if (isset($_POST["percentage"]) && !$tipValid) 
				{ 
					echo 'class = "invalid"'; 
				} 
			?>
		>
			Tip percentage:
			<?php

			

			foreach ($GLOBALS["choices"] as $choice) {
				echo '<input type="radio" name="percentage" value="' . $choice . '"';

				if(isset($_POST["percentage"]) && $tipValid) {
					if(intval($choice, 10) == intval($_POST["percentage"], 10)) {
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

					$subTotalAmount = intval($_POST["total"], 10);
					$tipAmount =  $subTotalAmount * intval($_POST["percentage"], 10) / 100.0;
					printf("Tip: $%.2f\n<br />\n", $tipAmount);
					printf("Total: $%.2f", ($tipAmount + $subTotalAmount));

					echo '</b></div>';
				}
			?>

	</p>
</body>

</html>