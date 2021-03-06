
<nav class="navbar navbar-default navbar-perdu">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-home"></i> Accueil</a>
            <a class="navbar-brand" href="perdu.php"><i class="glyphicon glyphicon-zoom-out"></i> J'ai perdu</a>
            <a class="navbar-brand" href="trouve.php"><i class="glyphicon glyphicon-zoom-in"></i> J'ai trouvé</a>
            <a class="navbar-brand" href="depotAnnonce.php"><i class="glyphicon glyphicon-copy"></i> Je dépose une annonce</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">


                
                <!-- menu si connecté -->    
                <?php
                if(isset($_SESSION['auth'])):
                ?>
                <li> <a href="quitter.php" class="nav-btn-droit">
                     <i class="glyphicon glyphicon-log-out"></i>Déconnexion <?php echo $_SESSION['pseudo']; ?></a>
                </li>
                <?php else: ?>
                <!--menu non connecté-->                    
                <li><a href="inscription.php" class="nav-btn-droit">
                    <i class="glyphicon glyphicon-user"></i> Je m'inscris</a></li>
                <li ><a href="connexion.php" class="nav-btn-droit">
                    <i class="glyphicon glyphicon-log-in"></i> Je me connecte</a></li>
              <?php endif; ?>

            </ul>

           

            <form class="navbar-form navbar-left" method="post" action="recherche.php">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Je recherche..." name="query">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div> <!-- fin div input-group -->
            </form>
        </div> <!-- fin div navbar-collapse -->
    </div> <!-- fin div container-fluid -->
        
</nav>