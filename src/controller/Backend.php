<?php

namespace kah\src\controller;
use kah\app\core\Controller;

class Backend extends Controller
{

	   public function getNounous()
        {
			$session = $this->session;
            if (isset($_GET['id']) && $_GET['id'] > 0) {

                $agenceManager = new AgenceManager();
                $nounous = $agenceManager->getNounous()->fetchAll();
                //echo '<pre>'; print_r($nounous); echo '</pre>'; exit;
                $nbr = count($nounous);
            	echo $nbr;
                if (isset($_GET['direction']))
                {
                    $direction = $_GET['direction'];
                }else
                {
                    $direction = null; 
                } 

                $nounou = $agenceManager->getNounou($_GET['id'], $direction);
                
                 return $this->render('backend/admin', ['nounous' => $nounous, 'nounou' => $nounou, 'nbr' => $nbr]);
            }else
            {
                
                throw new Exception('aucun identifiant de nounou envoyé');
               
           }
           
        }

        public function connect() 
        {



        }
        public function deleteNounou() {
            if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
            $manager = new AgenceManager();
            $manager->delete('nounous', $_GET['id']);
            header('Location: admin');

        }

        public function insertNounouAdmi() {

            $manager = new AgenceManager();
            $manager->insertNounouAdmi();
            header('Location: admin');

        }

}
