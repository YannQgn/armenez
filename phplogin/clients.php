<?php
class Clients{

    private $connexion;
    private $table = "clients";

    public $id;
    public $nom;
    public $prenom;
    public $lat;
    public $lon;

    /** 
     * @param $db
     */
    public function __construct($db){
        $this->connexion = $db;
    }

    @return void
  
    public function lire(){

        $sql = "SELECT * FROM " . $this->table;

        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }
}