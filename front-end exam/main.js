const contenu = document.querySelector(".contenu");
const nom = document.querySelector("#nomRestaurant");
const address = document.querySelector("#adresseRestaurant");
const city = document.querySelector("#villeRestaurant");

function templateRestaurant(restaurant) {
  let html = `
                  <hr>
                  <h2>${restaurant.name}</h2>
                  <h3>${restaurant.address}</h3>
                  <h3>${restaurant.city}</h3>
                  <button id="${restaurant.id}" class="btn btn-danger boutonSupp">Supprimer</button>
                  <hr>
      `;
  return html;
}

function afficheToutLesRestaurants() {
  contenu.innerHTML = "";
  let url =
    "http://localhost/PhP/baseFramework 2.0/?type=restaurant&action=index";
  fetch(url)
    .then((reponse) => reponse.json())
    .then((restaurants) => {
      restaurants.forEach((restaurant) => {
        console.log(restaurant);
        contenu.innerHTML += templateRestaurant(restaurant);
      });
      document.querySelectorAll(".boutonSupp").forEach((bouton) => {
        bouton.addEventListener("click", () => {
          supprimeRestaurant(bouton.id);
        });
      });
    });
}

afficheToutLesRestaurants();

function creerRestaurant(nom, address, city) {
  let url =
    "http://localhost/PhP/baseFramework 2.0/?type=restaurant&action=new";

  let bodyRequete = {
    name: nom,
    address: address,
    city: city,
  };

  let requete = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(bodyRequete),
  };

  fetch(url, requete)
    .then((reponse) => reponse.json())
    .then((restaurant) => {
      console.log(restaurant);
      afficheToutLesRestaurants();
    });
}

let boutonPoster = document
  .querySelector("#poster")
  .addEventListener("click", () => {
    creerRestaurant(nom.value, address.value, city.value);
    nom.value = "";
    address.value = "";
    city.value = "";
  });

function supprimeRestaurant(id) {
  let url =
    "http://localhost/PhP/baseFramework 2.0/?type=restaurant&action=erase";

  let bodyRequete = {
    id: id,
  };

  let requete = {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(bodyRequete),
  };

  fetch(url, requete).then((reponse) =>
    reponse.json().then((data) => {
      console.log(data);
      afficheToutLesRestaurants();
    })
  );
}
