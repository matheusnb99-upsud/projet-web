<?php 
    session_start();
    if(isset($_SESSION['email'])){ // && ($_SESSION['email']) == null
        include './header/loggued.php';
    }
    else{
        include './header/unloggued.php';
    }
?>

<h2>

<?php 
    echo "hi ".$_SESSION['email'];
    echo "a ".$_SESSION['id'];
?>
</h2>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed inventore laboriosam nulla necessitatibus et corrupti eum sapiente dolorem omnis assumenda, laborum doloremque quisquam nostrum blanditiis earum totam suscipit quasi aut.</p>

<!--Section -->
<section>
    <!--Section:Side Buttons -->
    <section id='sideButtons'>
        <button>+</button>
        <p>val</p>
        <button>-</button>
    </section>
    <!--/Section:Side Buttons -->

    <!--Section:Proposition -->
    <section id="proposition">
        <!--Division:Entete -->
        <div id='header'>
            <!--Author-->
            <p class="auteur"> phpauthor </p>
            <!--Date Posted-->
            <p class="date"> phpdate </p>
        </div>
        <!--/Division:Entete -->

        <!--Division:info -->
        <div id='info'>
            <!--Title-->
            <p class="titre"> phptitre </p>
            <!--Tags-->
            <p class="tags"> phpTags </p>
        </div>
        <!--/Division:info -->

        <!--Division:post -->
        <div id='mainPost'>
            <!--Description-->
            <p class="description"> phpdecript </p>
        </div>
        <!--/Division:post -->

        <!--Division:footer -->
        <div id='footer'>
            <!--Commenter-->
            <p class="commentaire"> phpNbCommentaire commentaires</p>
            <!--Partager-->
            <p class="partager"> share href facebook?</p>
        </div>
        <!--/Division:footer -->

    </section>

    
    <!--/Section:Proposition -->

</section>
<!--/Section-->



<?php 
    include  '../controler/getPropositions.php';
?>


