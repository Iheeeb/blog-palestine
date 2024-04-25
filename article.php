<?php 
class article {
    //les attributs de la classe user
    protected $titre ;
    protected $contenu;
    protected $username;
    protected $id;
    //constructeur de la classse user
    public function __construct (array $donnees){
        $this->hydrate($donnees);
    }
    public function hydrate (array $donnees){
        foreach($donnees as $key => $value){
            $method='set'.ucfirst($key);
            if (method_exists($this,$method)){
                $this->$method($value);
            }
        }
    }


    //getters et setters des attributs
    public function setTitre($titre){
        $this->titre=$titre;
    }
    public function setId($ida){
        $this->id=$ida;
    }
    public function getId(){
        return $this->id;
    }
    public function setContenu($contenu){
        $this->contenu=$contenu;
    }
    public function getTitre(){
        return $this->titre;
    }
    public function getContenu(){
        return $this->contenu;
    }
    public function getUsername(){
        return $this->username;
    }
    public function setUsername($un){
        $this->username=$un;
}}
?>
