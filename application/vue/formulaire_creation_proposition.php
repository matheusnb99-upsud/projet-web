<!doctype html>
<html lang='fr'>
<head>
    <meta charset='utf-8'/>
    <link rel='stylesheet' href='../../style/style.css' type='text/css'/>
    <title>TD2-PROG WEB</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script type="text/javascript">
    function remSel(inp1){
        $("#catSelect option[value='" + inp1.value + "']").remove();
    }

    var i = 0;
    $(document).ready(function () {
    $("#catSelect").change(function () {
        var val = $(this).val();
        var id = $(this).children(":selected").attr('name');
        var name = "cats["+i+"]"; i++;

        var para = document.createElement("p");
        var node = document.createTextNode(val);
        para.appendChild(node);

        var element = document.getElementById("divCat");
        element.appendChild(para);

        
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", name);
        input.setAttribute("value", id);
        console.log("cats["+i+"]");

        //append to form element that you want .
        document.getElementById("form").appendChild(input);

        //<input type='hidden' name='id' value='val'></p>
        
        remSel(this);
        

        });
    });

    </script>
</head>
<body>	
    <?php include './header/logged.php';?>
	<header>
        <?php 
            session_start();
            if(isset($_SESSION['email'])){ // && ($_SESSION['email']) == null
                $connected = true;
            }else{        
                $connected = false;
            }

            if($connected){
                include './header/logged.php';
            }
            else{
                include './header/unlogged.php';
            }
        ?>
        
	</header>	
	<h2>Formulaire de creation de proposition</h2> 
	<form id='form' action='../controler/creation_proposition.php' method='post'>
        <input type='hidden' name='id' value='<?php echo $_SESSION['id']?>'></p>
            
        <div id='titre'>
	        <input type='text' name='titre' maxlength='140' placeholder='Titre'></p>
        </div>            
        <div id='categorie'>
            
            <select name="categorieSelect" id="catSelect">
                <option value="">--Aucun--</option>
                <?php 
                    require_once('../controler/get_categories.php');
                    $cats = getCategories();
                    foreach( $cats as $c) {
                        echo "<option name=".$c->getId()." value=".$c->getTitre().">".$c->getTitre()."</option>";
                    }
                
                ?>
            </select>
            <div id="divCat">
            </div>

        </div>


        <div id='fatty'>
	        <input type='text' name='description' maxlength='2147483647' placeholder='Text(optional)'></p>
	    </div>
		<button type='submit'>Post</button> 
	</form>	
    	
</body>
</html>

