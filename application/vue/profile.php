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
        if(isset($_SESSION['email']) && ($_SESSION['email'] == null))
            header('Location:../vue/connexion.php');
        
        include './header/logged.php';
    ?>
    <section id='mesPropositions'></section>
    <section id='mesGroupes'></section>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At ratione voluptatibus sunt in necessitatibus eius minima voluptate, tempore aperiam praesentium quam reiciendis natus consequuntur, nemo architecto ullam rem commodi. Quis!</p>
</body>
</html>