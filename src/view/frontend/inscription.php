<div class="inscription">

    <h2>Inscrivez vous</h2>

    <form method="post" action="insertUser" class="formuInscription">
        <?= $this->session->show('insertUser'); ?>
        <?= $this->session->show('erreurInscription'); ?>
        <?= $this->session->show('erreurPseudo'); ?>
        <?= $this->session->show('erreurPassword'); ?>
        <?= $this->session->show('erreurExist'); ?>
        <?= $this->session->show('vide'); ?>

        <div>
            <input type="email" class="champ" name="mail" placeholder="Votre mail"/>
        </div>
        <div>
            <input type="text" class="champ" name="pseudo" placeholder="Votre pseudo"/>
        </div>
        <div>
            <input type="password" class="champ" name="password1" placeholder="Mot de passe"/>
        </div>
        <div>
            <input type="password" class="champ" name="password2" placeholder="Confirmation du mot de passe"/>
        </div>
        <div>
             <input type="submit" class="btn" value="inscription" name="submit"/>
        </div>

    </form>

    <a href="home">Retour à l'accueil</a>

</div>