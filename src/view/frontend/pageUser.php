
<div class="usermenu">
    <h2><?= $this->session->show('login');?></h2>
    <h3><?= $this->session->show('pseudo'); ?></h3>    
             
    <div><a href="ubdatePassword">Modifier le mot de passe</a></div>
    <div><a href="home">Retour à l'accueil</a></div>
    <div><a href="logout">Déconnecter</a></div>
</div>