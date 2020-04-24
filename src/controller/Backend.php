<?php

/*namespace kah\src\controller;
use kah\app\core\Controller;*/

class Backend extends Controller
{

    public function getNounous()
    {
       
        $nounouManager = new AgenceManager();
        //var_dump($liste->fetchAll());die;
        $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
        $limite = 1;
        
        $debut = ($page-1) * $limite;
        $nounous = $nounouManager->getNounous($limite, $debut);
        $nbr = $nounous['nbrTotal'];
        $liste = $nounous['nounou'];
        $nbrPages = ceil($nbr / $limite);
        //var_dump($liste->fetchAll());die;
        return $this->render('backend/admin', ['liste' => $liste, 'nbrPages' => $nbrPages, 'page' => $page]);
      
    }

    public function insertLatLonNounou()
    {

        $manager = new AgenceManager();
        $confirm = $this->request->get('confirm');
        $lat = $this->request->get('lat');
        $lon = $this->request->get('lon');
        if($confirm)
        {
            
            $manager->insertLatLonNounou($lat, $lon, $_GET['id']);
            header('Location: admin');
            
        }else
        {
            throw new Exception('echec');
        }

    }

        public function insertNounouValid() 
        {

            $submit = $this->request->get('submit');
            $pseudo = $this->request->get('pseudo');
            $password1 = $this->request->get('password1');
            $password2 = $this->request->get('password2');
            $mail = $this->request->get('mail');
            $role = 'ROLE_NOUNOU';
            $manager = new UserManager();
            //var_dump($mail);die;
            if($submit)
            {
                
                $manager->insertNounouValid($pseudo, $password1, $password2, $mail, $role);
                
                //var_dump($req);die;
                $this->request->getSession()->set('insertNounouValid', 'Nounou ajouté avec succé!!');
                header('Location: pageValidatNounou?id');
                
            }else
            {
                throw new Exception('echec');
            }
        }
        public function deleteNounou() {
            if(!isset($_SESSION['admin'])) throw new Exception("erreur 403");
            $manager = new AgenceManager();
            $manager->delete('nounous', $_GET['id']);
            header('Location: admin');

        }

        public function nounouValidat() 
        {

            $manager = new AgenceManager();
            
            //var_dump($_GET['id']);die;
            //$manager->nounouValidat($_GET['id']);
            header('Location: pageValidatNounou');

        }

        public function pageValidatNounou() 
        {

            $nounouManager = new AgenceManager();
            $nounouValid = $nounouManager->nounouValidat($_GET['id']);
            $nounous =  $nounouManager->getNounouValid($_GET['id']);
            $nounou = $nounous->fetch();
            $userManager = new UserManager();
            $test = $userManager->test();
            return $this->render('backend/pageValidatNounou', ['nounou' => $nounou]);

        }

}