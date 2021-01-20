const requ3 = new XMLHttpRequest();//API Passage Caisse
const requ4 = new XMLHttpRequest();//API Recup mail client
/*********LES VARIABLES PASSAGE A LA CAISSE********/

var boutonsCaisse = document.getElementsByClassName("boutonCaisse");
var infoPC = document.getElementsByClassName("contenu");
var target = "";
var tableau = document.getElementsByClassName("tableau")[0];
var nomClient = document.getElementById("clientCaisse");
var popupMail = document.getElementsByClassName("absoluteMail")[0];
var divEnv = document.getElementById("mailClient");
var btnSuppr1 = document.getElementsByClassName("supprLigne")[2];
var btnRem1 = document.getElementsByClassName("supprLigne")[3];
var blocFinal = document.getElementsByClassName("blocCaissePrix")[0];
var divRemise = document.getElementById("remise");
var regExpQuantite = new RegExp(/^[0-9]+$/);
var regExpRemise = new RegExp(/^[0-9]+$/);


////////////Modal Remise Ligne
var modalRemiseLigne = document.getElementById("modalRemiseLigne");
var exitRemiseLigne = document.getElementsByClassName("close")[0];
//Champs des modal
var inputRemiseLigne = document.getElementById("inputRemiseLigne");
var typeRemiseLigne = document.getElementById("selectTypeRemise");
var refRemiseLigne = document.getElementById("referenceRemiseLigne");
var totRemLigne = document.getElementById("prixTotalRemiseLigne");
var montantRemiseLigne = document.getElementById("montantRemiseLigne");
var prixApresRemise = document.getElementById("prixTotalApresRemiseLigne");
var subRemLigne = document.getElementById("submitRemiseLigne");
var ligneMereRemiseLigne = "";

////////////Modal Remise Totale
var modalRemiseTotale = document.getElementById("modalRemiseTotale");
var exitRemiseTotale = document.getElementsByClassName("close")[1];
//Champs des modal
var inputRemiseTotale = document.getElementById("inputRemiseTotale");
var typeRemiseTotale = document.getElementById("selectTypeRemiseTotale");
var subRemTotale = document.getElementById("submitRemiseTotale");
var montantRemiseTotale = document.getElementById("montantRemiseTotale");
var prixApresRemiseTotale = document.getElementById("prixTotalApresRemiseTotale");
/********* FUNCTIONS ********/

function remplissageAuto(e) {
    target = e.target;
    if (target.value.length == 12) {
        var refPC = e.target.value.toUpperCase(); //On récupère la référence de l'article
        requ3.open('POST', './index.php?page=apiPassageCaisse', true);
        requ3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        requ3.send("refPC=" + refPC);
    }
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
        btnRem.addEventListener("click", affichePopup); //Event listener pour remiser la ligne

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
    var quantiteInput = e.target.parentNode.parentNode.children[5].children[0].value;
    if (regExpQuantite.test(quantiteInput)) // on vérifie si la quantité saise est un nombre ou chiffre.
    {
        var totalLigne = parseFloat(e.target.parentNode.parentNode.children[4].innerHTML) * parseFloat(quantiteInput); //Update du total de la première ligne
        creerLigne(e);
        e.target.parentNode.parentNode.children[6].innerHTML = totalLigne;
        sousTotal();
    }
    if (e.target.parentNode.parentNode.children[6].innerHTML != "") // Ce if sert a garder en mémoire la quantité saisie avant (si la quantité a été supprimée)
    {
        quantiteInput = parseFloat(e.target.parentNode.parentNode.children[6].innerHTML) / parseFloat(e.target.parentNode.parentNode.children[4].innerHTML)
    }
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
        console.log(e.target.tagName);
        if (e.target.tagName == "IMG") {
            var ligneSuppr = e.target.parentNode.parentNode;
        } else {
            var ligneSuppr = e.target.parentNode;
        }

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
        remise.innerHTML = "0%";
    }
    sousTotal();
}
/******************************  MODAL REMISE LIGNE **************************************** */
function exitModalLigne() { // Fonction qui permet d'enelver le Popup
    modalRemiseLigne.style.display = "none";
}

