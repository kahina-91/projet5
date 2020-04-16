
 <div class="agences">

<?php 
    if($agence->rowCount() > 0) 
    {
        while ($agen = $agence->fetch())
        {
        ?>
            <div class="oneagence"> 
                <div class="text-light">
                    <?= htmlspecialchars($agen['id']); ?>

                </div>
                <div class="text-light">
                    <?= htmlspecialchars($agen['ville']); ?>
                </div>
                <div class="text-light">
                    <?= htmlspecialchars($agen['lat']); ?>
                </div>
            </div>
        <?php    
        }
    }else{ ?>

        Aucun résultat pour: <?= $recherch ?> ...
    <?php
    }
    ?>
    
    </div>