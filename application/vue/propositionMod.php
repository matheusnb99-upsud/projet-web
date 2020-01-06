<?php
    /**
     * auteur: $auteur
     * date creation: $date
     * titre: $titre
     * tags: $tags
     * description: $description
     * nombre commentaires: $ncom
     * partager: propositions/$id
     */
?>
<!--Section -->
<section>
    <!--Section:Side Buttons -->
    <section class='sideButtons'>
        <button>+</button>
        <p>val</p>
        <button>-</button>
    </section>
    <!--/Section:Side Buttons -->

    <!--Section:Proposition -->
    <section id="proposition_<?php echo $id;?>">
        <!--Division:Entete -->
        <div id='header'>
            <!--Author-->
            <p class="auteur"> <?php echo $auteur;?> </p>
            <!--Date Posted-->
            <p class="date"> <?php echo $date;?> </p>
        </div>
        <!--/Division:Entete -->

        <!--Division:info -->
        <div id='info'>
            <!--Title-->
            <p class="titre"> <?php echo $titre;?> </p>
            <!--Tags-->
            <p class="tags"><?php echo $tags;?> </p>
        </div>
        <!--/Division:info -->

        <!--Division:post -->
        <div id='mainPost'>
            <!--Description-->
            <p class="description"> <?php echo $description;?> </p>
        </div>
        <!--/Division:post -->

        <!--Division:footer -->
        <div id='footer'>
            <!--Commenter-->
            <p class="commentaire"> <?php echo $ncom;?>  commentaires</p>
            <!--Partager-->
            <p class="partager"> share href facebook?</p>
        </div>
        <!--/Division:footer -->

    </section>

    
    <!--/Section:Proposition -->

</section>
<!--/Section-->
