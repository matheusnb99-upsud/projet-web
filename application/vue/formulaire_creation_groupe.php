
	
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
                        <form action='../controler/creation_groupe.php' class="form newtopic" method="post" id='form'>
                            <div class="topwrap">
                                <div class="posttext pull-left">
                                    <div>
                                        <input type="text" name='titre' placeholder="Titre" class="form-control">
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