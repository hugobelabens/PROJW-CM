<?php

include_once 'classes/database.php';

class Acteur extends Database{
	public $klantId;
	public $klantNaam;
	public $klantEmail;
	public $klantAdres;
	public $klantPostcode;
	public $klantWoonplaats;
	
	// Methods
	
	public function setObject($nr, $voornaam, $achternaam){
		//self::$conn = $db;
		$this->nr = $nr;
		$this->voornaam = $voornaam;
		$this->achternaam = $achternaam;
	}

		
	/**
	 * Summary of getActeurs
	 * @return mixed
	 */
	public function getActeurs(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from KLANTEN")->fetchAll();
		return $lijst;
	}

	// Get acteur
	public function getActeur($nr){

		$sql = "select * from acteurs where NR = '$nr'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownActeur($row_selected = -1){
	
		// Haal alle acteurs op uit de database mbv de method getActeurs()
		$lijst = $this->getActeurs();
		
		echo "<label for='Acteurs'>Choose an actor:</label>";
		echo "<select name='acteurnr'>";
		foreach ($lijst as $row){
			if($row_selected == $row["NR"]){
				echo "<option value='$row[NR]' selected='selected'> $row[VOORNAAM] $row[ACHTERNAAM]</option>\n";
			} else {
				echo "<option value='$row[NR]'> $row[VOORNAAM] $row[ACHTERNAAM]</option>\n";
			}
		}
		echo "</select>";
	}

	/**
	 * Summary of showTable
	 * @param mixed $lijst
	 * @return void
	 */
	public function showTable($lijst){

		$txt = "<table border=1px>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td>" . $row["klantId"] . "</td>";
			$txt .=  "<td>" . $row["klantNaam"] . "</td>";
			$txt .=  "<td>" . $row["klantAdres"] . "</td>";
			$txt .=  "<td>" . $row["klantPostcode"] . "</td>";
			$txt .=  "<td>" . $row["klantWoonplaats"] . "</td>";
			$txt .=  "<td>" . $row["klantEmail"] . "</td>";
			
			// Update
			$txt .=  "<td>";
			$txt .= "
			<form method='post' action='update_acteur.php?nr=$row[klantId]'>
				<button name='update'>Wijzigen</button>
			</form>
			</td>";

			// Delete
			$txt .=  "<td>";
			$txt .= "
			<form method='post' action='delete.php?nr=$row[klantId]'>
				<button name='verwijderen'>Verwijderen</button>
			</form>
			</td>";
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete acteur
	/**
	 * Summary of deleteActeur
	 * @param mixed $nr
	 * @return bool
	 */
	public function deleteActeur($nr){

		$sql = "delete from acteurs where NR = '$nr'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
		return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateActeur2($nr, $naam, $achternaam){

		$sql = "update acteurs 
			set VOORNAAM = '$naam', ACHTERNAAM = '$achternaam' 
			WHERE NR = '$nr'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateActeurSanitized($klantId, $voornaam, $achternaam){

		$sql = "update KLANTEN 
			set klantId = :voornaam, klantNaam = :achternaam 
			WHERE klantId = :klantId";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'voornaam' => $voornaam,
			'achternaam'=> $achternaam,
			'klantId'=> $klantId
		]);  
	}
	
	public function updateActeur(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update KLANTEN 
			set klantNaam = :klantNaam, klantEmail = :klantEmail, klantAdres = :klantAdres, klantPostcode = :klantPostcode, klantWoonplaats = :klantWoonplaats 
			WHERE klantId = :klantId";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'klantNaam' => $this->klantNaam,
			'klantEmail' => $this->klantEmail,
			'klantAdres' => $this->klantAdres,
			'klantPostcode' => $this->klantPostcode,
			'klantWoonplaats' => $this->klantWoonplaats,
			'klantId' => $this->klantId
		]);
		return ($stmt->rowCount() == 1) ? true : false;		
	}
	
	/**
	 * Summary of BepMaxNr
	 * @return int
	 */
	private function BepMaxNr() : int {
		
		// Bepaal uniek nummer
		$sql="SELECT MAX(klantId)+1 FROM KLANTEN";
		return  (int) self::$conn->query($sql)->fetchColumn();
	}
	
	public function insertActeur(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		$this->klantId = $this->BepMaxNr();
		
		$sql = "INSERT INTO KLANTEN (klantId, klantNaam, klantAdres, klantPostcode, klantWoonplaats, klantEmail)
		VALUES (:klantId, :klantNaam, :klantAdres, :klantPostcode, :klantWoonplaats, :klantEmail)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute([
			'klantId' => $this->klantId,
			'klantNaam' => $this->klantNaam,
			'klantAdres' => $this->klantAdres,
			'klantPostcode' => $this->klantPostcode,
			'klantWoonplaats' => $this->klantWoonplaats,
			'klantEmail' => $this->klantEmail
		]);	
	
	
	}
}
?>
