<?php  

namespace Controllers;

class Restaurant extends AbstractController{


    protected $defaultModelName = \Models\Restaurant::class;
    

    public function index(){

        $restaurants = $this->defaultModel->findAll();
        return $this->json($restaurants);
    }

    public function new(){

        $request = $this->post('json',["name"=>"text","address"=>"text","city"=>"text"]);
        if(!$request){
            return $this->json("requete mal soumise");
        }

                $restaurants = new \Models\Restaurant();
                $restaurants->setName($request['name']);
                $restaurants->setAddress($request['address']);
                $restaurants->setCity($request['city']);
                $this->defaultModel->save($restaurants);

           return $this->json("Restaurant ajouté");     
    }

    public function erase(){

        $request = $this->delete('json',['id'=>'number']);

                if(!$request){
                        return $this->json("requete mal soumis","delete");
                        }

        $restaurant = $this->defaultModel->findById($request['id']);

                if(!$restaurant){
                        return $this->json("ce restaurant n'existe pas","delete");
                        }

        $this->defaultModel->remove($restaurant);

                        return $this->json("restaurant supprimé","delete");
    
 }
    }


?>