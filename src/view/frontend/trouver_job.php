
    <div class="postuler">
        <h2 class="text-left titre_comment text-secondary">Remplissez le formulaire</h2>
        <div class="text-succes"><?=$this->session->show('insertNounou'); ?></div> 
        <form class="formPostul" action="postuler" method="post" enctype="multipart/form-data"> 
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
                        <input type="tel" id="tel" class="ligne" name="tel" placeholder="Numéro de téléphone"/>
                </div><br/>
                <div>
                        <input type="text" id="adress" class="ligne" name="adress" placeholder="Adress"/>
                </div><br/>
                <div>
                    <textarea type="text" col="15" name="experience" class="ligne" placeholder="Décrivez votre status et votre expérience"></textarea>
                </div><br/>
                <div>
                    <input type="file" name="monfichier" class="ligne" placeholder="Télécharger votre CV"/>
                </div><br/>
                 <div>     
                    <input type="submit" value="Envoyer votre demande" class="btn text-secondary active"/>
                
                 </div>
        </form>
    
    </div>