function execModalLigne() { // permet d'executer la remise et d'ajouter la ligne en dessous de l'article concerné
    var type = typeRemiseLigne.value;
    if (ligneMereRemiseLigne.hasAttribute("remise")) { //Check s'il y a déjà une remise active, si c'est le cas,  supprime la ligne puis en créé une nouvelle
        ligneMereRemiseLigne.nextElementSibling.remove();
    }
    ligneMereRemiseLigne.setAttribute("remise", "") //Ajout d'attribut personnalisé pour vérifier si une remise existe déjà

    var ligne = document.createElement("div"); // Création de la seconde ligne
    ligne.setAttribute("class", "ligneRemise");
    ligneMereRemiseLigne.after(ligne);

    var btnSuppr = document.createElement("div");
    btnSuppr.setAttribute("class", "supprLigne");
    ligne.appendChild(btnSuppr)
    btnSuppr.addEventListener("click", supprRemise)//Event pour supprimer la ligne

    var imgSuppr = document.createElement("img");
    imgSuppr.setAttribute("src", "./IMG/supprimer.png");
    btnSuppr.appendChild(imgSuppr);

    var uneCase = document.createElement("div"); // Création de la case ref remise
    uneCase.setAttribute("class", "contenu");
    uneCase.innerHTML = "Ref. de la remise : ZZZXX0000010"
    ligne.appendChild(uneCase);



    var uneCase = document.createElement("div"); // Création de la première case
    uneCase.setAttribute("class", "contenu");
    uneCase.innerHTML = "Remise : " + inputRemiseLigne.value
    if (type == "euro") {
        uneCase.innerHTML += "€";
    } else {
        uneCase.innerHTML += "%";
    }
    ligne.appendChild(uneCase);

    var uneCase = document.createElement("div");// Création de la seconde case
    uneCase.setAttribute("class", "contenu");
    uneCase.innerHTML = "Montant de la remise : " + montantRemiseLigne.innerHTML;
    ligne.appendChild(uneCase);

    var uneCase = document.createElement("div");// Création de la troisième case
    uneCase.setAttribute("class", "contenu");
    uneCase.innerHTML = "Total après Remise : " + prixApresRemise.innerHTML;
    ligne.appendChild(uneCase);

    // On remet a zéro de tous les inputs du PopUp Remise ligne
    inputRemiseLigne.value = "";
    refRemiseLigne.innerHTML = "";
    totRemLigne.innerHTML = "";
    prixApresRemise.innerHTML = "";
    montantRemiseLigne.innerHTML = "";

    exitModalLigne();
    subRemLigne.removeEventListener("click", execModalLigne)
    sousTotal();
}

function remiseLigne(e) {
    // On prépare le popup et on calcul on fonction de l'unité de remise
    var totalLigne = parseFloat(ligneMereRemiseLigne.children[6].innerHTML);
    if (regExpRemise.test(inputRemiseLigne)) {
        var remiseLigne = parseFloat(inputRemiseLigne.value);
        var type = typeRemiseLigne.value;
        refRemiseLigne.innerHTML = "ZZZXX0000010";
        totRemLigne.innerHTML = totalLigne;
        if (inputRemiseLigne.value != "") {
            if (type == "euro") {
                montantRemiseLigne.innerHTML = remiseLigne + "€";
                prixApresRemise.innerHTML = totalLigne - remiseLigne;
                prixApresRemise.innerHTML += "€";
            } else {
                montantRemiseLigne.innerHTML = totalLigne * remiseLigne / 100;
                montantRemiseLigne.innerHTML += "€";
                prixApresRemise.innerHTML = totalLigne - parseFloat(montantRemiseLigne.innerHTML);
                prixApresRemise.innerHTML += "€";
            }
            subRemLigne.addEventListener("click", execModalLigne)
        }
    }
}
// On affiche le popup
function affichePopup(e) { //Fonction de remise sur la ligne
    ligneMereRemiseLigne = e.target.parentNode.parentNode;
    var totalLigne = ligneMereRemiseLigne.children[6].innerHTML;
    if (totalLigne != "") {
        modalRemiseLigne.style.display = "block";
    }
}
/***************************  FIN MODAL REMISE LIGNE  ************************************* */
/******************************  MODAL REMISE  TOTALE **************************************** */
function exitModalTotale() { // Fonction qui permet d'enlever le Popup
    modalRemiseTotale.style.display = "none";
}

function remiseTotaleDuTicket() {
    modalRemiseTotale.style.display = "block";
    sousTotal();
}


function sendRemiseTotale()
{
    var remiseTotale = inputRemiseTotale.value;
    var typeRemise = typeRemiseTotale.value;
    if (remiseTotale != "")
    {
        blocFinal.children[3].children[1].innerHTML = prixApresRemiseTotale.innerHTML
        if (typeRemise == "pourcentage")
        {
            blocFinal.children[1].children[1].innerHTML = remiseTotale;
            blocFinal.children[1].children[1].innerHTML += "%"
        } else {
            blocFinal.children[1].children[1].innerHTML = remiseTotale;
            blocFinal.children[1].children[1].innerHTML += "€"
        }
        inputRemiseTotale.value = "";
        montantRemiseTotale.innerHTML = "";
        prixApresRemiseTotale.innerHTML = "";
        exitModalTotale();
    }
}

