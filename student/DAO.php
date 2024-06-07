<?php
require_once '../config/db.php';

class DAO {
	private $db;

	// za 2. nacin resenja
	private $INSERTOSOBA = "INSERT INTO osoba (ime, prezime, JMBG, vremeUpisa) VALUES (?, ?, ?, CURRENT_TIMESTAMP)";
	private $DELETEOSOBA = "DELETE  FROM osoba WHERE idosoba = ?";
	private $SELECTBYID = "SELECT * FROM osoba WHERE idosoba = ?";	
	private $GETLASTNOSOBA = "SELECT * FROM osoba ORDER BY idosoba DESC LIMIT ?";
	
	public function __construct()
	{
		$this->db = DB::createInstance();
	}
	private $STUDENTEXIST = "SELECT * from student where id=?";
	private $UPDATESTUDENT = "UPDATE student set ime=?,prezime=?,brIndeksa=? where id=?";
	
	public function studentExist($id){
		$statement=$this->db->prepare($this->STUDENTEXIST);
		$statement->bindValue(1,$id);

		$statement->execute();

		if($result=$statement->fetch()){
			return true;
		}
		else{
			return false;
		}
	}
	public function update($id,$ime,$prezime,$brIndeksa){
		$statement=$this->db->prepare($this->UPDATESTUDENT);
		$statement->bindValue(1,$ime);
		$statement->bindValue(2,$prezime);
		$statement->bindValue(3,$brIndeksa);
		$statement->bindValue(4,$id);

		$statement->execute();


	}























	public function getLastNOsoba($n)
	{
		// 1. nacin-NE RADI
		/*
		$statement = $this->db->prepare("SELECT * FROM osoba ORDER BY idosoba DESC LIMIT :n");
		$statement->execute(array(':n' => $n,));	// NE RADI, ???
		
		$result = $statement->fetchAll();
		return $result;
		*/
		
		// 2. nacin
		
		$statement = $this->db->prepare($this->GETLASTNOSOBA);
		$statement->bindValue(1, $n, PDO::PARAM_INT);
		
		$statement->execute();
		
		$result = $statement->fetchAll();
		return $result;
	}

	public function insertOsoba($ime, $prezime, $JMBG)
	{
		// 1. nacin
		/*
		$statement = $this->db->prepare("INSERT INTO osoba (ime, prezime, JMBG, vremeUpisa) VALUES (:ime, :prezime, :JMBG, CURRENT_TIMESTAMP)");
		$statement->execute(array(':ime'=>$ime, ':prezime'=> $prezime, ':JMBG'=>$JMBG));
		*/
		
		// 2. nacin
		$statement = $this->db->prepare($this->INSERTOSOBA);
		$statement->bindValue(1, $ime);
		$statement->bindValue(2, $prezime);
		$statement->bindValue(3, $JMBG);
		
		$statement->execute();
	}

	public function deleteOsoba($idosoba)
	{
		// 1. nacin
		/*
		$statement = $this->db->prepare("DELETE  FROM osoba WHERE idosoba = :idosoba");
		$statement->execute(array(':idosoba' => $idosoba));
		*/
		
		// 2. nacin
		$statement = $this->db->prepare($this->DELETEOSOBA);
		$statement->bindValue(1, $idosoba);
		
		$statement->execute();
	}

	public function getOsobaById($idosoba)
	{
		// 1. nacin
		/*
		$statement = $this->db->prepare("SELECT * FROM osoba WHERE idosoba = :idosoba");
		$statement->execute(array(':idosoba' => $idosoba));
		
		$result = $statement->fetch();
		return $result;
		*/
		
		// 2. nacin
		$statement = $this->db->prepare($this->SELECTBYID);
		$statement->bindValue(1, $idosoba);
		
		$statement->execute();
		
		$result = $statement->fetch();
		return $result;
	}

	 // New SQL queries
	 private $SELECTMINPRISUSTVO = "SELECT * FROM Prisustva ORDER BY trajanjePrisustva ASC LIMIT 1";
	 private $INSERTPRISUSTVO = "INSERT INTO Prisustva (brRadnika, trajanjePrisustva) VALUES (?, ?)";
	 

	public function getMinPrisustvo() {
        $statement = $this->db->prepare($this->SELECTMINPRISUSTVO);
        
        $statement->execute();
        
        $result = $statement->fetch();
        return $result;
    }
    
	
    // New method to insert worker presence data
    public function insertPrisustvo($brRadnika, $trajanjePrisustva) {
        $statement = $this->db->prepare($this->INSERTPRISUSTVO);
        $statement->bindValue(1, $brRadnika, PDO::PARAM_INT);
        $statement->bindValue(2, $trajanjePrisustva, PDO::PARAM_INT);
        
        $statement->execute();
    }
}
?>
