              
    <div class="valid">
       <?php //var_dump($nounou['prenom']);die; ?>
    Créer le profil de: <?= $nounou['prenom'] ?>
        <form method="post" action="insertNounouValid&id=<?= $nounou['id'] ?>" class="formValidNounou">
            <div class="validation">
                <p>Créer le compte de la nounou</p>
                <?= $this->session->show('insertNounouValid'); ?>
            
                <div>
                    <input type="email" class="champ" name="mail" placeholder="Mail"/>
                </div>
                <div>
                    <input type="text" class="champ" name="pseudo" placeholder="Pseudo"/>
                </div>
                <div>
                    <input type="password" class="champ" name="password1" placeholder="Mot de passe"/>
                </div>
                <div>
                    <input type="password" class="champ" name="password2" placeholder="Confirmation du mot de passe"/>
                </div>
                
                <div>
                    <input type="submit" name="submit" value="Ajouter"/>
                </div>
            </div>
                
        </form>
        Remlisez le formulaire si la nounou est disponible:
        <form method="post" action="insertLatLonNounou&id=<?= $nounou['id'] ?>">
                <div>
                    <input type="number" step="any" class="champ" name="lat" placeholder="Latitude"/>
                </div>
                <div>
                    <input type="number" step="any" class="champ" name="lon" placeholder="Longitude"/>
                </div>
                <div>
                    <input type="submit" name="confirm" value="confirm"/>
                </div>
        </form>
    </div>
</div>
<a href="nounouValidat&id=<?= $nounou['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true">valider le profil</i></a>