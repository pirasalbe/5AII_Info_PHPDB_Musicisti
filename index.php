<?php
	$risultato="";
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
		$sql = "SELECT nome 
		FROM artisti
		where nazionalita='spagnola'";
	}
	
	if(isset($_POST['artista']))
	{
		$sql = "SELECT titolo, durata 
		FROM brani b inner join artisti a on b.idartista=a.id
		where a.nome='mina'";
	}
	
	if(isset($_POST['album']))
	{
		$sql = "SELECT b.titolo, b.durata, b.posizione 
		FROM brani b inner join registrazioni r on b.idregistrazione=r.id
		where r.titolo='the dark side of the'";
	}
	
	if(isset($_POST['albumartista']))
	{
		$sql = "SELECT sum(durata)
		FROM (brani b inner join registrazioni r on b.idregistrazione=r.id) inner join artisti a on a.id=b.idartista
		where a.nome='eminem'";
	}
	
	$risultato = showQuery($sql, $conn);
	
	function showQuery($query, $conn)
	{
		if($query=="") return;
		
		$result = $conn->query($query);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row;
			}
		} else {
			return "0 results";
		}
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
											echo "<div class='alert alert-success'>" . $risultato . "</div>";
									
									?>
							</div>
                        </div>
						
    				</div>		
				
				</form>
			
            </div>
	</body>
</html>