# model
<?php 
    
class Membre{
    private $co;
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $dateNaisance;
    private $dateCreation;
    
    
    public function __construct(){
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
    public function modif_mdepasse($newPassword){
        $id = $this->id;
        $this->password = $newPassword;
        
        mysqli_query($co, "UPDATE Membre SET password = '$newPassword'
                            WHERE id = '$id')")
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
        $_SESSION['Membre'] = $this;
    }
    public function deconnection(){
        session_destroy();
        mysqli_close($this->co);
    }
    
    public function destroy(){
        mysqli_query($co, "DELETE FROM `Utilisateur` WHERE `identifiant_user`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }
    
}
?>
