<script src= "<?= JS; ?>InsertNounou.js"></script>
<div class="admin">

    <div class="nounous">
        <div class="nounou"> 
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <?php while ($nounous = $liste->fetch()) { ?>
                <div class="">Nom et prénom:
                    <?= htmlspecialchars($nounous['nom']); ?>
                    <?= htmlspecialchars($nounous['prenom']); ?>
                </div>

                <div class="">Date de naissance:
                    <?= htmlspecialchars($nounous['naissance']); ?>
                </div>
                <div class="">L'adress mail:
                    <?= htmlspecialchars($nounous['mail']); ?>
                </div>
                <div class="">Numéro de téléphone:
                    <?= htmlspecialchars($nounous['tel']); ?>
                </div>
                <div class="">Adress:
                    <?= htmlspecialchars($nounous['adress']); ?>
                </div>

                <div class="">Expérience:

                    <?= htmlspecialchars($nounous['experience']); ?>

                </div>
                <a href="deleteNounou&id=<?= $nounous['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true">supprimer</i></a>
                <a href="pageValidatNounou&id=<?= $nounous['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true">Valider</i></a>
            
            <?php } ?>
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