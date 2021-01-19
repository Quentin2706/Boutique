/*******************RECUPERATION DE LA SURCHARGE URL*********************/
var $_GET = [];
var parts = window.location.search.substr(1).split("&");
for (var i = 0; i < parts.length; i++) {
    var temp = parts[i].split("=");
    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}









/*******************LES VARIABLES*********************/
const requ = new XMLHttpRequest();//API Articles
const requ2 = new XMLHttpRequest();//API Ventes Clients
const requ3 = new XMLHttpRequest();//API Passage Caisse
const requ4 = new XMLHttpRequest();//API Recup mail client
/*********LES VARIABLES LISTE DONNEES********/
if ($_GET["page"] == "ListeDonnees") {
    var lesMenus = document.getElementsByClassName("menu");
    var lesSousMenu = document.getElementsByClassName("sousMenu");
    var lesContenuSousMenu = document.getElementsByClassName("contenuSousMenu");
}
/*********LES VARIABLES LISTE ARTICLES********/
if ($_GET["page"] == "Liste" && $_GET["table"] == "Article") {
    var filtres = document.getElementsByClassName("filtre");
    var rech = document.getElementById("recherche");
    var tableauArticles = document.getElementsByClassName("tableau")[0];
}
/*********LES VARIABLES LISTE CLIENTS********/
if ($_GET["page"] == "Liste" && $_GET["table"] == "Client") {
    var lesClients = document.getElementsByClassName("ligne");
}

/*********LES VARIABLES LISTE VENTES********/
if ($_GET["page"] == "ListeVentes") {
    var entete = document.getElementById("hautTableau");
    var tableauVente = document.getElementsByClassName("tableau")[0];

    var rechVente = document.getElementsByTagName("input");
}
/*********LES VARIABLES PASSAGE A LA CAISSE********/
if ($_GET["page"] == "PassageCaisse") {
    var boutonsCaisse = document.getElementsByClassName("boutonCaisse");
    var infoPC = document.getElementsByClassName("contenu");
    var target = "";
    var tableau = document.getElementsByClassName("tableau")[0];
    var nomClient = document.getElementById("clientCaisse");
    var popupMail = document.getElementsByClassName("absoluteMail")[0];
    var divEnv = document.getElementById("mailClient");
    var btnSuppr1 = document.getElementsByClassName("supprLigne")[2];
    var btnRem1 = document.getElementsByClassName("supprLigne")[3];
    var blocFinal=document.getElementsByClassName("blocCaissePrix")[0];
}










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
    href = href.substr(1).split("&");
    var infos = [];
    for (var i = 0; i < href.length; i++) {
        var temp = href[i].split("=");
        infos[temp[0]] = temp[1];
    }
    window.location.href = "index.php?page=ListeAchats&id=" + infos['id'];
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
    e.target.parentNode.nextSibling.setAttribute("class", "ligne");
}

/*********LISTE VENTES********/
function filtreVente() {
    var filtrageVente = {
        "dateDebut": rechVente[0].value,
        "dateFin": rechVente[1].value
    }
    filtrageVente = JSON.stringify(filtrageVente);
    requ2.open('POST', './index.php?page=apiVente', true);
    requ2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ2.send("filtrageVente=" + filtrageVente)
}
/********* PASSAGE CAISSE ********/

function remplissageAuto(e) {
    target = e.target;
    var refPC = e.target.value; //On récupère la référence de l'article
    requ3.open('POST', './index.php?page=apiPassageCaisse', true);
    requ3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ3.send("refPC=" + refPC);
}

function creerLigne(e) {
    if (e.target.parentNode.parentNode.children[6].innerHTML == "") { //On regarde si le total n'a pas déjà été calculé(ligne déjà remplie)
        var ligne = document.createElement("div");
        ligne.setAttribute("class", "ligne");
        tableau.appendChild(ligne);

        var btnSuppr = document.createElement("div");
        btnSuppr.setAttribute("class", "supprLigne");
        ligne.appendChild(btnSuppr)
        btnSuppr.addEventListener("click", supprLigne)//Event pour supprimer la ligne

        var imgSuppr = document.createElement("img");
        imgSuppr.setAttribute("src", "./IMG/supprimer.png");
        btnSuppr.appendChild(imgSuppr);

        var btnRem = document.createElement("div");
        btnRem.setAttribute("class", "supprLigne");
        ligne.appendChild(btnRem)
        btnRem.addEventListener("click",remiseLigne); //Event listener pour remiser la ligne

        var imgRem = document.createElement("img");
        imgRem.setAttribute("src", "./IMG/remise.png");
        btnRem.appendChild(imgRem);



        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var input = document.createElement("input");
        input.setAttribute("class", "redimInput");
        contenu.appendChild(input);
        input.addEventListener("input", remplissageAuto);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var input2 = document.createElement("input");
        input2.setAttribute("class", "redimInput");
        input2.setAttribute("type", "number");
        input2.setAttribute("disabled", "");
        contenu.appendChild(input2);
        input2.addEventListener("change", calculTotalLigne); //Calcul le total de la ligne après avoir rempli l'input "Quantité"

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        input.focus(); //Focus sur l'input suivant
    } else {
        tableau.lastChild.children[2].children[0].focus();
    }
}

