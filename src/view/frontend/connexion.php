<div class="connexion">
    <p>Connectez vous</p>
 

    <form method="post" action="getUser" class="formuInscription">
        <?= $this->session->show('vide'); ?>
        <?= $this->session->show('userExist'); ?>
        
        <div>
            <input type="pseudo" class="champ" name="pseudo" placeholder="Votre pseudo"/>
        </div>
        <div>
            <input type="password" class="champ" name="password" placeholder="Mot de passe"/>
        </div>
        <div>
            <input type="submit" class="btn" value="inscription" name="submit"/>
        </div>

    </form>
</div>