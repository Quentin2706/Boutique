/*******************RECUPERATION DE LA SURCHARGE URL*********************/
var $_GET = [];
var parts = window.location.search.substr(1).split("&");
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}
/*******************LES VARIABLES*********************/
const requ = new XMLHttpRequest();
/*********LES VARIABLES LISTE DONNEES********/
if ($_GET["page"]=="ListeDonnees")
{
var lesMenus = document.getElementsByClassName("menu");
var lesSousMenu = document.getElementsByClassName("sousMenu");
var lesContenuSousMenu = document.getElementsByClassName("contenuSousMenu");
}
/*********LES VARIABLES LISTE ARTICLES********/
if ($_GET["page"]=="Liste" && $_GET["table"]=="Article")
{
var filtres = document.getElementsByClassName("filtre");
var rech = document.getElementById("recherche");
var tableauArticles = document.getElementsByClassName("tableau")[0];
}
/*********LES VARIABLES LISTE CLIENTS********/
var lesClients = document.getElementsByClassName("ligne"); 

/*******************LES FONCTIONS*********************/
/*********LISTE DONNEES********/
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
function detailAchat(e) {
    var href = e.target.parentNode.children[3].children[0].children[0].children[0].getAttribute("href");
    href=href.substr(1).split("&");
    var infos = [];
for (var i = 0; i < href.length; i++) {
    var temp = href[i].split("=");
    infos[temp[0]] = temp[1];
}
    window.location.href = "index.php?page=ListeAchats&id="+infos['id'];
}

/*********LISTE ARTICLES********/
function rechFiltre() {
    var filtrage = {
        "refArticle": filtres[0].value,
        "libArticle": filtres[1].value,
        "idUnivers": filtres[2].value,
        "idCateg": filtres[3].value,
        "idCouleur": filtres[4].value,
        "idFournisseur": filtres[5].value
    }
    // STRINGIFY SERT A ENVOYER EN JSON DONC SOUS FORME DE STRING
    filtrage = JSON.stringify(filtrage);
    requ.open('POST', './index.php?page=apiArticle', true);
    requ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ.send("filtrage=" + filtrage);
}
function afficheDetail(e) {
    e.target.parentNode.nextSibling.setAttribute("class","ligne");
}

/*******************EVENTS*********************/
/*********LISTE DONNEES********/
if ($_GET["page"]=="ListeDonnees")
{
for (let i = 0; i < lesMenus.length; i++) {
    lesMenus[i].addEventListener("click", afficheSousMenu);
}
for (let i = 0; i < lesContenuSousMenu.length; i++) {
    lesContenuSousMenu[i].addEventListener("click", redirige);
}
}
/*********LISTE ARTICLES********/
if ($_GET["page"]=="Liste" && $_GET["table"]=="Article")
{
rech.addEventListener("click", rechFiltre);
}
/*********LISTE CLIENT********/
if ($_GET["page"]=="Liste" && $_GET["table"]=="Client")
{
    for(let i = 1; i < lesClients.length; i++)
    {
        lesClients[i].addEventListener("click", function(e)
        {
            detailAchat(e);
        });
    }
}
/*********************API***********************/
/*********LISTE ARTICLES********/

requ.onreadystatechange = function (event) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log("Réponse reçue: %s", this.responseText);
            reponse = JSON.parse(this.responseText);
            console.log(reponse);
            var entete = tableauArticles.children[0];
            tableauArticles.innerHTML = "";
            tableauArticles.appendChild(entete);
            for (let i = 0; i < reponse.length; i++) {
                // création de la ligne
                ligne = document.createElement("div");
                ligne.setAttribute("class", "ligne donnees");
                tableauArticles.appendChild(ligne);
                // création des cases
                // AFFICHAGE REFARTICLE
                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu");
                    uneCase.innerHTML = reponse[i].refArticle;
                    ligne.appendChild(uneCase);
                    // AFFICHAGE LIBARTICLE
                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu");
                    uneCase.innerHTML = reponse[i].libArticle;
                    ligne.appendChild(uneCase);
                    // AFFICHAGE IDUNIVERS
                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu");
                    uneCase.innerHTML = reponse[i].idUnivers;
                    ligne.appendChild(uneCase);
                    // AFFICHAGE IDCATEG
                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu");
                    uneCase.innerHTML = reponse[i].idCateg;
                    ligne.appendChild(uneCase);
                    // AFFICHAGE IDFOURNISSEUR
                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu");
                    uneCase.innerHTML = reponse[i].idFournisseur;
                    ligne.appendChild(uneCase);
                    // AFFICHAGE IDCOULEUR
                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu");
                    uneCase.innerHTML = reponse[i].idCouleur;
                    ligne.appendChild(uneCase);
                

                // AFFICHAGE DES BOUTONS

                    uneCase = document.createElement("div");
                    uneCase.setAttribute("class", "contenu ligne");
                    ligne.appendChild(uneCase);

                    lesBoutons = document.createElement("div");
                    lesBoutons.setAttribute("class", "miniBouton centrer ligne");
                    uneCase.appendChild(lesBoutons);
                    // ==========  BOUTON 1 =================
                    bouton = document.createElement("button");
                    lesBoutons.appendChild(bouton);
                    ahref = document.createElement("a");
                    ahref.setAttribute("href", "index.php?page=Form&table=Article&mode=modif&id=" + reponse[i].idArticle)
                    bouton.appendChild(ahref);
                    img = document.createElement("img");
                    img.setAttribute("src", "./IMG/modifie.png");
                    img.setAttribute("alt", "Modifier Univers");
                    ahref.appendChild(img);

                    // ==========  BOUTON 2 =================
                    bouton = document.createElement("button");
                    lesBoutons.appendChild(bouton);
                    ahref = document.createElement("a");
                    ahref.setAttribute("href", "index.php?page=Form&table=Article&mode=delete&id=" + reponse[i].idArticle)
                    bouton.appendChild(ahref);
                    img = document.createElement("img");
                    img.setAttribute("src", "./IMG/supprimer.png");
                    img.setAttribute("alt", "Supprimer Univers");
                    ahref.appendChild(img);


                //LIGNES DETAILS INVISIBLE PAR DEFAUT
                // création de la ligne
                ligne = document.createElement("div");
                ligne.setAttribute("class", "ligne");
                ligne.nextSibling;

                ligneInv = document.createElement("div");
                ligneInv.setAttribute("class", "ligne invisible");
                tableauArticles.appendChild(ligneInv);
                // AFFICHAGE IDTAILLE
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu marronFonce");
                uneCase.innerHTML = "<b>Taille : </b>"+reponse[i].idTaille;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE IDINCREMENTALE
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Ref incrementale : </b>"+reponse[i].idIncrementale;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE IDLOT
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Lot : </b>"+reponse[i].idLot;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE QUANTITE STOCK
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Quantité en stock : </b>"+reponse[i].quantiteStock;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE PRIX ACHAT
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Prix d'achat : </b>"+reponse[i].prixAchat;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE PRIX VENTE
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Prix de vente : </b>"+reponse[i].prixVente;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE SEUIL
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Seuil : </b>"+reponse[i].seuil;
                ligneInv.appendChild(uneCase);
            }
            var donnees=document.getElementsByClassName("donnees");
            for(let i =0;i<donnees.length;i++){
                donnees[i].addEventListener("click",afficheDetail)
            }
        } else {
            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
        }
    }
};

