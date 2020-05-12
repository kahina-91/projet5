<div id="formvali">
    <h2>Edition de mon profil</h2>
    <form method="post" action="" class="formValidNounou"  enctype="multipart/form-data">
        <div class="validation">
            
            <?= $this->session->show('insertNounouValid'); ?>
        
            <div>
                <input type="email" class="champ" name="newmail" placeholder="Mail"/>
            </div>
            <div>
                <input type="text" class="champ" name="newpseudo" placeholder="Pseudo"/>
            </div>
            <div>
                <input type="password" class="champ" name="newpassword1" placeholder="Mot de passe"/>
            </div>
            <div>
                <input type="password" class="champ" name="newpassword2" placeholder="Confirmation du mot de passe"/>
            </div>     
            <div>
                <input type="file" name="avatar" class="ligne" value="Télécharger votre photo"/>
            </div>
            <div>
                <input type="submit" name="submit" value="Ajouter"/>
            </div>
        </div>
    </form>
</div>