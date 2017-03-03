<?php
	$risultato= array();
	$sql="";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "orchestrapiras";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
} 

	if(isset($_POST['categoria']))
	{
		$value = $_POST['cat'];
		$sql = "select m.nome, m.cognome, m.datanascita, a.nomestr
				from (musicisti m inner join abilita a on a.codmus=m.codmus)
				where m.nome in (select m.nome
				from (musicisti m inner join abilita a on a.codmus=m.codmus) 
				inner join strumenti s on s.nomestr=a.nomestr
				where s.categoria='" . $value . "')";
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Nome: " . $value["nome"] . " Cognome: " . $value["cognome"] . " Strumenti: " . $value["nomestr"]);
	}
	
	if(isset($_POST['strumenti']))
	{
		$value = $_POST['str'];
		$sql = "select nome, cognome, datanascita
				from musicisti m inner join abilita a on a.codmus=m.codmus
				group by nome, cognome, datanascita having count(*)>" . $value;
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Nome: " . $value["nome"] . " Cognome: " . $value["cognome"]);
	}
	
	if(isset($_POST['musicisti']))
	{
		$value = $_POST['mus'];
		$sql = "select distinct(a.nomestr)
				from musicisti m inner join abilita a on a.codmus=m.codmus
				group by a.nomestr having count(*)=" . $value;
			
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Strumenti: " . $value["nomestr"]);
	}
	
	if(isset($_POST['sesso']))
	{
		if(isset($_POST['mas']))
			$sql = "select a.nomestr
					from musicisti m inner join abilita a on a.codmus=m.codmus
					where m.sesso='M' and a.nomestr not in (select a.nomestr
					from musicisti m inner join abilita a on a.codmus=m.codmus
					where sesso='F')";
		else
			$sql = "select a.nomestr
					from musicisti m inner join abilita a on a.codmus=m.codmus
					where m.sesso='F' and a.nomestr not in (select a.nomestr
					from musicisti m inner join abilita a on a.codmus=m.codmus
					where sesso='M')";
	
		$risultatoArray = showQuery($sql, $conn);
		
		foreach($risultatoArray as $value)
			array_push($risultato, "Strumenti: " . $value["nomestr"]);
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
    						<div class="jumbotron text-center"><h2>Query Musicisti</h2></div>
    					</div>
				
						<div class="row">
							<div class="col-sm-2">
								<label for="cat">Categoria:</label>
							</div>
							<div class="col-sm-4">
									<input type="text" class="form-control" name="cat">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="categoria" value="Query Categoria">
							</div>
                        </div>	
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="str">Strumenti:</label>
							</div>
							<div class="col-sm-4">
									<input type="number" class="form-control" name="str">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="strumenti" value="Query Strumenti">
							</div>
                        </div>
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="mus">Musicisti:</label>
							</div>
							<div class="col-sm-4">
									<input type="number" class="form-control" name="mus">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="musicisti" value="Query Musicisti">
							</div>
                        </div>
						
						<br>
						
						<div class="row">
							<div class="col-sm-2">
								<label for="login">Sesso:</label>
							</div>
							<div class="col-sm-2">
									<input type="checkbox" class="form-control" name="mas" checked>
							</div>
							<div class="col-sm-2">
									<input type="checkbox" class="form-control" name="fem">
							</div>
							<div class="col-sm-2">
									<input class="btn btn-default" align="center" type="submit" name="sesso" value="Query Sesso">
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