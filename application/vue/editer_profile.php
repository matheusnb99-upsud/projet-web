<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <?php 
        session_start();
        if(isset($_SESSION['email']) && ($_SESSION['email'] == null)){
            header('Location:../vue/connexion.php');
            $listeGroupes = getMyGroupes();
            include './header/headertest.php';

        }

    ?>
    <section id='parametrages_compte'>
        <div id='Preferences'>
            <p>Changer addresse mail</p>
            <button> Changer</button>
            <p>Changer mot de passe</p>
            <button> Changer</button>
        </div>
    </section>
    <section id='mesGroupes'></section>
</body>
</html>