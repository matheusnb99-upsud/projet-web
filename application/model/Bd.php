<!-- model -->
<?php 
class Bd{
    private $co;
    private $host;
    private $user;
    private $bdd;
    private $password;
    
    public function __construct($bdd){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        
        //$this->user = 'admin';
        //$this->password = 'admin';
        $this->bdd = $bdd;
    }
    
    public function connection(){
    $this->co = mysqli_connect($this->host , $this->user ,$this->password, $this->bdd) or die("erreur de connexion");
    return $this->co;
    }

    public function deconnection(){
        mysqli_close($this->co);
    }
}
?>
