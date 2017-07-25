<?php
	include("db_connect.php");
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$RunDate = $_POST['RunDate'];
		$RunDistance = $_POST['RunDistance'];
		$RunComment = $_POST['RunComment'];
		
		$sql = "INSERT INTO runs values (NULL, '" . $RunDate . "','" . $RunDistance . "','". $RunComment. "');";
		// echo $sql;
		
		if ($conn->query($sql) === TRUE) 
		{	// echo "New Record Created Successfully";
		} else {
				echo "Error: ". $sql . "<br>" . $conn->error;
		}
		
		header("Refresh");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Run Tracker1</title>
	</head>
	<style>
		
		Table, tr, th, td
		{
			border: solid black 1px;
			color: black;
		}
		
		Table
		{
			border-collapse: collapse;
		}
		
		.odd
		{
			background-color: aqua;
			
		}
		.even
		{
			background-color:coral
			color: black
		}
	</style>
	<body>
		<h1>Run History</h1>
		<?php
			$odd = false;
			$query = "SELECT * FROM runs";
			$result = $conn->query($query);
			$out = "<table>";
			$out .= "<tr class='odd'><th>Date</th><th>Distance</th><th>Notes</th></tr>";
			while($row = $result->fetch_assoc())
			{
				if($odd){
					$out .= "<tr class='odd'>";
				}else
				{
					$out .= "<tr class='even'>";
				}
				$out .= "<td>";
				$out .= $row['RunDate'] . "</td><td>" . $row['RunDistance'] . "</td><td>" . $row['RunComment'] . "</td></tr>";
				$odd = !$odd;
			}
			$out .= "</table>";
			echo $out;
		?>
		<h2>Add New Run</h2>
		<form method="post" action="index.php">
		<label for="RunDate">Date:</label><input type="date" name="RunDate" id="RunDate"/><br/>
		<label for="RunDistance">Distance:</label><input type="text" name="RunDistance"/><br/>
		<label for="RunComment">Comment/Note:</label><input type="text" name="RunComment" id="RunComment"/><br/>
		<input type="submit" value="Save" />
		
		</form>
	</body>
</html>
