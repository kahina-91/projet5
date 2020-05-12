<div id="formvali">
    <form method="post" action="insertNounouValid&id=<?= $nounou['id']; ?>" class="formValidNounou">
        <div class="validation">
            <p>Créer le compte de la nounou</p>
        
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
                <input type="number" step="any" class="champ" name="lat" placeholder="Latitude"/>
            </div>
            <div>
                <input type="number" step="any" class="champ" name="lon" placeholder="Longitude"/>
            </div>
            <div>
                <input type="submit" name="submit" value="Ajouter" class="ajouter"/>
            </div>
        </div>
    </form>
</div>