function remiseTotale()
{
    var remiseTotale = inputRemiseTotale.value;
    var typeRemise = typeRemiseTotale.value;
    if (typeRemise == "euro")
    {
        montantRemiseTotale.innerHTML = remiseTotale +"€"
    } else {
        console.log(blocFinal.children[3].children[1].innerHTML.substring(0,blocFinal.children[3].children[1].innerHTML.length-1));
        montantRemiseTotale.innerHTML = parseFloat(blocFinal.children[3].children[1].innerHTML.substring(0,blocFinal.children[3].children[1].innerHTML.length-1))*parseFloat(remiseTotale)/100;
        montantRemiseTotale.innerHTML += "€"
    }
    prixApresRemiseTotale.innerHTML = parseFloat(blocFinal.children[0].children[1].innerHTML.substring(0,blocFinal.children[0].children[1].innerHTML.length-1)) - parseFloat(montantRemiseTotale.innerHTML.substring(0,montantRemiseTotale.innerHTML.length-1))
    prixApresRemiseTotale.innerHTML += "€"

}
/***************************  FIN MODAL REMISE TOTALE  ************************************* */
function supprRemise(e) {
    var confirm = window.confirm("Voulez vraiment supprimer cette ligne ?")
    if (confirm) {
        var ligneSuppr = e.target.parentNode.parentNode;
        ligneSuppr.previousElementSibling.removeAttribute("remise");
        ligneSuppr.remove();
    }
    sousTotal();
}



function sousTotal() {
    var totalLignes = tableau.getElementsByClassName("ligne"); // Récupération des lignes dans le tableau
    var somme = 0;
    for (let i = 1; i < totalLignes.length - 1; i++) { //Boucle pour récupérer tout les total sauf l'entête et la ligne vide
        if (totalLignes[i].hasAttribute("remise")) { // On vérifie sir la ligne à l'attribut remise pour récupérer le total de la ligne remise
            var totalRemiseLigne = totalLignes[i].nextElementSibling.children[4].innerHTML.split(':');
            totalRemiseLigne = parseFloat(totalRemiseLigne[1].substring(0, totalRemiseLigne[1].length - 1));
            somme += totalRemiseLigne;//On ajoute le total
        } else {//On récupère le total s'il n'y a pas eu de remise
            somme += parseFloat(totalLignes[i].children[6].innerHTML);
        }
    }
    blocFinal.children[0].children[1].innerHTML = somme + "€";
    totalFinal()
}

function totalFinal() {
    var sousTotal = parseFloat(blocFinal.children[0].children[1].innerHTML.substring(0, blocFinal.children[0].children[1].innerHTML.length - 1))

    var remiseFinale = parseFloat(blocFinal.children[1].children[1].innerHTML.substring(0, blocFinal.children[1].children[1].innerHTML.length - 1));

    var prixTotalFinal = sousTotal - (sousTotal * remiseFinale / 100);

    blocFinal.children[3].children[1].innerHTML = prixTotalFinal + "€";
}

/********* EVENT LISTENERS ********/

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

btnRem1.addEventListener("click", affichePopup) //Event de remise sur une ligne

boutonsCaisse[4].addEventListener("click", remiseTotaleDuTicket); //Event de remise sur le tout

/// MODAL REMISE LIGNE
exitRemiseLigne.addEventListener("click", exitModalLigne) // event pour fermer le Pop-up Remise ligne

inputRemiseLigne.addEventListener("input", remiseLigne); // event pour l'input de la remise pour mettre a jour le pop-up Remise ligne

typeRemiseLigne.addEventListener("input", remiseLigne); // event pour le select du type de la remise pour mettre a jour le pop-up Remise ligne

/// MODAL REMISE TOTALE
exitRemiseTotale.addEventListener("click", exitModalTotale) // event pour fermer le Pop-up Remise Totale

subRemTotale.addEventListener("click", sendRemiseTotale) // On envoie les infos pour effectuer la remise totale

inputRemiseTotale.addEventListener("input", remiseTotale); // event pour l'input de la remise pour mettre a jour le pop-up Remise Totale

typeRemiseTotale.addEventListener("input", remiseTotale); // event pour le select du type de la remise pour mettre a jour le pop-up Remise ligne





/***** APPELS AUX APIS*****/

requ3.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log("Réponse reçue: %s", this.responseText);
            reponse = JSON.parse(this.responseText);
            console.log(reponse);
            if (reponse == false) {
                alert("Article inexistant ! ");
            } else {
                target.parentNode.parentNode.children[3].innerHTML = reponse.libArticle;//Mise a jour du libellé de  l'article
                target.parentNode.parentNode.children[4].innerHTML = reponse.prixVente;//Mise a jour du prix
                target.parentNode.parentNode.children[5].children[0].removeAttribute("disabled", "");//On enable l'input de quantité 
                target.parentNode.parentNode.children[5].children[0].focus();//Mise en place de l'autofocus sur la quantité
            }

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