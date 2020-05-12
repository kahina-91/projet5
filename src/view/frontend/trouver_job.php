
    <div class="postuler">
        <h2 class="text-left titre_comment text-secondary">Vous êtes nounou, vous voulez le devenir avec nous, remplissez le formulaire.</h2>
        <?= $this->session->show('insertNounou'); ?>
        <?= $this->session->show('mailExist'); ?>
        <?= $this->session->show('champs'); ?> 
        <form class="formPostul" action="postuler" method="post">
                
                <div>
                        <input type="text" id="nom" class="ligne" name="nom" placeholder="nom" />
                </div>      
                <br /><br>
                <div>
                        <input type="text" id="prenom" class="ligne" name="prenom" placeholder="prénom" />  
               
                </div><br/><br>
                <div>
                    <input type="date" name="naissance" class="ligne" placeholder="date de naissance"/>
                        
                </div><br/>
                <div>
                        <input type="email" id="mail" name="mail" class="ligne" placeholder="E-mail"/>
                </div><br/>
                <div>
                        <input type="text" id="pseudo" name="pseudo" class="ligne" placeholder="pseudo"/>
                </div><br/>
                 <div>
                        <input type="tel" id="tel" class="ligne" name="tel" placeholder="Numéro de téléphone"/>
                </div><br/>
                <div>
                        <input type="text" id="adress" class="ligne" name="adress" placeholder="Adress"/>
                </div><br/>
                <div>
                    <textarea type="text" col="15" name="experience" class="ligne" placeholder="Décrivez votre status et votre expérience"></textarea>
                </div><br/>
                 <div>     
                    <input type="submit" name="envoi" value="Envoyer votre demande" class="btn text-secondary active"/>
                
                 </div>
        </form>
    
    </div>