function calculTotalLigne(e) { //  Calcul le total de la ligne (hors remise)
    var totalLigne = parseInt(e.target.parentNode.parentNode.children[4].innerHTML) * parseInt(e.target.parentNode.parentNode.children[5].children[0].value); //Update du total de la première ligne
    creerLigne(e);
    e.target.parentNode.parentNode.children[6].innerHTML = totalLigne;
    sousTotal();
}

function chargeInfoMail() { //Charge le mail de la personne selectionnée
    requ4.open('POST', './index.php?page=apiInfoMail', true);
    requ4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ4.send("nomClient=" + nomClient.value);
}

function afficheInfoMail(bool) { //Affiche l'adresse mail en hover sur l'image de l'enveloppe
    if (bool) {
        popupMail.style.display = "unset";
    } else {
        popupMail.style.display = "none";
    }
}

function supprLigne(e) { //Supprime la ligne
    var confirm = window.confirm("Voulez vraiment supprimer cette ligne ?")
    if (confirm) {
        var ligneSuppr = e.target.parentNode.parentNode;
        if (ligneSuppr.hasAttribute("remise")) {
            ligneSuppr.nextElementSibling.remove();
        }
        ligneSuppr.remove();
        creerLigne(e);
    }
    sousTotal();
}

function supprTableau(e) {
    var confirm = window.confirm("Voulez vraiment supprimer TOUTES les ventes ?") //Confirmation de suppression du tableau des ventes
    if (confirm) { //Supprime le tableau et recréé la première ligne
        var entete = tableau.children[0];
        tableau.innerHTML = "";
        tableau.appendChild(entete);


        var ligne = document.createElement("div");
        ligne.setAttribute("class", "ligne");
        tableau.appendChild(ligne);

        var btnSuppr = document.createElement("div");
        btnSuppr.setAttribute("class", "supprLigne");
        ligne.appendChild(btnSuppr)
        btnSuppr.addEventListener("click", supprLigne)

        var imgSuppr = document.createElement("img");
        imgSuppr.setAttribute("src", "./IMG/supprimer.png");
        btnSuppr.appendChild(imgSuppr);

        var btnRem = document.createElement("div");
        btnRem.setAttribute("class", "supprLigne");
        ligne.appendChild(btnRem)

        var imgRem = document.createElement("img");
        imgRem.setAttribute("src", "./IMG/remise.png");
        btnRem.appendChild(imgRem);


        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var input = document.createElement("input");
        input.setAttribute("class", "redimInput");
        contenu.appendChild(input);
        input.addEventListener("input", remplissageAuto);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        var input2 = document.createElement("input");
        input2.setAttribute("class", "redimInput");
        input2.setAttribute("type", "number");
        input2.setAttribute("disabled", "");
        contenu.appendChild(input2);
        input2.addEventListener("change", calculTotalLigne);

        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        input.focus(); //Focus sur l'input suivant
    }
    sousTotal();
}

