
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Some text in the Modal..</p>
        
        <div class="modal-footer">
            <p><a href="accueil.php"> Go back </a></p>
            <button class="close">Continue</button>
        </div>
    </div>

</div>
<script>// Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var span2 = document.getElementsByClassName("close")[1];

    <?php
        if(!isset($_SESSION['id'])){
                echo "modal.style.display = 'block'";
        }
    ?>


    span.onclick = function() {
        destroy();
    }
    span2.onclick = function() {
        destroy();
    }
    window.onclick = function(event) {
        destroy();
    }
    function destroy(){
        modal.style.display = "none";
        <?php
            session_destroy();
        ?>
    }
    // When the user clicks anywhere outside of the modal, close it
</script>