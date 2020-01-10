<!-- model -->
<?php 
    require_once('../model/Proposition.php');
    require_once('../model/Membre.php');
    
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

         
        $this->listeBans = array();
        $this->listeMembres = array();
        $this->listeAdmins = array();
        $cpt= func_num_args();
        $args= func_get_args();
        switch($cpt){
            case 2:
                $co = $args[0];
                $id = $args[1];
                
                $result = mysqli_query($co, "SELECT * FROM Groupe
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

                
                $this->getFromBase('Rejoint', $this->listeMembres);
                $this->getFromBase('Banni', $this->listeBans);
                break;
            case 3:
                $co = $args[0];
                $nom = $args[1];
                $idCreateur = $args[2];
                $dateCreation = new Datetime();
                
                mysqli_query($co, "INSERT INTO `groupe` (`name_group`,`date_creation_groupe`,`identifiant_user`) 
                                     VALUES('$nom',CURRENT_TIMESTAMP,'$idCreateur')")
                or die("Erreur insertion".mysqli_error($co));
                
                $this->co = $co;
                $this->id = mysqli_insert_id($co);
                $this->nom = $nom;
                $this->dateCreation = $dateCreation;
                $this->dateSuppression = null;
                $this->idCreateur = $idCreateur;
                break;
            defaut: 
                echo "<script>console.log('hey buddy, wrong number of arguments when creating Member object')</script>";
        }
    }
    private function getFromBase($table, &$arr){
        
        /*    Cette fonction est pour reproduire l'un de ces lignes:
            array_push($this->listeBans, new Membre($this->co, login, mdp));
            array_push($this->listeMembres, new Membre($this->co, login, mdp));
            array_push($this->listeAdmins, new Membre($this->co, login, mdp));

            select * from table where groupeid = this
            table[0] = 'rejoint'

        */
        if($this->id!=0){
            $req = "SELECT * FROM ".$table." WHERE ".$table.".`group_id` = ".$this->id;

            $result = mysqli_query($this->co, $req) or die("Erreur select Groupe.".$table);
            
            while($row = mysqli_fetch_assoc($result)){    
                $req = "SELECT `email_user`,`password` FROM utilisateur WHERE `identifiant_user` = ".$row['identifiant_user'];
                $result = mysqli_query($this->co, $req) or die("Erreur select Groupe.".$table);
                $email = mysqli_fetch_assoc($result)['email_user'];
                $pwd = mysqli_fetch_assoc($result)['password'];
                array_push($arr, new Membre($this->co, $email, $pwd, 0));
            }
        }
             
    }


    
    public function destroy(){
        mysqli_query($co, "DELETE FROM `Groupe` WHERE `group_id`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }
    public function getTitre(){
        return $this->nom;
    }
    public function getId(){
        return $this->id;
    }
    public function isAdmin($membre){
        return ($this->idCreateur == $membre->getId());
    }

    public function getBans(){
        return $this->listeBans;
    }

    public function getMembres(){
        $temp = array();
        foreach(($this->listeMembres) as $m){
            $temp[$m->getId()]= $m->getMail();
        }
        return $temp;
    }
    public static function bannir($membre){
        array_push($this->listeBans, $membre);

        mysqli_query($this->co, "DELETE FROM `rejoint` WHERE `identifiant_user`= '$membre->getId()'")
        or die("Erreur ban membre ".mysqli_error($co));

        mysqli_query($this->co, "INSERT INTO `banni` (`identifiant_user`,`group_id`,`date_banni`) 
        VALUES('$membre->getId()','$this->id',CURRENT_TIMESTAMP)")
        or die("Erreur insertion");

    }

    public function toJson(){
        $p = array("id"=>$this->id,
        "nom"=>$this->nom,
        "dateC"=>$this->dateCreation,
        "dateD"=>$this->dateSuppression,
        "idCreateur"=>$this->idCreateur);
        //var_dump(json_encode($p));
        return json_encode($p);
    }

    public function ajouterMembre($membre){
        $result = mysqli_query($co, "SELECT * FROM banni
        WHERE `group_id` = '$this->id' AND `identifiant_user`='$membre->getId()'")
        or die;

        if(!mysql_num_rows($result)) die("Membre Banni de ce groupe");
        array_push($this->listeMembres, $membre);
        $mid =  $membre->getId();
                
        mysqli_query($this->co, "INSERT INTO `rejoint` (`identifiant_user`,`group_id`,`date_rejoint`) 
        VALUES('$mid','$this->id',CURRENT_TIMESTAMP)")
        or die("Erreur insertion");

    }
    public function inviter($email){ 
        // Préparation du mail contenant le lien d'activation
        $destinataire = $email;
        $sujet = "Invitation pour un groupe: ".$this->nom;
        $entete = "From: inscription@votresite.com" ;
         
        // Le lien d'activation est composé du email de l'utilisateur et du ID du groupe
        $message = 'Bienvenue sur VotreSite,
         
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
        ou copier/coller dans votre navigateur Internet.
         
        http://localhost:8000/iut/projet-web/application/controler/confirm_invitation_groupe.php?idGroupe='.urlencode($this->id).'&destinataire='.urlencode($destinataire).'
         
         
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';
         
         
        mail($destinataire, $sujet, $message, $entete);
    }
    
}
?>