function remiseLigne(e) { //Fonction de remise sur la ligne
    var remise = window.prompt("Remise en %"); //Demande de remise en %
    if (remise != null) {
        var ligneMere = e.target.parentNode.parentNode;
        if (ligneMere.hasAttribute("remise")) { //Check s'il y a déjà une remise active, si c'est le cas,  supprime la ligne puis en créé une nouvelle
            ligneMere.nextElementSibling.remove();
        }
        ligneMere.setAttribute("remise", "") //Ajout d'attribut personnalisé pour vérifier si une remise existe déjà

        var ligne = document.createElement("div"); // Création de la seconde ligne
        ligne.setAttribute("class", "ligneRemise");
        ligneMere.after(ligne);

        var uneCase = document.createElement("div"); // Création de la première case
        uneCase.setAttribute("class", "contenu");
        uneCase.innerHTML = "Remise : " + remise + "%";
        ligne.appendChild(uneCase);

        var uneCase = document.createElement("div");// Création de la seconde case
        uneCase.setAttribute("class", "contenu");
        montantRemise = parseInt((ligneMere.children[6].innerHTML) * parseInt(remise)) / 100;
        uneCase.innerHTML = "Montant de la remise : " + montantRemise + "€";
        ligne.appendChild(uneCase);

        var uneCase = document.createElement("div");// Création de la troisième case
        uneCase.setAttribute("class", "contenu");
        totRem = parseInt(ligneMere.children[6].innerHTML) - montantRemise;
        uneCase.innerHTML = "Total après Remise : " + totRem + "€"; 
        ligne.appendChild(uneCase);
    }
    sousTotal();
}

function remiseTotaleDuTicket(){
    var remiseT=prompt("Remise Totale en %");
    if(remiseT!=null && remiseT!=""){
        console.log(blocFinal.children[1].children[1])
        blocFinal.children[1].children[1].innerHTML=remiseT+"%";
    } else{
        blocFinal.children[1].children[1].innerHTML="0%";
    }
    sousTotal();
}

function sousTotal(){ 
    var totalLignes=tableau.getElementsByClassName("ligne"); // Récupération des lignes dans le tableau
    var somme=0;
    for (let i=1;i<totalLignes.length-1;i++){ //Boucle pour récupérer tout les total sauf l'entête et la ligne vide
        if(totalLignes[i].hasAttribute("remise")){ // On vérifie sir la ligne à l'attribut remise pour récupérer le total de la ligne remise
            var totalRemiseLigne=totalLignes[i].nextElementSibling.children[2].innerHTML.split(':');
            console.log(totalRemiseLigne);
            totalRemiseLigne = parseFloat(totalRemiseLigne[1].substring(0,totalRemiseLigne[1].length-1));
            somme+=totalRemiseLigne;//On ajoute le total
        }else{//On récupère le total s'il n'y a pas eu de remise
           somme+=parseFloat(totalLignes[i].children[6].innerHTML);
        }
    }
    blocFinal.children[0].children[1].innerHTML=somme+"€";
    totalFinal()
}

function totalFinal(){
    var sousTotal=parseFloat(blocFinal.children[0].children[1].innerHTML.substring(0,blocFinal.children[0].children[1].innerHTML.length-1))

    var remiseFinale=parseFloat(blocFinal.children[1].children[1].innerHTML.substring(0,blocFinal.children[1].children[1].innerHTML.length-1));

    var prixTotalFinal=sousTotal-(sousTotal*remiseFinale/100);

    blocFinal.children[3].children[1].innerHTML=prixTotalFinal+"€";
}










