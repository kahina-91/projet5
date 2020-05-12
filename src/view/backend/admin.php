<div class="admin">
    <button class="deconnect"><a href="logout">Déconnecter</a></button>
    <div class="nounous">
        <div class="nounou">
            <?= $this->session->show('admin'); ?>
            <?= $this->session->show('insertNounouValid'); ?>
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <div class="">Nom et prénom:
                <?= htmlspecialchars($nounou['nom']); ?>
                <?= htmlspecialchars($nounou['prenom']); ?>
            </div>
            <div class="">Pseudo:
                <?= htmlspecialchars($nounou['pseudo']); ?>
            </div>
            <div class="">Date de naissance:
                <?= htmlspecialchars($nounou['naissance']); ?>
            </div>
            <div class="">L'adress mail:
                <?= htmlspecialchars($nounou['mail']); ?>
            </div>
            <div class="">Numéro de téléphone:
                <?= htmlspecialchars($nounou['tel']); ?>
            </div>
            <div class="">Adress:
                <?= htmlspecialchars($nounou['adress']); ?>
            </div>

            <div class="">Expérience:

                <?= htmlspecialchars($nounou['experience']); ?>

            </div>

            <div class="">

                <?= htmlspecialchars($nounou['avatar']); ?>

            </div>
                <button><a href="deleteNounou&id=<?= $nounou['id']; ?>">supprimer</a></button>
                <button id="vali"> <a href="pageValidatNounou&id=<?= $nounou['id']; ?>">Valider</a></button>
        </div>
        
        
        <div class="paginNum">
            
            <?php if ($page != 1):
                ?><a href="?page=<?php echo $page - 1; ?>">&laquo;</a><?php
            endif;

            for ($i = 1; $i <= $nbrPages; $i++):
                ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
            endfor;

            if ($page < $nbrPages):
                ?><a href="?page=<?php echo $page + 1; ?>">&raquo;</a><?php
            endif;
            ?>
                
        </div>
        
    </div>
</div>
<script src= "<?= JS; ?>ValidatNounou.js"></script>
