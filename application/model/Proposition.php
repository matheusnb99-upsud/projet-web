# model
<?php 
    
class Proposition{
    private $co;
    private $id;
    private $titre;
    private $description;
    private $number_reports;
    private $votes_positives;
    private $votes_negatives;
    private $votes_total;
    private $dateCreationProposition;
    private $idCreateurProposition;

    public function __construct(){
        $cpt= func_num_args();
        $args= func_get_args();
        switch($cpt){
            case 2:
                $co = $args[0];
                $id = $args[1];
                // la proposition existe deja
                
                $result = mysqli_query($co, "SELECT * FROM Proposition
                                             WHERE `proposition_id` = '$id'")
                or die;
                
                if(mysqli_num_rows($result)==0) throw new Exception();

                while($row = mysqli_fetch_assoc($result)){
                    $this->co = $co;
                    $this->id = $id;
                    $this->titre = $row['titre'];
                    $this->description = $row['description'];
                    $this->number_reports = $row['number_reports'];
                    $this->votes_positives = $row['votes_positives'];
                    $this->votes_negatives = $row['votes_negatives'];
                    $this->votes_total = $row['votes_total'];
                    $this->dateCreationProposition = $row['date_creation_proposition'];
                    $this->idCreateurProposition = $row['identifiant_user'];
                }
                break;
            case 4:
                $co = $args[0];
                $titre = $args[1];
                $description = $args[2];
                $idCreateurProposition = $args[3];
                $dateCreationProposition = new Datetime();
                
                mysqli_query($co, "INSERT INTO `Proposition` (`titre`, `description`, `number_reports`, `votes_positives`, 
                `votes_negatives`,`votes_total`, `date_creation_proposition`, identifiant_user) 
                                     VALUES('$titre','$description',0,0,0,0,CURRENT_TIMESTAMP,'$idCreateurProposition')")
                or die("Erreur insertion".mysqli_error($co));
                
                $this->co = $co;
                $this->id = mysqli_insert_id($co);
                $this->titre = $titre;
                $this->description = $description;
                $this->number_reports = 0;
                $this->votes_positives = 0;
                $this->votes_negatives = 0;
                $this->votes_total = 0;
                $this->dateCreationProposition = $dateCreationProposition;
                $this->idCreateurProposition = $idCreateurProposition;
                break;
            defaut: 
                echo "<script>console.log('hey buddy, wrong number of arguments when creating Proposition object')</script>";
        }
    }
    public function destroy(){
        mysqli_query($co, "DELETE FROM `Proposition` WHERE `proposition_id`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }

}