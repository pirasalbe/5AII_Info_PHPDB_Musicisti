<?php
	$risultato= array();
	$sql="";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "artisti";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
} 

	if(isset($_POST['nazionalita']))
	{
		$value = $_POST['naz'];
		$sql = "SELECT nome 
		FROM artisti
		where nazionalita='" . $value . "'";
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, $value["nome"]);
	}
	
	if(isset($_POST['artista']))
	{
		$value = $_POST['art'];
		$sql = "SELECT titolo, durata 
		FROM brani b inner join artisti a on b.idartista=a.id
		where a.nome=" . $value . "";
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Titolo: " . $value["titolo"] . " Durata: " . $value["durata"]);
	}
	
	if(isset($_POST['album']))
	{
		$value = $_POST['alb'];
		$sql = "SELECT b.titolo, b.durata, b.posizione 
		FROM brani b inner join registrazioni r on b.idregistrazione=r.id
		where r.titolo='" . $value . "'";
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Titolo: " . $value["titolo"] . " Durata: " . $value["durata"] . " Posizione: " . $value["posizione"]);
	}
	
	if(isset($_POST['albumartista']))
	{
		$value = $_POST['albart'];
		$sql = "SELECT sum(durata) as somma
		FROM (brani b inner join registrazioni r on b.idregistrazione=r.id) inner join artisti a on a.id=b.idartista
		where a.nome='" . $value . "'";
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Durata Totale: " . $value["somma"]);
	}
	
	function showQuery($query, $conn)
	{
		if($query=="") return;
		$risultato = array();
		
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($risultato, $row);
			}
		} else {
			return "0 results";
		}
		
		return $risultato;
	}

$conn->close();
?>

<html>
<head>
            <title>
                Query
            </title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>

	<body>
            <div class="table-responsive">
			
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
				    
				    <div class="container">
    					
    					<div class="row">
    						<div class="jumbotron text-center"><h2>Query Artisti</h2></div>
    					</div>
				
						<div class="row">
							<div class="col-sm-2">
								<label for="login">Nazionalita:</label>
							</div>
							<div class="col-sm-4">
									<input type="text" class="form-control" name="naz">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="nazionalita" value="Query Nazionalita">
							</div>
                        </div>	
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="login">Artista:</label>
							</div>
							<div class="col-sm-4">
									<input type="text" class="form-control" name="art">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="artista" value="Query Artista">
							</div>
                        </div>
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="login">Album:</label>
							</div>
							<div class="col-sm-4">
									<input type="text" class="form-control" name="alb">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="album" value="Query Album">
							</div>
                        </div>
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="login">Album Artista:</label>
							</div>
							<div class="col-sm-4">
									<input type="text" class="form-control" name="albart">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="albumartista" value="Query Album Artista">
							</div>
                        </div>
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="login">Risultato query:</label>
							</div>
							<div class="col-sm-4">
									<?php 
									
										if($risultato!="")
											foreach($risultato as $value)
												echo "<div class='alert alert-success'>" . $value . "</div><br>";
									
									?>
							</div>
                        </div>
						
    				</div>		
				
				</form>
			
            </div>
	</body>
</html>