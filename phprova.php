<?php

$conn = new mysqli("localhost","root","","ripetizioni");

echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Risultati</title>
        <meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=0.5'>
		<link rel='stylesheet' href='stileAPI.css'>
		
    <title>Form con GET</title>
    </head>
    <body>";


if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$nome = $_GET['nome'];
	$materia = $_GET['materia'];
	$ruolo = $_GET['ruolo'];
	$CF = $_GET['CF'];
	
	
	if($ruolo == 1){
		
		$sql = "SELECT m.ID
				FROM materia m
				WHERE m.nome = '$materia'";
		$result = $conn->query($sql);
		
		if($result && $result->num_rows > 0){
			// MATERIA GIA ESISTENTE
			 $row = $result->fetch_assoc(); // ottieni la riga come array associativo
			 $id = intval($row['ID']);
			 
			 $sql = "UPDATE studenti SET id_materia = $id WHERE CF='$CF'";
			 $conn->query($sql);
			 
		}else{
			// MATERIA NON ESISTENTE
				$sql = "INSERT INTO materia (nome)
						VALUES ('$materia')";
						
				$conn->query($sql);
			
			
				$sql = "SELECT m.ID
						FROM materia m
						WHERE m.nome = '$materia'";
					
				$result = $conn->query($sql);
		
				if($result && $result->num_rows > 0){
			
					$row = $result->fetch_assoc(); // ottieni la riga come array associativo
					$id = intval($row['ID']);
			 
					$sql = "UPDATE studenti SET id_materia = $id WHERE CF='$CF'";
					$conn->query($sql);
			 
				}
			
			
		}
		
	}else{
		$sql = "SELECT m.ID
				FROM materia m
				WHERE m.nome = '$materia'";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc(); // ottieni la riga come array associativo
			$id = intval($row['ID']);
			
			$sql = "SELECT nome, cognome, tutor, CF
					FROM studenti s 
					WHERE id_materia = $id
					AND tutor = 1";
			
			$result = $conn->query($sql);
			
			echo "<table border>
					<tr>
					<th>Nome</th>
					<th>Cognome</th>
					<th>TUTOR?</th>
					</tr>";
			
			
			while($row = $result->fetch_array()){
				echo "<tr>
						<td>$row[0]</td>
						<td>$row[1]</td>
						<td>$row[2]</td>
						<td><form action='finale.php' method='GET'>
								
								<input type='hidden' name='CFs' value='$CF'>
								<input type='hidden' name='CFt' value='$row[3]'>
								<button type='submit'>SELEZIONA</button>
							</form>
						</td>
					  </tr>";
				
			}
			
			echo "</table></body></html>";
		
	}
	
}

?>