<?php
	namespace kah\src\model;

	use kah\app\core\Session;
	use kah\app\core\Request;
	use kah\app\core\Controller;
	use PDO;
	use kah\src\model;

class AgenceManager extends BddManager
{
	public function getAgences()
	{
		$sql = 'SELECT * FROM agences';
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

	public function getNounou($nounouId, $direction = null)
	{

		$sql = ('SELECT * FROM nounous WHERE id = ?
       ;');
		
		$req = $this->getBdd()->prepare($sql);
        $req->execute(array($nounouId));
        $nounous = $req->fetch();
 		return $nounous;
	}

	public function getNounous()
	{

		$sql = ('SELECT * FROM nounous;');
		$req = $this->getBdd()->prepare($sql);
		$req->execute();
 		return $req;

	}

	public function getHours()
	{
		$sql = ('SELECT * FROM heures
       ;');

		$hours = $this->getBdd()->prepare($sql);
        $hours->execute();
        return $hours;

	}

	public function insertNounou($nom, $prenom, $naissance, $mail, $tel, $adress, $experience)
	{
		$sql = ('INSERT INTO nounous(nom, prenom, naissance, mail, tel, adress, experience) VALUES(?, ?, ?, ?, ?, ?, ?)');
		$req = $this->getBdd()->prepare($sql);
        $nounous = $req->execute(array($nom, $prenom, $naissance, $mail, $tel, $adress, $experience));
        return $nounous;
	}


        public function insertNounouAdmi() {

			$sql = ('INSERT INTO nounous(nom, prenom, date_naissance, mail, tel, adress, exp) VALUES(?, ?, ?, ?, ?, ?, ?)');

			$nounous = $this->getBdd()->prepare($sql);
	        $nounous->execute(array($nom, $prenom, $date_naissance, $mail, $tel, $adress, $exp));            
            
        }

}