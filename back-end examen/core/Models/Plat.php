<?php    

namespace Models;

class Plat extends AbstractModel implements \JsonSerializable{

    protected string $nomDeLaTable = "plats";
    

    private $id;
    public function getId(){
        return $this->id;
    }

    private $description;
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description=$description;
    }

    private $price;
    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price=$price;
    }

    private $restaurant_id;
    public function getRestaurant_id(){
        return $this->restaurant_id;
    }
    public function setRestaurant_id($restaurant_id){
        $this->restaurant_id=$restaurant_id;
    }

 /**
 * Spécifie les données qui doivent être linéarisées en JSON
 */
public function jsonSerialize(){

        return [
            "description"=>$this->description,
            "price"=>$this->price,
        ];
    }

/**
 * Permet de trouver tout les plats a partir de l'ID du restaurant
 *  */  
public function findAllByRestoId(Restaurant $restaurant){

    $sql = $this->pdo->prepare("SELECT * FROM {$this->nomDeLaTable} 
    WHERE restaurant_id = :restaurant_id");

    $sql ->execute ([

        "restaurant_id" => $restaurant->getId()

    ]);

    $plats = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));

    return $plats;

    }

}