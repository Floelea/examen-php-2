<?php    

namespace Models;

class Restaurant extends AbstractModel implements \JsonSerializable{

    protected string $nomDeLaTable = "restaurants";
    

    private $id;
    public function getId(){
        return $this->id;
    }

    private $name;
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name=$name;
    }

    private $address;
    public function getAddress(){
        return $this->address;
    }
    public function setAddress($address){
        $this->address=$address;
    }

    private $city;
    public function getCity(){
        return $this->city;
    }
    public function setCity($city){
        $this->city=$city;
    }

    /**
     * Crée un objet Plat pour les recuperer en le recherchant par l'id du restaurant
     */
    public function getPlats(){

        $modelPlats = new \Models\Plat();
        return $modelPlats->findAllByRestoId($this);
    }
    /**
     * Spécifie les données qui doivent être linéarisées en JSON
     */
    public function jsonSerialize(){

        return [
            "name"=>$this->name,
            "address"=>$this->address,
            "id"=>$this->id,
            "city"=>$this->city,
            "plats"=>$this->getPlats()
        ];
    }

    /**
     * @param Restaurant $restaurant
     * permet de créer un restaurant et de l'insérer dans la BDD
     * 
     */
    public function save(Restaurant $restaurant){

        $sql = $this->pdo->prepare("INSERT INTO {$this->nomDeLaTable} 
        (name, address, city) VALUES (:name, :address, :city)");

        $sql->execute([
            "name"=>$restaurant->name,
            "address"=>$restaurant->address,
            "city"=>$restaurant->city,
            
        ]);
    }


}