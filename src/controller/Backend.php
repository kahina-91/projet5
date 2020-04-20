<?php

/*namespace kah\src\controller;
use kah\app\core\Controller;*/

class Backend extends Controller
{

	   public function getNounous()
        {


            $perPage = 1;
            $agenceManager = new AgenceManager();
            $nbrpage = $agenceManager->getNounousValide();
            if (empty($_GET['p'])):
                $current = 1;
            endif;  
            if (isset($_GET['p']) && !empty($_GET['p']) && ctype_digit($_GET['p']) == 1)
            {
                if($_GET['p'] > $nbrpage):
                    $current = $nbrpage;
                else :
                    $current = $_GET['p'];
               
                endif;
           //var_dump($current);die;
                $firstOfPage = ($current-1) * $perPage;
                $nounou = $agenceManager->getNounou($_GET['p']);
                $nounous = $agenceManager->getNounous()->fetch();
                return $this->render('backend/admin', ['nounous' => $nounous, 'nounou' => $nounou,'nbrpage' => $nbrpage, 'current' => $current,]);
            }else
            {
                throw new Exception('aucun identifiant de nounou envoyé');
                
            }
        }

        public function connect() 
        {



        }
        public function deleteNounou() {
            //if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
            $manager = new AgenceManager();
            $manager->delete('nounous', $_GET['id']);
            header('Location: admin');

        }

        public function nounouValidat() 
        {

            $manager = new AgenceManager();
            
            //var_dump($_GET['id']);die;
            $manager->nounouValidat($_GET['id']);
            header('Location: admin');

        }

}
