<?php 

namespace kah\src\controller;

use kah\app\core\Session;
use kah\app\core\Request;
use kah\app\core\Controller;

	class Frontend extends Controller
	{

		public function home()
		{ 
           
			$commentManager = new CommentManager();
			$comments = $commentManager->getComments();
			return $this->render('frontend/home', ['comments' => $comments]);
		}
    	public function addComment()
        {
            $author = $this->request->get('author');
            $comment = $this->request->get('comment');
          
            $manager = new CommentManager();
            $affectedLines = $manager->addComment($author, $comment);

            if ($affectedLines === false) {
                echo 'Impossible d\'ajouter le commentaire !';
            }
            else {
                $this->session->setFlash('Commentaire publié!');
                header('Location: home');
            }

        }
        
        public function showMarkers()
        {
            $agenceManager = new AgenceManager();
            $getAgences = $agenceManager->getAgences();

            if($getAgences->rowCount() > 0){
            // On initialise un tableau associatif
                $tableauAgences = [];
                $tableauAgences['agences'] = [];

                // On parcourt les agences
                while($row = $getAgences->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                    $agen = [
                        "id" => $id,
                        "lat" => $lat,
                        "lon" => $lon,
                        "ville" => $ville,
                    ];

                    $tableauAgences['agences'][] = $agen;
                }

                // On envoie le code réponse 200 OK
                http_response_code(0);
                // On encode en json et on envoie
                echo json_encode($tableauAgences);

            }else{
                // On gère l'erreur
                http_response_code(405);
                echo json_encode(["message" => "La méthode n'est pas autorisée"]);
            }
        }

        public function trouver_nounou()
        {
            $agenceManager = new AgenceManager();
            $agences = $agenceManager->getAgences();
            return $this->render('frontend/trouver_nounou', ['agences' => $agences]);
        }

        public function getAgence()
        {
            
            $agenceManager = new AgenceManager();
            $agence = $agenceManager->getAgence($_POST['recherch']);
            echo '<pre>'; print_r($agence); echo '</pre>';
            return $this->render('frontend/rechercheNounou', ["agence" =>$agence]);
    
        }

        public function connexion()
        {

            return $this->render('frontend/connexion'); 

        }
        public function trouver_job()
        {
            $agenceManager = new AgenceManager();
            $hours = $agenceManager->getHours();
            return $this->render('frontend/trouver_job'); 
            
        }

        public function insertNounou()
        {   
            $nom = $this->request->get('nom');
            $prenom = $this->request->get('prenom');
            $naissance = $this->request->get('naissance');
            $mail = $this->request->get('mail');
            $tel = $this->request->get('tel');
            $adress = $this->request->get('adress');
            $experience = $this->request->get('experience');
            $agenceManager = new AgenceManager();
            $nounous = $agenceManager->insertNounou($nom, $prenom, $naissance, $mail, $tel, $adress, $experience);
           
            $this->request->getSession()->set('insertNounou', 'Demande envoyé!!');                
             header('Location: trouver_job');
        }

        public function inscription()
        {
               
            return $this->render('frontend/inscription');   

        }

        public function insertUser()
        {

            $submit = $this->request->get('submit');
            $pseudo = $this->request->get('pseudo');
            $password1 = $this->request->get('password1');
            $password2 = $this->request->get('password2');
            $mail = $this->request->get('mail');
            
            $userManager = new UserManager();
            $exist = $userManager->userUnique($pseudo);
            //var_dump($exist);exit;
            /*if(!$userManager->userUnique($pseudo))
            {
                $this->request->getSession()->set('erreurExist', 'Pseudo exist déja veuillez saisir un autre pseudo!!');
                header('location: inscription');
                exit;
            }*/
            if($submit)
            {

                if(!empty($pseudo) AND !empty($password1) AND !empty($password2) AND !empty($mail))
                {
                    if($exist == 0)
                    {
                        $pseudolength = strlen($pseudo);
                        if ($pseudolength <= 255) 
                        {
                            if($password1 == $password2)
                            {

                                $userManager = new UserManager();
                                $users = $userManager->insertUser($pseudo, $password1, $password2, $mail);
                                //var_dump($users);die;
                                $this->request->getSession()->set('insertUser', 'Votre compte a bien été crée!!');

                            }else
                            {

                                $this->request->getSession()->set('erreurPassword', 'Vos mot de passe ne correspondent pas!!');

                            }    

                        }
                        else
                        {

                            $this->request->getSession()->set('erreurPseudo', 'Votre pseudo ne doit pas dépasser 255 caractères!!');

                        }
                    } else
                    {
                        
                        $this->request->getSession()->set('erreurExist', 'Pseudo exist déja veuillez saisir un autre pseudo!!');

                    }
                }else
                {

                    $this->request->getSession()->set('vide', 'Veuillez remplir les champs!!');

                }

            }

            header('Location: inscription');

        }

        public function pageUser()
        {

             return $this->render('frontend/pageUser');    

        }
       
        public function getUser()
        {

            $submit = $this->request->get('submit');
            $password = $this->request->get('password');
            $pseudo = $this->request->get('pseudo');
            $userManager = new UserManager();
            $verif = $userManager->getUser($pseudo, $password);
            if($submit)
            {

                if(!empty($pseudo) AND !empty($password))
                {

                    if($verif AND $verif['isvalid'])
                    {

                        $this->request->getSession()->set('login', 'Content de vous revoir');
                        $this->request->getSession()->set('id', $result['result']['id']);
                        $this->request->getSession()->set('pseudo', $this->request->get('pseudo'));
                        header('Location: pageUser');  

                    }else
                    {

                        $this->request->getSession()->set('userExist', 'L\'address mail ou le mot de passe n\'existe pas!!');
                        header('Location: connexion');

                    }

                }
                else
                {

                    $this->request->getSession()->set('vide', 'Veuillez remplir les champs!!');

                }

            }

        }

        
        public function logout()
        {

            $this->request->getSession()->stop();
            header('location: connexion');

        }

    }