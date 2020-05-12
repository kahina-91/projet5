<?php
	namespace kah\model;

	use kah\model\BddManager;
	use PDO;

class AgenceManager extends BddManager
{
	public function getNounousValids()
	{
		$sql = 'SELECT * FROM nounous WHERE profil_valide = "1"';
		$query = $this->getBdd()->prepare($sql);
		$query->execute();
        return $query;

	}

	public function insertLatLonNounou($lat, $lon, $nounouId)
	{

		$sql = 'UPDATE  nounous SET lat = ?, lon = ? WHERE id = ?';

		$nounous = $this->getBdd()->prepare($sql);
		$nounous->execute(array($lat, $lon, $nounouId));            
		return $nounous;

	}

	public function getNounous($limite, $debut)
	{
        
        $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM nounous WHERE profil_valide = "0" LIMIT :limite OFFSET :debut';
        $nounou = $this->getBdd()->prepare($sql);
        $nounou->bindValue('debut', $debut, PDO::PARAM_INT);
        $nounou->bindValue('limite', $limite, PDO::PARAM_INT);
        $nounou->execute();

        $resultRows = $this->getBdd()->query('SELECT found_rows()');;

        $nbrTotal = $resultRows->fetchColumn();
        return [
            'nounou' => $nounou, 
            'nbrTotal' => $nbrTotal
        ];
    }

	public function insertNounou($nom, $prenom, $naissance, $mail, $pseudo, $tel, $adress, $experience)
	{
		$sql = ('INSERT INTO nounous(nom, prenom, naissance, mail, pseudo, tel, adress, experience, profil_valide) VALUES(?, ?, ?, ?, ?, ?, ?, 0)');
		$req = $this->getBdd()->prepare($sql);
		$nounous = $req->execute(array($nom, $prenom, $naissance, $mail, $pseudo, $tel, $adress, $experience));
        return $nounous;
	}


	public function nounouValidat($nounouId) 
	{

		$sql = ('UPDATE  nounous SET profil_valide = "1" WHERE id = ?');

		$nounous = $this->getBdd()->prepare($sql);
		$nounous->execute(array($nounouId));            
		return $nounous;

	}

	public function getNounouValid($nounouId)
	{

		$sql = 'SELECT * FROM nounous WHERE id = ?';
		$query = $this->getBdd()->prepare($sql);
        $query->execute(array($nounouId));
        return $query;

	}
	
	public function nounouUnique($mail)
    {

        $sql = 'SELECT * FROM nounous WHERE mail = ?';
        $rqt = $this->getBdd()->prepare($sql);
        $rqt->execute(array($mail));
        $exist = $rqt->rowCount();
        
        return $exist;

    }

}
