<div class="head">
    <div class="navbar navbar-inverse justify-content-center navbar-fixed-top">
        <div class="logo" >
            <img src="<?= IMG; ?>logo.png"/>
            
        </div>
            <ul class="nav container-fluid justify-content-center">
                <li id = "acceuil" class="row col-sm-2">
                  <a href="home" class="text-light active">
                    Accueil
                  </a> 
                </li>
                <li id ="" class="row col-sm-2">
                    <a href="inscription" class="text-light">Inscription</a>
                </li>
                <li id = "" class="row col-sm-2"><a href="login" class="text-light">Connexion</a></li>
                <li class="dropdown">
                    <a class="nav-link text-light dropdown-toggle" data-toggle="dropdown" href="services" role="button" aria-haspopup="true" aria-expanded="false">Services</a> <!-- lien -->
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Service 1</a>
                        <a class="dropdown-item" href="#">Autre service</a>
                        <a class="dropdown-item" href="#">Dernier Service</a>
                    </div>
                </li> 
            </ul> 
    </div>