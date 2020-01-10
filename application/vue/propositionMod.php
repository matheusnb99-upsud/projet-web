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
<head>
    <link href="../../style/header.css" rel="stylesheet">
    <script>
    function voter(i, id) {
        console.log(id);
        <?php $voteT += 1;?>
    }
    </script>    

</head>
<body>
<!--Post -->
<div class="post" style="margin:12px 40px">
    <div class="wrap-ut pull-left">
        <div class="userinfo pull-left">
            <div class="icons">
                <p><?php echo $auteur;?></p>
            </div>
        </div>
        <div class="posttext pull-left" style="padding-left:40px">
            <h2><a href="./proposition.php?id=<?php echo $id;?>"><?php echo $titre;?></a></h2>
            <small><?php echo $tags;?></small>
            <p style='font-weight: bold;'><?php echo $description;?></p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="postinfo pull-left">
        <div class="comments">
            <?php 
                if($boolDate) 
                    echo $voteP.'
                    <div class="mark"></div>
                    '.$voteN;
                else 
                    echo '
                    <a onclick="voter(1, '.$id.')"><i class="fa fa-arrow-up"></i></a>'.$voteT.'
                    <i class="fa fa-arrow-down"></i>';
           ?> 
        </div>

        <div class="time"><i class="fa fa-clock-o"></i> 
        <?php 
            $date1 = $date;
            setlocale(LC_TIME, "fr_FR","French");
            $date = strftime("%d %B %Y", strtotime($date1));
            echo $date.'<br>'.strftime(" %H:%M", strtotime($date1));
        ?></div>                                    
    </div>
    <div class="clearfix"></div>
</div>

</body>
<!--/Post-->
