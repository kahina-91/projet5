<?php
	/*namespace kah\src\model;

	use kah\app\core\Session;
	use kah\app\core\Request;
	use kah\app\core\Controller;
	use PDO;
	use kah\src\model;*/

class AgenceManager extends BddManager
{
	public function getNounousValids()
	{
		$sql = 'SELECT * FROM user WHERE role = "ROLE_NOUNOU"';
		$query = $this->getBdd()->prepare($sql);
        $query->execute();
        return $query;

	}

	public function getAgence($recherch)
	{
		$sql = 'SELECT id, lat, ville FROM agences WHERE ville LIKE "?" ORDER BY id DESC';	
		$query = $this->getBdd()->prepare($sql);
        $query->execute(array("%".$recherch."%"));
        return $query;

	}


	public function insertLatLonNounou($lat, $lon, $nounouId)
	{

		$sql = 'UPDATE  nounous SET lat = :lat, lon = :lon WHERE id = ?';

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
// var_dump($nounou->fetchAll());die;
        return [
            'nounou' => $nounou, 
            'nbrTotal' => $nbrTotal
        ];
    }

	public function insertNounou($nom, $prenom, $naissance, $mail, $tel, $adress, $experience)
	{
		$sql = ('INSERT INTO nounous(nom, prenom, naissance, mail, tel, adress, experience, profil_valide) VALUES(?, ?, ?, ?, ?, ?, ?, 0)');
		$req = $this->getBdd()->prepare($sql);
		$nounous = $req->execute(array($nom, $prenom, $naissance, $mail, $tel, $adress, $experience));
		//var_dump($prenom);
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

}
