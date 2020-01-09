<!-- model -->
<?php     

class Categorie{
    private $co;        // co 
    
    // variables de la base
    private $id;        // pk
    private $nom;       // str not null

    // fonctions
    public function __construct(){
        $args= func_get_args();
        
        if(func_num_args()!=2) die('Wrong Number Of Argmuments In Categorie');

        if(is_numeric($args[1])){
            $co = $args[0];
            $id = $args[1];

            $result = mysqli_query($co, "SELECT * FROM categorie
                                            WHERE `categorie_id` = '$id'")
            or die;
            
            if(mysqli_num_rows($result)==0) throw new Exception();  // si aucun resultat, lancer exeption

            while($row = mysqli_fetch_assoc($result)){
                $this->co = $co;
                $this->id = $id;
                $this->nom = $row['name_cat'];
            }
        }
        else{
            $co = $args[0];
            $nom = $args[1];

            mysqli_query($co, "INSERT INTO `categorie` (`name_cat`) VALUES('$nom'")
            or die("Erreur insertion".mysqli_error($co));
            $this->co = $co;
            $this->id = mysqli_insert_id($co);
            $this->nom = $nom;
        }
    }

    public function destroy(){
        mysqli_query($co, "DELETE FROM `categorie` WHERE `categorie_id`= $this->id")
        or die("Erreur suppression ".mysqli_error($co));
    }

    public function getTitre(){
        return $this->nom;
    }
    public function getId(){
        return $this->id;
    }

    
    public static function getCategories($co){ // Returns json 

        $result = mysqli_query($co, "SELECT * FROM categorie ")
        or die("Erreur querry");
        $res = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($res,new Categorie($co,$row['categorie_id']));
            //var_dump($res);
        }
        return $res;
    }
    
}
?>