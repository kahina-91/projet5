<?php 

    namespace kah\controller;

    use kah\core\Controller;
    use kah\model\AgenceManager;
    use kah\model\UserManager;
    use kah\model\CommentManager;
    use Exception;
    
	class Frontend extends Controller
	{

		public function home()
		{ 
           
            $commentManager = new CommentManager();
            $page = (!empty($_GET['page']) ? $_GET['page'] : 1);
            $limite = 2;
            
            $debut = ($page-1) * $limite;
            $comments = $commentManager->getComments($limite, $debut);
            $nbr = $comments['nbrTotal'];
            $liste = $comments['comments']->fetch();
            $date_us = $liste['date_creation'];
            $date_fr = strftime('%d-%m-%Y',strtotime($date_us));
            $nbrPages = ceil($nbr / $limite);
			return $this->render('frontend/home', ['liste' => $liste,'date_fr' => $date_fr, 'nbrPages' => $nbrPages, 'page' => $page]);
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

                while($row = $getNounousValids->fetch(\PDO::FETCH_ASSOC)){
                    extract($row);

                    $nounous = [
                        "id" => $id,
                        "lat" => $lat,
                        "lon" => $lon,
                        "nom" => $nom,
                        "prenom" => $prenom,
                        "mail" => $mail,
                        "tel" => $tel,
                        "adress" => $adress,

                    ];

                    $tableauNounousValids['nounousValids'][] = $nounous;
                }

                http_response_code(0);
                echo json_encode($tableauNounousValids);

            }else
            {
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
            
            $envoi = $this->request->get('envoi');                              
             
            if($envoi)
            {
                $nom = $this->request->get('nom');
                $prenom = $this->request->get('prenom');
                $naissance = $this->request->get('naissance');
                $mail = $this->request->get('mail');
                $pseudo = $this->request->get('pseudo');
                $tel = $this->request->get('tel');
                $adress = $this->request->get('adress');
                $experience = $this->request->get('experience');
                $agenceManager = new AgenceManager(); 
                $exist = $agenceManager->nounouUnique($mail);
                if($exist == 0 AND !empty($nom) AND !empty($prenom) AND !empty($naissance) AND 
                 !empty($mail) AND !empty($pseudo) AND !empty($tel) AND !empty($adress) AND !empty($experience))
                {        
 
                    $nounous = $agenceManager->insertNounou($nom, $prenom, $naissance, $mail, $pseudo, $tel, $adress, $experience);
                    $this->request->getSession()->set('insertNounou', 'Demande envoyé!!');
 
                }else
                {
 
                    if($exist == 1)
                        $this->request->getSession()->set('mailExist', 'Mail exist déja veuillez saisir un autre mail!!');
 
                    if(empty($nom) AND empty($prenom) AND empty($naissance) AND 
                    empty($mail) AND empty($tel) AND empty($adress) AND empty($experience))
                        $this->request->getSession()->set('champs', 'Veuillez remplir les champs!!');
 
                }
            } 
            header('Location: trouver_job');
        }

        public function inscription()
        {

            return $this->render('frontend/inscription');  

        }

        public function editProfil()
        {

            return $this->render('frontend/editProfil');  

        }

        public function insertUser()
        {

            $submit = $this->request->get('submit');

            if($submit)
            {

                $pseudo = $this->request->get('pseudo');
                $password1 = $this->request->get('password1');
                $password2 = $this->request->get('password2');
                $mail = $this->request->get('mail');
                $role = 'ROLE_CLIENT';
                $userManager = new UserManager();
                $agenceManager = new AgenceManager();
                $exist = $userManager->userUnique($pseudo);

                if($exist == 0 AND !empty($pseudo) AND !empty($password1) AND !empty($password2) AND !empty($mail) AND ($password1 == $password2))
                {        

                    $userManager->insertUser($pseudo, $password1, $password2, $mail, $role);
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

            if(empty($this->request->getSession()->get('pseudo'))){throw new Exception("erreur 403");}
            return $this->render('frontend/pageUser'); 
        
        }

        public function pageNounou()
        {

            if(empty($this->request->getSession()->get('pseudo'))){throw new Exception("erreur 403");}
            return $this->render('frontend/pageNounou'); 

        }
        
        public function getUser()
        {
            $submit = $this->request->get('submit');
            if($submit) 
            {
                
                $password = $this->request->get('password');
                $pseudo = $this->request->get('pseudo');
                $userManager = new UserManager();
                $user = $userManager->getUser($pseudo, $password);

                if(!empty($pseudo) AND !empty($password))
                {

                    if($user AND $user['isvalid'])
                    {

                        
                        $this->request->getSession()->set('login', 'Content de vous revoir');
                        $this->request->getSession()->set('pseudo', $this->request->get('pseudo'));
                        $this->request->getSession()->set('role', $user['result']['role']);
                        
                        if($this->request->getSession()->get('role') == "ROLE_ADMIN") {
                            $this->request->getSession()->set('admin', 1);
                            $location = "admin";
                        } elseif($this->request->getSession()->get('role') == "ROLE_NOUNOU"){
                            $this->request->getSession()->set('admin', 0);
                            $location = "pageNounou";
                        }else{
                            $this->request->getSession()->set('admin', 0);
                            $location = "pageUser";
                        }


                        header('Location: '.$location); 
                        
                    }else
                    {

                        $this->request->getSession()->set('userExist', 'L\'address mail ou le mot de passe n\'existe pas!!');
                        header('Location: login');

                    }
                    if($admin['admin'] AND $admin['adminIsvalid'])
                    {
                        
                       $_SESSION['admin']= $this->request->get('pseudo');
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
            header('location: login');

        }

    }