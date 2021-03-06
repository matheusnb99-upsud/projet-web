<!-- model -->
<?php     

require_once('../model/Commentaire.php');
require_once('../model/Categorie.php');

class Proposition{
    private $co;        // co 
    
    // variables de la base
    private $id;        // pk
    private $titre;     // str not null
    private $description;       // text
    private $number_reports;    // int nullable
    private $votes_positives;   // int nullablenull
    private $votes_negatives;   // int nullable
    private $votes_total;       // int nullable
    private $dateCreationProposition;   // sysdate
    private $datePropositionTroisJours;  // sysdate +3d
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
                    $this->datePropositionTroisJours = $row['date_suppression_proposition'];
                    $this->idCreateurProposition = $row['identifiant_user'];
                }
                break;
            case 5:
                $co = $args[0];
                $titre = $args[1];
                $description = $args[2];
                $idCreateurProposition = $args[3];
                $listeIdCat = $args[4];
                

                
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
                $this->dateCreationProposition = new Datetime();
                $this->idCreateurProposition = $idCreateurProposition;
                $this->datePropositionTroisJours =  strtotime($dateCreationProposition . ' +3 days');


                foreach($listeIdCat as $idCat){
                    array_push($this->listeCategories, new Categorie($this->co, $idCat));
                
                    mysqli_query($co, "INSERT INTO `est` (`proposition_id`, `categorie_id`)
                                            VALUES('$this->id','$idCat')") or die;
                }
                break;
                
            
            case 4:
                $co = $args[0];
                $titre = $args[1];
                $description = $args[2];
                $idCreateurProposition = $args[3];
                $dateCreationProposition = new Datetime();
                $datePropositionTroisJours = date_add($dateCreationProposition, date_interval_create_from_date_string('3 days'));
                

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
                $this->datePropositionTroisJours = $datePropositionTroisJours;
                $this->idCreateurProposition = $idCreateurProposition;
                break;
            
            case 10:
                $this->co = $args[0];
                $this->id = $args[1];
                $this->titre = $args[2];
                $this->description = $args[3];
                $this->number_reports = $args[4];
                $this->votes_positives = $args[5];
                $this->votes_negatives = $args[6];
                $this->votes_total = $args[7];
                $this->dateCreationProposition = $args[8];
                $this->idCreateurProposition = $args[9];
                
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
        $this->listeCommentaires = array_push($this->listeCommentaires, $commentaireObj);
    }
    public function voter($val){
        if($val==true) $this->votes_positives+=1;
        else $this->votes_negatives+=1;
        $this->votes_total +=1;

        mysqli_query($co, "UPDATE `Proposition` 
                        SET `votes_positives` = '$this->votes_positives',`votes_negatives`='$this->votes_negatives',`votes_total`= '$this->votes_total'
                        WHERE `proposition_id`= $this->id")
        or die("Erreur insertion".mysqli_error($co));
    }
    
    public function reporter(){
        $this->number_reports+=1;
        if($this->number_reports<10){
            mysqli_query($co, "UPDATE `Proposition` SET `number_reports` = '$this->number_reports')
                                WHERE `proposition_id`= $this->id)")
            or die("Erreur insertion".mysqli_error($co));
        }else $this->destroy();
    }

    public function removeCommentair($commentaireObj){
        /* On peut supprimer un commentaire si on est l'auteur ou si on est un admin*/
        $this->listeCommentaires = \array_diff($this->listeCommentaires, $commentaireObj);
    }
    
    public function addCategorie($idCategorie){
        /* Cette fonction ne sera utilisé que dans le cas de l'edition de la propositon */
        mysqli_query($this->co, "INSERT INTO `est` VALUES($this->id, $idCategorie)") or die("Erreur insertion".mysqli_error($co));
        array_push($this->listeCategories, new Categorie($this->co, $idCategorie));
    }

    public function removeCategorie($idCategorie){
        /* Cette fonction ne sera utilisé que dans le cas de l'edition de la propositon */
        $this->listeCategories = \array_diff($this->listeCategories, $idCategorie);
    }
    
    public function getProposition(){
        $co = $this->co;
        $result = mysqli_query($co, 
        "SELECT * FROM Utilisateur NATURAL JOIN Proposition NATURAL JOIN Est NATURAL JOIN Categorie WHERE Proposition.proposition_id = '$this->id'")
        or die("Erreur query Proposition");
        
        while($row = mysqli_fetch_assoc($result)){
            $json = json_decode($this->toJson(), true);
            $json['auteur'] = $row['email_user'];
            $json['tag'] = $row['name_cat'];
        }
        return json_encode($json);

    
    }
    public function gettitre(){
        return $this->titre; 
    }
    public function dateS(){
        return $this->$this->datePropositionTroisJours; 
    }
    public function toJson(){
        $p = array("id"=>$this->id,
        "titre"=>$this->titre,
        "desc"=>$this->description,
        "nRep"=>$this->number_reports,
        "votP"=>$this->votes_positives,
        "votN"=>$this->votes_negatives,
        "total"=>$this->votes_total,
        "date"=>$this->dateCreationProposition,
        "datej"=>$this->datePropositionTroisJours,
        "idCreateur"=>$this->idCreateurProposition);
        //var_dump(json_encode($p));
        return json_encode($p);
    }
    
    public static function getPropositions(){ // Returns json 
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

        $result = mysqli_query($co, 
        "SELECT * FROM Utilisateur 
        NATURAL JOIN Proposition 
        LEFT JOIN Est ON Proposition.proposition_id = Est.proposition_id
        LEFT JOIN Categorie ON Est.categorie_id = Categorie.categorie_id
         ".$order_by." ".$number_propositions)
        //$result = mysqli_query($co, "SELECT * FROM Proposition")
        or die("Erreur query Proposition");
        
        while($row = mysqli_fetch_assoc($result)){
            //var_dump($row['proposition_id']);
            $p = new Proposition($co,   $row['proposition_id'],$row['titre'],$row['description'],$row['number_reports'],$row['votes_positives'],
                                        $row['votes_negatives'],$row['votes_total'],$row['date_creation_proposition'],$row['identifiant_user']);
            $json = json_decode($p->toJson(), true);
            $json['auteur'] = $row['email_user'];
            $json['tag'] = $row['name_cat'];
            array_push($res, json_encode($json));
            
        }
        //var_dump($json);
        return $res;

    }
}
?>
