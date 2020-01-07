<!-- model -->
<?php     
class Commentaire{
    private $co;        // co 
    
    // variables de la base
    private $idAuteur;          // fk pk
    private $idProposition;     // fk pk
    private $commentaireBrut;   // text
    private $number_reports;    // int nullable
    private $votes_positives;   // int nullable
    private $votes_negatives;   // int nullable
    private $dateCreationCommentaire;   // sysdate

    // fonctions
    public function __construct(){ // 
        /* idAuteur passé par cookie; idProposition passé par ?; commentaireBrut peut etre formate par wysiwyg
         * 
         * ajouter nouveau commentaire => Commentaire(co, idAuteur, idProposition, commentaireBrut) 4
         * 
         * ajouter obj commentaire     => Commentaire(co, idAuteur, idProposition) 3
         * 
         * */
        
        $cpt= func_num_args();
        $args= func_get_args();
        switch($cpt){
            case 3:         //  le commentaire existe deja
                $co = $args[0];
                $idAuteur = $args[1];
                $idProposition = $args[2];
                
                
                $result = mysqli_query($co, "SELECT * FROM commente WHERE `identifiant_user` = '$idAuteur' AND `proposition_id` = '$idProposition'")
                or die("Erreur Select Commentaire");
                
                while($row = mysqli_fetch_assoc($result)){
                    $this->co = $co;
                    $this->idAuteur = $idAuteur;          
                    $this->idProposition = $idProposition;
                    $this->commentaireBrut = $row['commentaire'];
                    $this->number_reports = $row['nombre_reports'];
                    $this->votes_positives = $row['nombre_likes'];
                    $this->votes_negatives = $row['nombre_deslikes'];
                    $this->dateCreationCommentaire = $row['date_creation'];
                }

                break;
            case 4:
                $co = $args[0];
                $idAuteur = $args[1];
                $idProposition = $args[2];
                $commentaireBrut = $args[3];
                $dateCreationCommentaire = new Datetime();
                
                mysqli_query($co, "INSERT INTO `Commente` (`identifiant_user`, `proposition_id`, `date_creation`, `commentaire`, `nombre_likes`, `nombre_deslikes`, `nombre_reports`) 
                                    VALUES('$idAuteur','$idProposition',CURRENT_TIMESTAMP,$commentaireBrut,0,0,0)")
                or die("Erreur insertion".mysqli_error($co));
                
                $this->co = $co;
                $this->idAuteur = $idAuteur;          
                $this->idProposition = $idProposition;
                $this->commentaireBrut = $commentaireBrut;
                $this->number_reports = 0;
                $this->votes_positives = 0;
                $this->votes_negatives = 0;
                $this->dateCreationCommentaire = $dateCreationCommentaire;
                break;
            defaut: 
                echo "<script>console.log('wrong number of arguments when creating Commentaire object')</script>";
        }
    }
    public function destroy(){
        mysqli_query($co, "DELETE FROM `Commente` WHERE `identifiant_user` = '$this->idAuteur' AND `proposition_id` = '$this->idProposition")
        or die("Erreur suppression ".mysqli_error($co));
    }

    public function editCommentaire($newText){
        mysqli_query($co, "UPDATE Commente SET commentaire ='$newText' WHERE `identifiant_user` = '$this->idAuteur' AND `proposition_id` = '$this->idProposition")
        or die("Erreur suppression ".mysqli_error($co));
    }
}
?>