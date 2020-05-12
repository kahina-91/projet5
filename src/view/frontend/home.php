
    <script src= "<?= JS; ?>Slider.js"></script> 

    <div class="slider">
        <h1>Bienvenu sur le site de super berceaux</h1>
        <div class="slide">
            <img src="assets/images/1.jpg"/>

        </div>
        <div class="slide">
            <img src="assets/images/15104.jpg"/>

        </div>
        <div class="slide">
            <img src="assets/images/27796.jpg"/>
        </div>
        <div class="slide">
            <img src= "assets/images/409.jpg"/>
        </div>
        <div class="slide">
            <img src="assets/images/852.jpg"/>
        </div>
    </div>
    <div class="commentsDiv"> 
        <div class="comments">
            <div class="comment">
                <p>
                    <?= htmlspecialchars($liste['author']); ?>
                    <?= $date_fr ?>
                </p>
                <p><?= htmlspecialchars($liste['comment']); ?></p>
            </div>
        </div>
        <div>
        <?php if ($page > 1):
            ?><a href="?page=<?php echo $page - 1; ?>">&laquo;</a><?php
        endif;

        for ($i = 1; $i <= $nbrPages; $i++):
            ?><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a> <?php
        endfor;

        if ($page < $nbrPages):
            ?><a href="?page=<?php echo $page + 1; ?>">&raquo;</a><?php
        endif;
        ?></div>
    </div>
    <div class="principal">
        <h2 class="text-center text-light">Nos services</h2>
        <div class="services">
            <div class="service">
                <a href="trouver_job">
                    <h3><i class="fa fa-briefcase" aria-hidden="true"></i>Trouver un travail</h3>
                    <p>Postuler pour devenir nounou et garder des enfants.</p> 
                </a>
                
            </div>
            <div class="service">
                <a href="trouver_nounou">
                    <h3><i class="fa fa-handshake-o" aria-hidden="true"></i>Trouver une nounou</h3>
                    <p>Trouver la nounou que vous cherchez prés de chez vous.</p>
                </a>
            </div>
            <div class="service">
                <a href="home">
                    <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i>Faire une formation</h3>
                    <p>Devenir nounou et faire une formation pour obtenir votre diplome.</p>
                </a>
            </div>            
        </div>
    </div>
    <div class="principal">
        <h2 class="text-center text-light">Avantages</h2>
        <div class="avantages">
            <div class="avantage col-4">
                <h3>Confiance</h3>
                <p>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.</p> 
            </div>
            <div class="avantage col-4">
                <h3>Sérinité</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.</p>
            </div>
            <div class="avantage col-4">
                <h3>Flexibilité</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.</p>
            </div>
        </div>
    </div>
    