/**********************VARIABLES*************************/
var lesMenus = document.getElementsByClassName("menu");
var lesSousMenu = document.getElementsByClassName("sousMenu");
var lesContenuSousMenu = document.getElementsByClassName("contenuSousMenu");

var btnRecherche=document.getElementById("recherche");
var filtres=document.getElementsByClassName("filtre");

const requ=new XMLHttpRequest();
/**********************FONCTIONS*************************/
function afficheSousMenu(event) {
    //on ferme les sous menu ouvert
    for (let i = 0; i < lesSousMenu.length; i++) {
        lesSousMenu[i].style.display = "none";

    }
    //on ouvre le sous menu correspondant au click
    var sousMenu = event.target.parentNode.getElementsByClassName("sousMenu")[0];
    sousMenu.style.display = "flex";
}

function redirige(event) {
    var cible = event.target.parentNode.getAttribute("cible");
    if (cible.substring(0, 3) == "Lis") {
        window.location.href = "index.php?page=Liste&table=" + cible.substring(3);
    }
    else {
        window.location.href = "index.php?page=Form&table=" + cible.substring(3) + "&mode=ajout";
    }

}

function filtrage(){
    var filtrage= {
        "refArticle":filtres[0].value,
        "libArticle":filtres[1].value,
        "idUnivers":filtres[2].value,
        "idCateg":filtres[3].value,
        "idCouleur":filtres[4].value,
        "idFournisseur":filtres[5].value
    }
    console.log(filtrage);
    requ.open('POST', './index.php?page=apiRech', true);
    requ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ.send("filtrage="+filtrage);
}

/**********************EVENTS*************************/

for (let i = 0; i < lesMenus.length; i++) {
    lesMenus[i].addEventListener("click", afficheSousMenu);
}

for (let i = 0; i < lesContenuSousMenu.length; i++) {
    lesContenuSousMenu[i].addEventListener("click", redirige);
}

btnRecherche.addEventListener("click",filtrage)

/**********************API*************************/

requ.onreadystatechange = function (event) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log(this.responseText);
            reponse = JSON.parse(this.responseText);
            /**Créer l'affichage ici**/
            
        } else {
            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
        }
    }
};