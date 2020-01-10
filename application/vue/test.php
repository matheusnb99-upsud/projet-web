
	
<head>
    <link href="../../style/header.css" rel="stylesheet">

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
        var node = document.createTextNode("#"+val);
        para.appendChild(node);

        
        var div = document.createElement("DIV");
        div.setAttribute("class", 'col-lg-6 col-md-6');
        div.appendChild(para);

        var element = document.getElementById("divCat");
        element.appendChild(div);

        
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
    <header>
        <?php 
            session_start();
            if(isset($_SESSION['email'])){ // && ($_SESSION['email']) == null
                $connected = true;
            }else{        
                $connected = false;
            }

            if($connected){
                include './header/headertest.php';
            }
            else{
                include './header/unlogged.php';
            }
        ?>
	</header>	
    <section class="content">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-16" style='padding-top: 50px;'>

                    <!-- POST -->
                    <div class="post">
                        <form action='../controler/creation_proposition.php' class="form newtopic" method="post" id='form'>
                            <div class="topwrap">
                                <div class="userinfo pull-left">

                                    <div class="email" style="width: 1px;word-wrap: break-word;white-space: pre-wrap;">
                                        <div class="text-center">
                                            <p style='padding-left:50%;'><?php echo $_SESSION['nom']; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="posttext pull-left">

                                    <div>
                                        <input type="text" name='titre' placeholder="Titre" class="form-control">
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <select name="categorieSelect" id="catSelect" class="form-control">
                                                <option value="">--Aucune--</option>
                                                <?php 
                                                    require_once('../controler/get_categories.php');
                                                    $cats = getCategories();
                                                    foreach( $cats as $c) {
                                                        echo "<option name=".$c->getId()." value=".$c->getTitre().">".$c->getTitre()."</option>";
                                                    }
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <textarea style='resize: vertical;' name='description' id="desc" placeholder="Description (optionel)" class="form-control"></textarea>
                                    </div>
                                    <div class="row newtopcheckbox">
                                        <div class="col-lg-6 col-md-6">
                                            <div><p>Tags:</p></div>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-6">
                                                    <div class="categories" id='divCat'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>                              
                            <div class="postinfobot">
                                <div class="pull-right postreply">
                                    <div class="pull-left"><button type="submit" class="btn btn-primary">Post</button></div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <!-- POST -->
                </div>
            </div>
        </div>
    </section>