/*******************EVENTS*********************/
/*********LISTE DONNEES********/
if ($_GET["page"] == "ListeDonnees") {
    for (let i = 0; i < lesMenus.length; i++) {
        lesMenus[i].addEventListener("click", afficheSousMenu);
    }
    for (let i = 0; i < lesContenuSousMenu.length; i++) {
        lesContenuSousMenu[i].addEventListener("click", redirige);
    }
}
/*********LISTE ARTICLES********/
if ($_GET["page"] == "Liste" && $_GET["table"] == "Article") {
    rech.addEventListener("click", rechFiltre);
}
/*********LISTE CLIENTS********/
if ($_GET["page"] == "Liste" && $_GET["table"] == "Client") {
    for (let i = 1; i < lesClients.length; i++) {
        lesClients[i].addEventListener("click", function (e) {
            detailAchat(e);
        });
    }
}
/*********LISTE VENTES********/
if ($_GET["page"] == "ListeVentes") {
    rechVente[2].addEventListener("click", function (e) {
        filtreVente(e);
    })
}
/*********PASSAGE CAISSE********/
if ($_GET["page"] == "PassageCaisse") {

    infoPC[0].children[0].addEventListener("input", remplissageAuto);//Remplissange auto pour la première ligne après le remplissage de la ref

    infoPC[3].children[0].addEventListener("change", calculTotalLigne);//Calcul du total ligne de la première ligne après le remplissage de la quantité

    nomClient.addEventListener("input", chargeInfoMail)//Chargement du mail du client dans la div attribuée
    divEnv.addEventListener("mouseover", function () {
        afficheInfoMail(true);
    })//Affichage du mail du client selectionné
    divEnv.addEventListener("mouseout", function () {
        afficheInfoMail(false);
    })

    boutonsCaisse[3].addEventListener("click", supprTableau); //Event pour supprimer le tableau

    btnSuppr1.addEventListener("click", supprLigne); //Event de suppression de ligne

    btnRem1.addEventListener("click", remiseLigne) //Event de remise sur une ligne

    boutonsCaisse[4].addEventListener("click",remiseTotaleDuTicket); //Event de remise sur le tout
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
                uneCase.innerHTML = "<b>Taille : </b>" + reponse[i].idTaille;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE IDINCREMENTALE
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Ref incrementale : </b>" + reponse[i].idIncrementale;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE IDLOT
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Lot : </b>" + reponse[i].idLot;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE QUANTITE STOCK
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Quantité en stock : </b>" + reponse[i].quantiteStock;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE PRIX ACHAT
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Prix d'achat : </b>" + reponse[i].prixAchat;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE PRIX VENTE
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Prix de vente : </b>" + reponse[i].prixVente;
                ligneInv.appendChild(uneCase);
                // AFFICHAGE SEUIL
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu  marronFonce");
                uneCase.innerHTML = "<b>Seuil : </b>" + reponse[i].seuil;
                ligneInv.appendChild(uneCase);
            }
            var donnees = document.getElementsByClassName("donnees");
            for (let i = 0; i < donnees.length; i++) {
                donnees[i].addEventListener("click", afficheDetail)
            }
        } else {
            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
        }
    }
};
/*********LISTE CLIENTS********/
requ2.onreadystatechange = function (event) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log("Réponse reçue: %s", this.responseText);
            reponse = JSON.parse(this.responseText);
            console.log(reponse);
            tableauVente.innerHTML = "";
            tableauVente.appendChild(entete);
            for (let i = 0; i < reponse.length; i++) {
                // ON CREE UNE LIGNE
                ligne = document.createElement("div");
                ligne.setAttribute("class", "ligne");
                tableauVente.appendChild(ligne);
                // ON MET LES CASES PUIS ON LES INSERE DANS LA LIGNE
                // Date de la vente
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu");
                uneCase.innerHTML = reponse[i].date_vente;
                ligne.appendChild(uneCase);
                // On affiche le numéro de vente
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu");
                uneCase.innerHTML = reponse[i].idVente;
                ligne.appendChild(uneCase);
                // ON CREE LA CASES POUR ACCUEILLIR LES BOUTONS
                uneCase = document.createElement("div");
                uneCase.setAttribute("class", "contenu");
                ligne.appendChild(uneCase);
                // ON INSERE LES BOUTONS
                divBouton = document.createElement("div");
                divBouton.setAttribute("class", "miniBouton");
                uneCase.appendChild(divBouton);

                btn = document.createElement("button");
                divBouton.appendChild(btn);
                // On crée le bouton pour afficher le ticket de caisse
                lien = document.createElement("a");
                lien.setAttribute("href", "./Tickets/Ticket" + reponse[i].idVente);
                lien.setAttribute("target", "_blank");
                btn.appendChild(lien);

                image = document.createElement("img");
                image.setAttribute("src", "./IMG/voir.png");
                image.setAttribute("alt", "Voir Ticket");
                lien.appendChild(image);


            }
        }
    }
}

/*****PASSAGE CAISSE*****/

requ3.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log("Réponse reçue: %s", this.responseText);
            reponse = JSON.parse(this.responseText);
            console.log(reponse);
            target.parentNode.parentNode.children[3].innerHTML = reponse.libArticle;//Mise a jour du libellé de  l'article
            target.parentNode.parentNode.children[4].innerHTML = reponse.prixVente;//Mise a jour du prix
            target.parentNode.parentNode.children[5].children[0].removeAttribute("disabled", "");//On enable l'input de quantité 
            target.parentNode.parentNode.children[5].children[0].focus();//Mise en place de l'autofocus sur la quantité
        }
    }
}

requ4.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log("Réponse reçue: %s", this.responseText);
            reponse = JSON.parse(this.responseText);
            console.log(reponse);
            if (reponse.adresseMail != "") {
                popupMail.innerHTML = reponse.adresseMail;
            } else {
                popupMail.innerHTML = "Adresse mail non renseignée"
            }

            boutonsCaisse[2].children[0].setAttribute("href", "index.php?page=Form&table=client&mode=modif&id=" + reponse.idClient)
        }
    }
}