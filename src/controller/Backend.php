<?php

namespace kah\controller;

use kah\core\Controller;
use kah\model\AgenceManager;
use kah\model\UserManager;
use Exception;

class Backend extends Controller
{

    public function getNounous()
    {
        if(empty($this->request->getSession()->get('pseudo'))) throw new Exception("erreur 403");
            $nounouManager = new AgenceManager();
            $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
            $limite = 1;
            
            $debut = ($page-1) * $limite;
            $nounous = $nounouManager->getNounous($limite, $debut);
            $nbr = $nounous['nbrTotal'];
            $liste = $nounous['nounou'];
            $nounou = $liste->fetch();
            $nbrPages = ceil($nbr / $limite);
            
            return $this->render('backend/admin', ['nounou' => $nounou, 'nbrPages' => $nbrPages, 'page' => $page]);

    }

    public function insertNounouValid() 
    {
        
        $submit = $this->request->get('submit');
        if($submit)
        {
            $pseudo = $this->request->get('pseudo');
            $password1 = $this->request->get('password1');
            $password2 = $this->request->get('password2');
            $mail = $this->request->get('mail');
            $role = 'ROLE_NOUNOU';
            $manager = new UserManager();
            $Amanager = new AgenceManager();
            $lat = $this->request->get('lat');
            $lon = $this->request->get('lon');
            
            $manager->insertNounouValid($pseudo, $password1, $password2, $mail, $role);
            $Amanager->insertLatLonNounou($lat, $lon, $_GET['id']);
            $getId = $manager->getId($pseudo);
            $id = $manager->test($getId['id'], $pseudo);
            $nounouValid = $Amanager->nounouValidat($_GET['id']);
            $this->request->getSession()->set('insertNounouValid', 'Nounou ajouté avec succé!!');
            header('Location: admin');
            
        }else
        {
            throw new Exception('echec');
        }
    }

    public function deleteNounou() 
    {
        if(empty($this->request->getSession()->get('pseudo'))) throw new Exception("erreur 403");
        $manager = new AgenceManager();
        $manager->delete('nounous', $_GET['id']);
        header('Location: admin');
       
    }

    public function pageValidatNounou() 
    {
        if(empty($this->request->getSession()->get('pseudo'))) throw new Exception("erreur 403");
        $nounouManager = new AgenceManager();
        //$nounouValid = $nounouManager->nounouValidat($_GET['id']);
        //var_dump($nounouId);die;
        $nounous =  $nounouManager->getNounouValid($_GET['id']);
        //var_dump($nounous);die;
        $nounou = $nounous->fetch();
  
        return $this->render('backend/pageValidation', ['nounou' => $nounou]); 

    }
   
}