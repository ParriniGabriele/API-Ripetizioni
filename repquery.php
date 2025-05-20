<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName ="ripetizioni";

$conn = new mysqli($host,$user,$password,$dbName);

if ($_SERVER["REQUEST_METHOD"] === "GET") {
   // $codUtente = htmlspecialchars($_GET['codUtente'] ?? '');
    $nomeStudente = htmlspecialchars($_GET['nome']);
	$cognomeStudente = htmlspecialchars($_GET['cognome']);
	$classe = htmlspecialchars($_GET['class']);
	$sezione = htmlspecialchars($_GET['sezione']);
	$codiceFiscale = strtoupper(htmlspecialchars($_GET['codice_fiscale']));
	$indirizzo =($_GET['indirizzo']);
	$ruolo =($_GET['ruolo']);
	
	
		//CONTROLLO SULL'ESISTENZA DELLA CLASSE
		$sql = "SELECT classe, sezione, indirizzo FROM classe c WHERE c.classe = $classe AND c.sezione = '$sezione' AND c.indirizzo = '$indirizzo'";
		$result = $conn->query($sql);
		 if (!$result) {
        die("Errore nella query di verifica classe: " . $conn->error);
		}

		if($result->num_rows === 0){
			//SE LA CLASSE NON ESISTE ALLORA IL CODICE PROSEGUIRA' DA QUESTA PARTE
			$sql = "INSERT INTO classe (classe, sezione, indirizzo) VALUES ($classe, '$sezione', '$indirizzo')";
		
		if($conn->query($sql)){
			echo "Dati inseriti";
		}else{
			echo "ERRORORORORORORE";   
		}
			//CONTROLLO SULL'ESISTENZA DELLO STUDENTE
			$sql = "SELECT * FROM studenti WHERE CF = '$codiceFiscale'";
			$result = $conn->query($sql);

			if (!$result) {
				die("Errore nella query di controllo CF: " . $conn->error);
			}

			if ($result->num_rows > 0) {
				//SE LO STUDENTE E' GIA STATO INSERITO
					if($ruolo == 0){
						header("Location: paginaStudente.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						exit();
					}else{
						header("Location: paginaTutor.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						
						exit();
					}
				
			} else {
				//SE LO STUDENTE NON E' STATO INSERITO
				$sql = "SELECT c.ID FROM classe c WHERE c.classe =$classe AND c.sezione ='$sezione' AND c.indirizzo = '$indirizzo'";
		
				$result = $conn->query($sql);
				$row = $result->fetch_array();
				$idClasse = $row['ID'];
		
				$sql = " INSERT INTO studenti (nome, cognome, tutor, id_classe, CF) VALUES ('$nomeStudente', '$cognomeStudente', $ruolo, $idClasse, '$codiceFiscale')";
		
				$result = $conn->query($sql);
				if (!$result) {
					die("Errore nella query di verifica classe: " . $conn->error);
				}
					if($ruolo == 0){
						header("Location: paginaStudente.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						exit();
					}else{
						header("Location: paginaTutor.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						
						exit();
					}
				
			}
		
		
		
		}else{
			//SE LA CLASSE ESISTE, IL CODICE PROSEGUIRAì DA QUESTA PARTE
			$sql = "SELECT * FROM studenti WHERE CF = '$codiceFiscale'";
			$result = $conn->query($sql);

			if (!$result) {
				die("Errore nella query di controllo CF: " . $conn->error);
			}
			if ($result->num_rows > 0) {
				//SE LO STUDENTE ESISTE
					if($ruolo == 0){
						header("Location: paginaStudente.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						exit();
					}else{
						header("Location: paginaTutor.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						
						exit();
					}
			} else {
				//SE LO STUDENTE NON ESISTE
				$sql = "SELECT c.ID FROM classe c WHERE c.classe =$classe AND c.sezione ='$sezione' AND c.indirizzo = '$indirizzo'";
		
				$result = $conn->query($sql);
				$row = $result->fetch_array();
				$idClasse = $row['ID'];
		
				$sql = " INSERT INTO studenti (nome, cognome, tutor, id_classe, CF) VALUES ('$nomeStudente', '$cognomeStudente', $ruolo, $idClasse, '$codiceFiscale')";
		
				$result = $conn->query($sql);
				if (!$result) {
					die("Errore nella query di verifica classe: " . $conn->error);
				}
				if($ruolo == 0){
						header("Location: paginaStudente.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						exit();
					}else{
						header("Location: paginaTutor.html?nome=". urlencode($nomeStudente). "&cognome=". urlencode($cognomeStudente)."&ruolo=". urlencode($ruolo)."&CF=".urlencode($codiceFiscale));
						
						exit();
					}
				
			}

			
		}
	
	}



?>