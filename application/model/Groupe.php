<!-- model -->
<?php 
    
class Groupe{
    /**
     * fonctions: 
     *      addAdmin(Membre)
     *      delAdmin(id)
     *      addBan(Membre)
     *      delBan(id)
     *      addMembre(Membre)
     *      delMembreid)
     * 
     */
    private $co;
    private $id;
    private $nom;
    private $dateCreation;
    private $dateSuppression;
    private $idCreateur;
    
    // arrays
    private $listeBans;
    private $listeMembres;
    private $listeAdmins;
    
    public function __construct(){
        /**
         *  Groupe(co, id)
         *  Groupe(co, nom, createur)
         */
        $cpt= func_num_args();
        $args= func_get_args();
        switch($cpt){
            case 2:
                $co = $args[0];
                $id = $args[1];
                
                $result = mysqli_query($co, "SELECT * FROM groupe
                                             WHERE `group_id` = '$id'")
                or die;
                
                while($row = mysqli_fetch_assoc($result)){
                    $this->co = $co;
                    $this->id = $row['group_id'];
                    $this->nom = $row['name_group'];
                    $this->dateCreation = $row['date_creation_groupe'];
                    $this->dateSuppression = $row['date_suppression_groupe'];
                    $this->idCreateur = $row['identifiant_user'];
                } // select nj rejoint and bani
                break;
            case 3:
                $co = $args[0];
                $nom = $args[1];
                $idCreateur = $args[2];
                $dateCreation = new Datetime();
                
                mysqli_query($co, "INSERT INTO `groupe` (`name_group`,`date_creation_groupe`,`identifiant_user`) 
                                     VALUES('$nom',CURRENT_TIMESTAMP,'$email','$idCreateur')")
                or die("Erreur insertion".mysqli_error($co));
                
                $this->co = $co;
                $this->id = mysqli_insert_id($co);
                $this->nom = $nom;
                $this->dateCreation = $dateCreation;
                $this->dateSuppression = null;
                break;
            defaut: 
                echo "<script>console.log('hey buddy, wrong number of arguments when creating Member object')</script>";
        }
    }
    public function destroy(){
        mysqli_query($co, "DELETE FROM `groupe` WHERE `group_id`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }
    public function getTitre(){
        return $this->nom;
    }
    
}
?>
