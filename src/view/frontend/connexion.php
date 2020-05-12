<div class="connexion">

    <h2>Connectez vous</h2>
 

    <form method="post" action="getUser" class="formConnexion">
        <?= $this->session->show('vide'); ?>
        <?= $this->session->show('userExist'); ?>
        
        <div>
            <input type="text" class="champ" name="pseudo" placeholder="Votre pseudo"/>
        </div>
        <div>
            <input type="password" class="champ" name="password" placeholder="Mot de passe"/>
        </div>
        <div>
            <input type="submit" class="btn" value="Connexion" name="submit"/>
        </div>

    </form>
</div>
