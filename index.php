

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of inputs
    $weight = intval($_POST['weight']);
    $R_P_T = intval($_POST['R_P_T']);
    

    if (empty($weight)) {
        echo '<div class="alert alert-warning" role="alert">Weight must be entered</div>';
    } else {
        $weight = $weight;
    }
    
    
    if (empty($R_P_T)) {
        echo '<div class="alert alert-warning" role="alert">Rate per Ton needs to be entered</div>';
    } else {
        $R_P_T = $R_P_T;
    }
    
    $qoute = $weight * $R_P_T;
    if (!$qoute) {
        return;
    } else {
    echo '<div class="alert alert-success" role="alert"><h1>Your quote is: $' . $qoute . '</h1></div>';
}
}
?>

<html>
    <head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.container {
			background-color: #ffffff;
			border-radius: 10px;
			box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
			margin: 50px auto;
			max-width: 400px;
			padding: 20px;
		}

		h1 {
			color: #333333;
			font-size: 24px;
			font-weight: bold;
			margin: 0 0 20px;
			text-align: center;
		}

		form {
			display: flex;
			flex-direction: column;
			margin-top: 20px;
		}

		input[type="text"] {
			background-color: #f2f2f2;
			border: none;
			border-radius: 5px;
			box-sizing: border-box;
			color: #333333;
			font-size: 16px;
			margin: 10px 0;
			padding: 10px;
			transition: background-color 0.3s ease;
			width: 100%;
		}

		input[type="text"]:focus {
			background-color: #ffffff;
			box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
			outline: none;
		}

		input[type="submit"] {
			background-color: #333333;
			border: none;
			border-radius: 5px;
			box-sizing: border-box;
			color: #ffffff;
			cursor: pointer;
			font-size: 16px;
			margin-top: 20px;
			padding: 10px;
			transition: background-color 0.3s ease;
		}

		input[type="submit"]:hover {
			background-color: #555555;
		}

		.alert alert-warning {
			color: #ff0000;
			font-size: 14px;
			margin: 10px 0 0;
			text-align: center;
		}

		.alert alert-success {
			background-color: #f2f2f2;
			border-radius: 5px;
			box-sizing: border-box;
			color: #333333;
			font-size: 16px;
			margin-top: 20px;
			padding: 10px;
			text-align: center;
		}

        button {
            background-color: #333333;
			border: none;
			border-radius: 5px;
			box-sizing: border-box;
			color: #ffffff;
			cursor: pointer;
			font-size: 16px;
			margin-top: 20px;
			padding: 10px;
			transition: background-color 0.3s ease;
        }
        
	</style>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <p id="comingSoon"></p>
	<div class="container">
		<h1>Garbage Company Quote</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<label for="weight">Weight:</label>
			<input type="text" id="weight" name="weight">
			<label for="rpt">Rate Per Ton:</label>
			<input type="text" id="R_P_T" name="R_P_T">
            
			<input type="submit" value="Get Quote">
            <hr />
            <button type="button" onclick="comingSoon()">Submit Dump Ticket *Requires Account*</button>
		</form>
        
        <script>
            function comingSoon() {
                document.getElementById("comingSoon").innerHTML = "Coming soon you will be able to track your dump tickets and save them in your own dashboard";
            };
        </script>
</body>
</html>