<div class="admin">
    <div class="nounous">
        <div class="nounou"> 
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <div class="">
                <?= htmlspecialchars($nounou['nom']); ?>

            </div>
            <div class="">
                <?= htmlspecialchars($nounou['prenom']); ?>
            </div>
            <i class="fa fa-check-circle" aria-hidden="true"></i>
            <a href="deleteNounou&id=<?= $nounou['id'] ?>"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
        </div>

        <div class="paginNum">
            <?php if($_GET['id'] > 1): ?>
                <a href="admin&id=<?= $nounou['id'] - 1; ?>&direction=prev">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
            <?php foreach($nounous as $key => $p): ?>
                <a href="admin&id=<?= $p['id']; ?>"><?= $key+1; ?>   
            </a>
            <?php endforeach ?>
            <?php if($_GET['id'] < $nbr): ?>
                <a href="admin&id=<?= $nounou['id'] + 1; ?>&direction=next">
                    <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a> 
            <?php endif; ?>
        </div>
    </div>
</div>