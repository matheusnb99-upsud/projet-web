# model
<?php     
class Proposition{
    private $co;        // co 
    
    // variables de la base
    private $id;        // pk
    public $titre;     // str not null
    private $description;       // text
    private $number_reports;    // int nullable
    private $votes_positives;   // int nullablenull
    private $votes_negatives;   // int nullable
    private $votes_total;       // int nullable
    private $dateCreationProposition;   // sysdate
    private $idCreateurProposition;     // fk

    // arrays
    private $listeCommentaires;         // liste de commentaires par id
    private $listeCategories;            // liste des categories de la proposition par id

    // fonctions
    public function __construct(){
        // initialization des listes
        $this->listeCommentaires = array();
        $this->listeCategories = array();
        $cpt= func_num_args();
        $args= func_get_args();
        switch($cpt){
            case 2:         // la proposition existe deja
                $co = $args[0];
                $id = $args[1];
                
                $result = mysqli_query($co, "SELECT * FROM Proposition
                                             WHERE `proposition_id` = '$id'")
                or die;
                
                if(mysqli_num_rows($result)==0) throw new Exception();  // si aucun resultat, lancer exeption

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
            
            case 10:
                $co = $args[0];
                $id = $args[1];
                $titre = $args[2];
                $description = $args[3];
                $this->number_reports = $args[4];
                $this->votes_positives = $args[5];
                $this->votes_negatives = $args[6];
                $this->votes_total = $args[7];
                $this->dateCreationProposition = $args[8];
                $idCreateurProposition = $args[9];
                
                break;
            defaut: 
                echo "<script>console.log('hey buddy, wrong number of arguments when creating Proposition object')</script>";
        }
    }
    public function destroy(){
        mysqli_query($co, "DELETE FROM `Proposition` WHERE `proposition_id`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }

    public function addCommentaire($commentaireObj){
        /* On peut ajouter un commentaire après que la proposition soit publié*/
        $this->listeCommentaires = array_push($this->listeCommentaires, $commentaireObj->getIdCommentaire());
    }

    public function removeCommentair($commentaireObj){
        /* On peut supprimer un commentaire si on est l'auteur ou si on est un admin*/
        $this->listeCommentaires = \array_diff($this->listeCommentaires, $commentaireObj->getIdCommentaire());
    }
    
    public function addCategorie($idCategorie){
        /* Cette fonction ne sera utilisé que dans le cas de l'edition de la propositon */
        mysqli_query($this->co, "INSERT INTO `est` VALUES($this->id, $idCategorie)") or die("Erreur insertion".mysqli_error($co));
        $this->listeCategories = array_push($this->listeCategories, $idCategorie);
    }

    public function removeCategorie($idCategorie){
        /* Cette fonction ne sera utilisé que dans le cas de l'edition de la propositon */
        $this->listeCategories = \array_diff($this->listeCategories, $idCategorie);
    }
    
    public function getProposition(){
        return this; // + commentaire + tags
    }
    public static function getPropositions(){ // Returns json de Proposition
        /**
         * Usage:   getPropositions(co) 
         *          getPropositions(co, NombreProposition)
         *          getPropositions(co, NombreProposition, OrderBy)
         * 
         */
        $cpt= func_num_args();
        $args= func_get_args();
        $res= array();
        
        $co = $args[0];
        $number_propositions = "LIMIT ".$args[1];
        $order_by = "";
        if($cpt == 3){
            if($args[2] == "titre" || $args[2] == "votes_positives" || $args[2] == "votes_negatives" || $args[2] == "votes_total" || $args[2] == "date_creation_proposition"){
                $order_by = " ORDER BY ".$args[2];   
            }
        } 


        $result = mysqli_query($co, "SELECT * FROM Proposition".$order_by." ".$number_propositions)
        or die;
        
        while($row = mysqli_fetch_assoc($result)){
            $p = new Proposition($co, $row['proposition_id'],$row['titre'],$row['description'],$row['number_reports'],$row['votes_positives'],$row['votes_negatives'],$row['votes_total'],$row['date_creation_proposition'],$row['identifiant_user']);
            array_push($res, json_encode($p));
            echo "<br>".$p->titre;
        }
        return $res;

    }
}
?>