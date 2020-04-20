<?php
	/*namespace kah\src\model;

	use kah\app\core\Session;
	use kah\app\core\Request;
	use kah\app\core\Controller;
	use PDO;
	use kah\src\model;*/

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

	public function getNounou($nounouId)
	{

		$sql = 'SELECT * FROM nounous WHERE id = ?';
		
		$req = $this->getBdd()->prepare($sql);
        $req->execute(array($nounouId));
        $nounous = $req->fetch();
 		return $nounous;
	}

	public function getNounous()
	{

		$sql = 'SELECT id, nom, prenom, naissance, mail, tel, adress, experience FROM nounous WHERE profil_valide = "0" ORDER BY id';
		$req = $this->getBdd()->prepare($sql);
		$req->execute();
 		return $req;

	}

	public function getNounousValide()
	{
		$sql = ('SELECT COUNT(*) AS total FROM nounous WHERE profil_valide = "0"');

		$rqt = $this->getBdd()->prepare($sql);
		$rqt->execute();
		$nbr = $rqt->fetch();
		$total = $nbr['total'];
		//var_dump($total);die;
        return $total;

	}

	public function insertNounou($nom, $prenom, $naissance, $mail, $tel, $adress, $experience)
	{
		$sql = ('INSERT INTO nounous(nom, prenom, naissance, mail, tel, adress, experience, profil_valide) VALUES(?, ?, ?, ?, ?, ?, ?, 0)');
		$req = $this->getBdd()->prepare($sql);
        $nounous = $req->execute(array($nom, $prenom, $naissance, $mail, $tel, $adress, $experience));
        return $nounous;
	}


	public function nounouValidat($nounouId) 
	{

		$sql = ('UPDATE  nounous SET profil_valide = "1" WHERE id = ?');

		$nounous = $this->getBdd()->prepare($sql);
		$nounous->execute(array($nounouId));            
		return $nounous;

	}

}
