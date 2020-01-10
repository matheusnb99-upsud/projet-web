
<!DOCTYPE html>
<html lang="en">
    <head>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
        <!-- CSS -->
        <link href="../../style/style.css" rel="stylesheet">

		<!-- get jQuery from the google apis -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.js"></script>

		<!-- CSS STYLE-->
		<link rel="stylesheet" type="text/css" href="../../rs-plugin/css/style.css" media="screen" />

		<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
		<script type="text/javascript" src="../../rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
		<script type="text/javascript" src="../../rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

		<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
		<link rel="stylesheet" type="text/css" href="../../rs-plugin/css/settings.css" media="screen" />
		



    </head>
    <body>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <div class="container-fluid">
            <div class="headernav">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-1 col-xs-3 col-sm-2 col-md-2 logo "><a href="accueil.php"><img src="http://forum.azyrusthemes.com/images/logo.jpg" alt=""  /></a></div>
                        <div class="col-lg-3 col-xs-9 col-sm-5 col-md-3 selecttopic">
                            <div class="dropdown">
                                <a data-toggle="dropdown" href="#" >Groupes</a> <b class="caret"></b>
                                <ul class="dropdown-menu" role="menu">
                                    <?php 
                                    $i = -1;
                                    foreach( $listeGroupes as $g) {
                                        echo "<li role='presentation'><a role='menuitem' tabindex='-1' href='./groupe.php?idGroupe=".$g->getId()."'>".$g->getTitre()."</a></li>";
                                        $i -= 1;}            
                                    ?>
                                    <li role='presentation'><a role='menuitem' tabindex='-1' href='./formulaire_creation_groupe.php'> Creer Groupe </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 search hidden-xs hidden-sm col-md-3">
                            <div class="wrap">
                                <form action="#" method="post" class="form">
                                    <div class="pull-left txt"><input type="text" class="form-control" placeholder="Search Topics"></div>
                                    <div class="pull-right"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12 col-sm-5 col-md-4 avt">
                            <div class="stnt pull-left">                            
                                <form action="./formulaire_creation_proposition.php" method="post" class="form">
                                    <button class="btn btn-primary">Creer proposition</button>
                                </form>
                            </div>
                            <div class="avatar pull-left dropdown">
                                <a data-toggle="dropdown" href="#"><i style='padding-left:25px;' class="fa fa-user fa-2x"></i></a> <b class="caret"></b>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="./profile.php">Mon profil</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-2" href="./editer_profile.php">Parametres</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-3" href="../controler/deconnexion.php">Log Out</a></li>                                    
                                </ul>
                            </div>
                            
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

    </body>
</html>
