<script src= "<?= JS; ?>InsertNounou.js"></script> 
<div class="admin">
    <div class="valid">

        <div class="button"><a href="nounouValidat&id=<?= $nounou['id'] ?>"><i class="fa fa-check-circle" aria-hidden="true">valider</i></a></div>
        <form method="post" action="insertUser" class="formValidNounou">
            <div>
                <input type="number" class="champ" name="lat" placeholder="Latitude"/>
            </div>
            <div>
                <input type="number" class="champ" name="lon" placeholder="Longitude"/>
            </div>
            <input type="submit" value="valider"/>
        <a href="deleteNounou&id=<?= $nounou['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true">supprimer</i></a>

    </div>
        <div class="nounous">
            <div class="nounou"> 
                <i class="fa fa-user-circle" aria-hidden="true"></i>
            <div class="">Nom et prénom:
                <?= htmlspecialchars($nounou['nom']); ?>
                <?= htmlspecialchars($nounou['prenom']); ?>
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

        </div>

        <div class="paginNum">
            <ul class="list-unstyled">
                <li class="<?php if($current == '1') { echo 'disabled';} ?>">
                    <a href="admin&p=<?php if($current != '1'){ echo $current-1;}else { echo $current;} ?>">&laquo;
                    </a>
                </li>
                
                    <?php for($i = 1; $i<=$nbrpage; $i++):  ?>
                        <li class="num">
                            <?php if($i == $current): ?>
                            <a href="admin&p=<?= $i; ?>"><?= $i; ?></a> 
                            <?php else : ?>
                            <a href="admin&p=<?= $i; ?>"><?= $i; ?></a></div> 
                            <?php endif; ?> 
                        </li>
                    <?php endfor; ?>
               
                <li class="<?php if($current == $nbrpage) { echo 'disabled';}?>">
                    <a href="admin&p=<?php if($current != $nbrpage){ echo $current+1;}else { echo $current;} ?>">&raquo;
                </a>
                </li>
            </ul>
                
        </div>
        
    </div>
</div>




<!--
<?php if($_GET['id'] < $nbrpage): ?>
                <a href='admin&id=<?= $nounou['id'] + 1; ?>&direction=next'>
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a> 
            <?php endif; ?>

            <?php if($_GET['id'] > 1): ?>
                <a href="admin&id=<?= $nounou['id'] - 1; ?>&direction=prev">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                </a>
            <?php endif; ?>-->