<?php
	if(isset($_GET['red']) && isset($_GET['green']) && isset($_GET['blue'])){
		$hex = [];

		function convertToHex($p){
			$h = dechex($p);
			if(strlen($h) < 2){
				$h =  '0'.$h ;
			}
			return $h;
		}
		$hex[] =   convertToHex($_GET['red']);
		$hex[] =   convertToHex($_GET['green']);
		$hex[] =   convertToHex($_GET['blue']);
		$hex = strtoupper(implode('',$hex));
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>RGB to HEX</title>
</head>

<body>
	<h4>RGB to HEX</h4>

	<form action="#">
		<label for="red">Red:
			<input type="text" id="red" name="red">
		</label>

		<label for="green">Green:
			<input type="text" id="green" name="green">
		</label>

		<label for="blue">Blue:
			<input type="text" id="blue" name="blue">
		</label>

		<input type="submit" />
	</form>

	<p>Hexadecimal: #<?= isset($hex) ? $hex: ''?></p>
</body>

</html>