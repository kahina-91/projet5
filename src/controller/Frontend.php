<?php 

/*namespace kah\src\controller;

use kah\app\core\Session;
use kah\app\core\Request;
use kah\app\core\Controller;*/

	class Frontend extends Controller
	{

		public function home()
		{ 
           
            $commentManager = new CommentManager();
            $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
            $limite = 1;
            
            $debut = ($page-1) * $limite;
            $comments = $commentManager->getComments($limite, $debut);
            $nbr = $comments['nbrTotal'];
            $liste = $comments['comments'];
            $nbrPages = ceil($nbr / $limite);
            //var_dump($nbrPages);die;
			return $this->render('frontend/home', ['liste' => $liste, 'nbrPages' => $nbrPages, 'page' => $page]);
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
            $getNounousValids = $agenceManager->getNounousValids();

            if($getNounousValids->rowCount() > 0){

                $tableauNounousValids = [];
                $tableauNounousValids['nounousValids'] = [];

                while($row = $getNounousValids->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                    $nounous = [
                        "id" => $id,
                        "lat" => $lat,
                        "lon" => $lon,
                        //"ville" => $ville,
                    ];

                    $tableauNounousValids['nounousValids'][] = $nounous;
                }

                // On envoie le code réponse 200 OK
                http_response_code(0);
                // On encode en json et on envoie
                echo json_encode($tableauNounousValids);

            }else{
                // On gère l'erreur
                http_response_code(405);
                echo json_encode(["message" => "La méthode n'est pas autorisée"]);
            }
        }

        public function trouver_nounou()
        {
            $agenceManager = new AgenceManager();
            $nounous = $agenceManager->getNounousValids();
            return $this->render('frontend/trouver_nounou', ['nounous' => $nounous]);
        }

        public function getAgence()
        {
            
            $agenceManager = new AgenceManager();
            $agence = $agenceManager->getAgence($_POST['recherch']);
            echo '<pre>'; print_r($agence); echo '</pre>';
            return $this->render('frontend/rechercheNounou', ["agence" =>$agence]);
    
        }

        public function login()
        {

            return $this->render('frontend/connexion'); 

        }
        public function trouver_job()
        {
            $agenceManager = new AgenceManager();
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
           //var_dump($experience);die;
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
            $role = 'ROLE_CLIENT';
            $userManager = new UserManager();
            $agenceManager = new AgenceManager();
            $exist = $userManager->userUnique($pseudo);

            if($submit)
            {
                if($exist == 0 AND !empty($pseudo) AND !empty($password1) AND !empty($password2) AND !empty($mail) AND ($password1 == $password2))
                {        

                    $userManager->insertUser($pseudo, $password1, $password2, $mail, $role);
                    //var_dump($pseudo);die;
                    $this->request->getSession()->set('insertUser', 'Votre compte a bien été crée!!');

                }else
                {

                    if($exist == 1)
                        $this->request->getSession()->set('erreurExist', 'Pseudo exist déja veuillez saisir un autre pseudo!!');

                    if($password1 !== $password2)
                        $this->request->getSession()->set('erreurPassword', 'Vos mot de passe ne correspondent pas!!');

                    if(empty($pseudo) AND empty($password1) AND empty($password2) AND empty($mail))
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
            $admin = $userManager->getAdmin($password);
            //var_dump($admin);die;
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
                        header('Location: login');

                    }
                    if($admin AND $admin['adminIsvalid'])
                    {
                        
                        //return $this->render('backend/admin', ['nounous' => $nounous]);
                        header('Location: admin');
                        
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
