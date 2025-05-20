<?php

$conn = new mysqli("localhost","root","","ripetizioni");

$CFs = $_GET['CFs'];
$CFt = $_GET['CFt'];

$sql = "SELECT s.id_studente as IDs
		FROM studenti s
		WHERE s.CF = '$CFs'";
		
$result = $conn->query($sql);

$row = $result->fetch_assoc();
$IDs = intval($row['IDs']);

$sql = "SELECT s.id_studente as IDt, s.id_materia
		FROM studenti s
		WHERE s.CF = '$CFt'";

$result = $conn->query($sql);

$row = $result->fetch_array();
$IDt = intval($row[0]);
$idMateria = intval($row[1]);


$sql = "INSERT INTO ripetizioni(orario,id_materia,id_studente,id_tutor)
				VALUES ('defin',$idMateria, $IDs, $IDt)";
	$conn->query($sql);
	
$sql = "SELECT * FROM ripetizioni";
$result = $conn->query($sql);

$rows = array();
while($row = $result->fetch_assoc()) {
    $rows[] = $row; // aggiunge ogni riga come array associativo
}

header('Content-Type: application/json');
echo json_encode($rows, JSON_PRETTY_PRINT); // stampa il JSON formattato



?>