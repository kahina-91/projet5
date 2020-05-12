<div class="usermenu">
    <h2>Profil de:<?= $this->session->show('login');?></h2>
    <h3><?= $this->session->show('pseudo'); ?></h3>    
             
    <div><a href="editProfil">Editer mon profil</a></div>
    <div><a href="home">Retour à l'accueil</a></div>
    <div><a href="logout">Déconnecter</a></div>
</div>
