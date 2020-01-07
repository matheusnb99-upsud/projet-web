<!-- model -->
<?php 
    
    require_once('../model/Commentaire.php');
    require_once('../model/Proposition.php');
    require_once('../model/Groupe.php');

class Membre{
    private $co;
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $dateNaisance;
    private $dateCreation;

    // arrays
    private $listeGroupes;
    private $listePropositions;
    private $listeCommentaires;
    
    
    public function __construct(){
        // initialization des listes
        $this->listeGroupes = array();
        $this->listePropositions = array();
        $this->listeCommentaires = array();

        $cpt= func_num_args();
        $args= func_get_args();
        switch($cpt){
            case 3:
                $co = $args[0];
                $email = $args[1];
                $password = $args[2];
                // le membre existe deja
                
                $result = mysqli_query($co, "SELECT * FROM Utilisateur
                                             WHERE `email_user` = '$email'
                                             AND `password` = '$password'")
                or die;
                
                while($row = mysqli_fetch_assoc($result)){
                    $this->co = $co;
                    $this->email = $email;
                    $this->password = $password;
                    $this->id = $row['identifiant_user'];
                    $this->nom = $row['nom_user'];
                    $this->prenom = $row['prenom_user'];
                    $this->dateNaisance = $row['date_naissance'];
                    $this->dateCreation = $row['date_creation_user'];
                }
                
                echo '<br>berr';
                $this->getFromBase('proposition', $this->listeGroupes, 'Groupe');
                $this->getFromBase('rejoint', $this->listePropositions, 'Proposition');
                $this->getFromBase('proposition', $this->listeCommentaires, 'Commentaire');
                break;
            case 6:
                $co = $args[0];
                $email = $args[1];
                $password = $args[2];
                $nom = $args[3];
                $prenom = $args[4];
                $dateN = $args[5];
                $dateC = new Datetime();
                
                mysqli_query($co, "INSERT INTO `Utilisateur` (`prenom_user`, `nom_user`, `password`, `email_user`, 
                                    `date_naissance`, `date_creation_user`) 
                                     VALUES('$prenom','$nom','$password','$email','$dateN',CURRENT_TIMESTAMP)")
                or die("Erreur insertion".mysqli_error($co));
                
                $this->id = mysqli_insert_id($co);
                $this->co = $co;
                $this->email = $email;
                $this->password = $password;
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->dateNaisance = $dateN;
                $this->dateCreation = $dateC;
                break;
            defaut: 
                echo "<script>console.log('hey buddy, wrong number of arguments when creating Member object')</script>";
        }
    }
    private function getFromBase($table, $arr, $class){
        /*    Cette fonction est pour reproduire l'un de ces lignes:
            array_push($this->listeGroupes, new Groupe($this->co, $this->id));
            array_push($this->listePropositions, new Proposition($this->co, $row['proposition_id']));
            array_push($this->listeCommentaires, new Commentaire($this->co, $this->id, $row['proposition_id']));
        */
        if($table == 'proposition') $idTable = 'proposition_id';
        else if($table == 'rejoint') $idTable = 'group_id';

        $req = "SELECT ".$idTable." FROM Utilisateur NATURAL JOIN ".$table."
        WHERE Utilisateur.`identifiant_user` = ".$this->id;

        $result = mysqli_query($this->co, $req)
        or die("Erreur select membre.".$table);
        
        echo '<br>berr';
        while($row = mysqli_fetch_assoc($result)){            
            if($class == 'Commentaire')
                $tempVal = new $class($this->co, $this->id, $row['proposition_id']);
            
            else
                $tempVal = new $class($this->co,  $row[$idTable]);

                echo '<br>berr';
            array_push($arr, $tempVal);
            echo '<br>berr';
        }
        echo '<br>berr'.$arr;
    }
    
    public function modif_mdepasse($newPassword){
        $id = $this->id;
        $this->password = $newPassword;
        
        mysqli_query($co, "UPDATE Membre SET password = '$newPassword'
                            WHERE identifiant_user = '$id')")
        or die("Erreur update");
    }
    public function startConnection(){
        session_start();
        $_SESSION['id'] = $this->id;
        $_SESSION['nom'] = $this->nom;
        $_SESSION['prenom'] = $this->prenom;
        $_SESSION['email'] = $this->email;
        $_SESSION['password'] = $this->password;
        $_SESSION['dateNaisance'] = $this->dateNaisance;
        $_SESSION['dateCreation'] = $this->dateCreation;
    }
    public function deconnection(){
        session_destroy();
        mysqli_close($this->co);
    }
    
    public function destroy(){
        mysqli_query($co, "DELETE FROM `Utilisateur` WHERE `identifiant_user`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }
    public function getGroupes(){
        echo count($this->listeGroupes);
        return json_encode($this->listeGroupes);
    }
    public function getPropositions(){
        return json_encode($this->listePropositions);
    }
    public function getCommentaires(){
        return json_encode($this->listeCommentaires);
    }    
}
?>
