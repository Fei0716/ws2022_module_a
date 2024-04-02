<?php
	if (isset($_GET['date1']) && isset($_GET['date2'])){
		$date1 = date_create($_GET['date1']);
		$date2 = date_create($_GET['date2']);
		$difference = date_diff($date1, $date2);
	}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Number of Days</title>
</head>

<body>
	<h4>Calculate number of days</h4>

	<form action="#" >
		<label for="date1">Date 1:
			<input type="date" id="date1" name="date1">
		</label>

		<label for="date2">Date 2:
			<input type="date" id="date2" name="date2">
		</label>

		<input type="submit" />
	</form>

	<p>Output: <?=isset($difference) ? $difference->format('%r%a days') : 0 ?></p>
</body>

</html>