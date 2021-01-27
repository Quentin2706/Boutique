const requ3 = new XMLHttpRequest();//API Passage Caisse
const requ4 = new XMLHttpRequest();//API Recup mail client
const requ5 = new XMLHttpRequest();//API Envoi des infos vers reglement
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
var regExpRemiseEuro = new RegExp(/^[0-9]+(\.[0-9][0-9]?)?$/);
var regExpRemisePourcentage = new RegExp(/^[0-9]{1,2}$/);

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
var prixAvantRemiseTotale = document.getElementById("prixTotalAvantRemiseTotale");
var prixApresRemiseTotale = document.getElementById("prixTotalApresRemiseTotale");

////// PAIEMENTS
var paiement = document.getElementById("paiement");

///////Gestion des ventes en cours
var urlCourante = document.location.href; 
if(urlCourante.includes("idVente")){
    sousTotal();
    var idVente=urlCourante.substring(urlCourante.indexOf("idVente")).split("=")[1];
}

/********* FUNCTIONS ********/

function remplissageAuto(e) {
    target = e.target;
    if (target.value.length == 12) {
        e.target.setAttribute("disabled", "");
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
        ligne.appendChild(btnSuppr);
        btnSuppr.addEventListener("click", supprLigne); //Event pour supprimer la ligne

        var imgSuppr = document.createElement("img");
        imgSuppr.setAttribute("src", "./IMG/supprimer.png");
        btnSuppr.appendChild(imgSuppr);

        var btnRem = document.createElement("div");
        btnRem.setAttribute("class", "supprLigne");
        ligne.appendChild(btnRem);
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

        //Case invisible du stock de l'article
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
        //Gestion Stock : on regarde si il reste assez de stock pour la ligne du ticket 
        if(parseInt(e.target.parentNode.parentNode.children[7].innerHTML)>=quantiteInput){
            var totalLigne = parseFloat(e.target.parentNode.parentNode.children[4].innerHTML) * parseFloat(quantiteInput); //Update du total de la première ligne
            creerLigne(e);
            e.target.parentNode.parentNode.children[6].innerHTML = totalLigne;
            sousTotal();
        }else{
            e.target.parentNode.parentNode.children[5].children[0].value=0;
            e.target.parentNode.parentNode.children[6].innerHTML=0;
            sousTotal();
            alert("Pas assez de produit en stock");
        }

        
    }
    if (e.target.parentNode.parentNode.children[6].innerHTML != "") // Ce if sert a garder en mémoire la quantité saisie avant (si la quantité a été supprimée)
    {
        quantiteInput = parseFloat(e.target.parentNode.parentNode.children[6].innerHTML) / parseFloat(e.target.parentNode.parentNode.children[4].innerHTML);
    }
}

function chargeInfoMail() { //Charge le mail de la personne selectionnée
    requ4.open('POST', './index.php?page=apiInfoMail', true);
    requ4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ4.send("nomClient=" + nomClient.value);

}

// function surchargeReglement(){
//     paiement.parentNode.setAttribute("href","index.php?page=Reglement&idClient="+nomClient.value)
// }

function afficheInfoMail(bool) { //Affiche l'adresse mail en hover sur l'image de l'enveloppe
    if (bool) {
        popupMail.style.display = "unset";
    } else {
        popupMail.style.display = "none";
    }
}

function supprLigne(e) { //Supprime la ligne
    var confirm = window.confirm("Voulez vraiment supprimer cette ligne ?");
    if (confirm) {
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
    var confirm = window.confirm("Voulez vraiment supprimer TOUTES les ventes ?"); //Confirmation de suppression du tableau des ventes
    if (confirm) { //Supprime le tableau et recréé la première ligne
        var entete = tableau.children[0];
        tableau.innerHTML = "";
        tableau.appendChild(entete);


        var ligne = document.createElement("div");
        ligne.setAttribute("class", "ligne");
        tableau.appendChild(ligne);

        var btnSuppr = document.createElement("div");
        btnSuppr.setAttribute("class", "supprLigne");
        ligne.appendChild(btnSuppr);
        btnSuppr.addEventListener("click", supprLigne);

        var imgSuppr = document.createElement("img");
        imgSuppr.setAttribute("src", "./IMG/supprimer.png");
        btnSuppr.appendChild(imgSuppr);

        var btnRem = document.createElement("div");
        btnRem.setAttribute("class", "supprLigne");
        ligne.appendChild(btnRem);

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

        //Case invisible du stock de l'article
        var contenu = document.createElement("div");
        contenu.setAttribute("class", "contenu");
        ligne.appendChild(contenu);

        input.focus(); //Focus sur l'input suivant
        remise.innerHTML = "0%";
    }
    sousTotal();
}
/******************************  MODAL REMISE LIGNE **************************************** */
function exitModalLigne() { // Fonction qui permet d'enlever le Popup
    modalRemiseLigne.style.display = "none";
    // On remet a zéro de tous les inputs du PopUp Remise ligne
    inputRemiseLigne.value = "";
    refRemiseLigne.innerHTML = "";
    totRemLigne.innerHTML = "";
    prixApresRemise.innerHTML = "";
    montantRemiseLigne.innerHTML = "";
    inputRemiseLigne.setAttribute("class","");
}

function execModalLigne() { // permet d'executer la remise et d'ajouter la ligne en dessous de l'article concerné
    var type = typeRemiseLigne.value;
    if (ligneMereRemiseLigne.hasAttribute("remise")) { //Check s'il y a déjà une remise active, si c'est le cas,  supprime la ligne puis en créé une nouvelle
        ligneMereRemiseLigne.nextElementSibling.remove();
    }
    ligneMereRemiseLigne.setAttribute("remise", ""); //Ajout d'attribut personnalisé pour vérifier si une remise existe déjà

    var ligne = document.createElement("div"); // Création de la seconde ligne
    ligne.setAttribute("class", "ligneRemise");
    ligneMereRemiseLigne.after(ligne);

    var btnSuppr = document.createElement("div");
    btnSuppr.setAttribute("class", "supprLigne");
    ligne.appendChild(btnSuppr);
    btnSuppr.addEventListener("click", supprRemise); //Event pour supprimer la ligne

    var imgSuppr = document.createElement("img");
    imgSuppr.setAttribute("src", "./IMG/supprimer.png");
    btnSuppr.appendChild(imgSuppr);

    var uneCase = document.createElement("div"); // Création de la case ref remise
    uneCase.setAttribute("class", "contenu");
    uneCase.innerHTML = "Ref. de la remise : ZZZXX0000010";
    ligne.appendChild(uneCase);



    var uneCase = document.createElement("div"); // Création de la première case
    uneCase.setAttribute("class", "contenu");
    uneCase.innerHTML = "Remise : " + inputRemiseLigne.value;
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
    subRemLigne.removeEventListener("click", execModalLigne);
    sousTotal();
}

function remiseLigne(e) {
    // On prépare le popup et on calcul en fonction de l'unité de remise
    var totalLigne = parseFloat(ligneMereRemiseLigne.children[6].innerHTML);
    var type = typeRemiseLigne.value;
    if (type == "euro") {
        reg = regExpRemiseEuro;
    } else {
        reg = regExpRemisePourcentage;
    }
    if(reg.test(inputRemiseLigne.value)) {
        inputRemiseLigne.setAttribute("class","");
        var remiseLigne = parseFloat(inputRemiseLigne.value).toFixed(2);
        refRemiseLigne.innerHTML = "ZZZXX0000010";
        totRemLigne.innerHTML = totalLigne;
        if (type == "euro") {
            montantRemiseLigne.innerHTML = remiseLigne + "€";
            prixApresRemise.innerHTML = totalLigne - remiseLigne;
            prixApresRemise.innerHTML += "€";
        } else {
            montantRemiseLigne.innerHTML = (totalLigne * remiseLigne / 100).toFixed(2);
            montantRemiseLigne.innerHTML += "€";
            prixApresRemise.innerHTML = (totalLigne - parseFloat(montantRemiseLigne.innerHTML)).toFixed(2);
            prixApresRemise.innerHTML += "€";
        }
        subRemLigne.addEventListener("click", execModalLigne);
        // Vérifie si le montant de la remise en € est bien inférieur au total de la ligne si oui, on ne permet pas le click
        if(remiseLigne>totalLigne && type=="euro"){
            subRemLigne.removeEventListener("click", execModalLigne);
            inputRemiseLigne.setAttribute("class","erreur"); //Affichage erreur
        }
    }else{
        montantRemiseLigne.innerHTML="";
        prixApresRemise.innerHTML="";
        subRemLigne.removeEventListener("click", execModalLigne);
        // Gestion affichage d'erreur si l'input vide on affiche pas d'erreur
        if(inputRemiseLigne.value==""){
            inputRemiseLigne.setAttribute("class","");
        }else{
            inputRemiseLigne.setAttribute("class","erreur");
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
    inputRemiseTotale.value = "";
    inputRemiseTotale.setAttribute("class","");
    montantRemiseTotale.innerHTML = "";
    prixAvantRemiseTotale.innerHTML="";
    prixApresRemiseTotale.innerHTML = "";
}

function remiseTotaleDuTicket() {
    modalRemiseTotale.style.display = "block";
}


function sendRemiseTotale() {
    var remiseTotale = inputRemiseTotale.value;
    var typeRemise = typeRemiseTotale.value;
    if (remiseTotale != "") {
        blocFinal.children[3].children[2].innerHTML = prixApresRemiseTotale.innerHTML;
        if (typeRemise == "pourcentage") {
            blocFinal.children[1].children[2].innerHTML = remiseTotale;
            blocFinal.children[1].children[2].innerHTML += "%";
        } else {
            blocFinal.children[1].children[2].innerHTML = remiseTotale;
            blocFinal.children[1].children[2].innerHTML += "€";
        }
        inputRemiseTotale.value = "";
        montantRemiseTotale.innerHTML = "";
        prixAvantRemiseTotale.innerHTML="";
        prixApresRemiseTotale.innerHTML = "";
        exitModalTotale();
    }
}

function remiseTotale() {
    var remiseTotale = inputRemiseTotale.value;
    var typeRemise = typeRemiseTotale.value;
    prixAvantRemiseTotale.innerHTML=parseFloat(blocFinal.children[0].children[2].innerHTML).toFixed(2);
    if (typeRemise == "euro") {
        reg = regExpRemiseEuro;
    } else {
        reg = regExpRemisePourcentage;
    }
    if (reg.test(inputRemiseTotale.value)) {
        inputRemiseTotale.setAttribute("class","");
        if (typeRemise == "euro") {
            montantRemiseTotale.innerHTML = remiseTotale + "€";
        } else {
            montantRemiseTotale.innerHTML = (parseFloat(blocFinal.children[0].children[2].innerHTML.substring(0, blocFinal.children[0].children[2].innerHTML.length - 1)) * parseFloat(remiseTotale) / 100).toFixed(2);
            montantRemiseTotale.innerHTML += "€";
        }
        prixApresRemiseTotale.innerHTML = (parseFloat(blocFinal.children[0].children[2].innerHTML.substring(0, blocFinal.children[0].children[2].innerHTML.length - 1)) - parseFloat(montantRemiseTotale.innerHTML.substring(0, montantRemiseTotale.innerHTML.length - 1))).toFixed(2);
        prixApresRemiseTotale.innerHTML += "€";
        subRemTotale.addEventListener("click", sendRemiseTotale);// On envoie les infos pour effectuer la remise totale
        if(parseFloat(remiseTotale)>parseFloat(prixAvantRemiseTotale.innerHTML) && typeRemise=="euro"){
            subRemTotale.removeEventListener("click", sendRemiseTotale);
            inputRemiseTotale.setAttribute("class","erreur");
        }
    } else {
        montantRemiseTotale.innerHTML = "";
        prixApresRemiseTotale.innerHTML = "";
        prixAvantRemiseTotale.innerHTML="";
        subRemTotale.removeEventListener("click", sendRemiseTotale);
         // Gestion affichage d'erreur si l'input vide on affiche pas d'erreur
        if(inputRemiseTotale.value==""){
            inputRemiseTotale.setAttribute("class","");
        }else{
            inputRemiseTotale.setAttribute("class","erreur");
        }
    }

}
/***************************  FIN MODAL REMISE TOTALE  ************************************* */
function supprRemise(e) {
    var confirm = window.confirm("Voulez vraiment supprimer cette ligne ?");
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
    blocFinal.children[0].children[2].innerHTML = somme + "€";
    totalFinal();
}

function totalFinal() {
    var sousTotal = parseFloat(blocFinal.children[0].children[2].innerHTML.substring(0, blocFinal.children[0].children[2].innerHTML.length - 1));
    var remiseFinale = parseFloat(blocFinal.children[1].children[2].innerHTML.substring(0, blocFinal.children[1].children[2].innerHTML.length - 1));
    if (blocFinal.children[1].children[2].innerHTML.substring(blocFinal.children[1].children[2].innerHTML.length - 1) == "€") {
        var prixTotalFinal = (sousTotal - remiseFinale).toFixed(2);
    } else {
        var prixTotalFinal = (sousTotal - (sousTotal * remiseFinale / 100)).toFixed(2);
    }


    blocFinal.children[3].children[2].innerHTML = prixTotalFinal + "€";
}

function envoiVersReglement()
{
    // On créer une boucle pour récuperer toutes les lignes du tickets autrement dit la liste d'achats
    var lignesTicket = [];
    var cpt = 0;    
    for (let i = 1; i<tableau.childElementCount-1; i++)
    {   
        var ligne = tableau.children[i];
        // on recupe que les lignes PAS les REMISES
        if(ligne.getAttribute("class") == "ligne")
        {
            var reference = ligne.children[2].children[0].value;
            var quantite = ligne.children[5].children[0].value;
            lignesTicket[cpt] = [reference, quantite];
            if(ligne.hasAttribute("remise"))
            {
                var remise = ligne.nextElementSibling.children[3].innerHTML;
                var temp = remise.split(":");
                tempdeux = temp[1].substring(1, temp[1].length-1);
                lignesTicket[cpt].push(tempdeux);
            }
            cpt++; 
        }
    }

    var infos = {
        "idClient" : nomClient.value,
        "lignesTicket" : lignesTicket,
        "sousTotal" : blocFinal.children[0].children[2].innerHTML,
        "remise" : blocFinal.children[1].children[2].innerHTML,
        "total" : blocFinal.children[3].children[2].innerHTML
    }
    infostest = JSON.stringify(infos);
    requ5.open('POST', './index.php?page=apiEnvoiInfoReglement', true);
    requ5.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //On regarde si la vente était une vente en attente
    if(urlCourante.includes("idVente")){
        requ5.send("infos="+infostest+"&idVente="+idVente);
    }else{
        requ5.send("infos="+infostest);
    }
   
    setTimeout(function(){window.location.replace("index.php?page=Reglement&idClient="+infos["idClient"]+"&total="+infos["total"])},1000);
}   

/********* EVENT LISTENERS ********/

infoPC[0].children[0].addEventListener("input", remplissageAuto);//Remplissange auto pour la première ligne après le remplissage de la ref

infoPC[3].children[0].addEventListener("change", calculTotalLigne);//Calcul du total ligne de la première ligne après le remplissage de la quantité

nomClient.addEventListener("input", chargeInfoMail)//Chargement du mail du client dans la div attribuée
// nomClient.addEventListener("input", surchargeReglement)
divEnv.addEventListener("mouseover", function () {
    afficheInfoMail(true);
})//Affichage du mail du client selectionné
divEnv.addEventListener("mouseout", function () {
    afficheInfoMail(false);
})

boutonsCaisse[3].addEventListener("click", supprTableau); //Event pour supprimer le tableau

btnSuppr1.addEventListener("click", supprLigne); //Event de suppression de ligne

btnRem1.addEventListener("click", affichePopup); //Event de remise sur une ligne

boutonsCaisse[4].addEventListener("click", remiseTotaleDuTicket); //Event de remise sur le tout

/// MODAL REMISE LIGNE
exitRemiseLigne.addEventListener("click", exitModalLigne); // event pour fermer le Pop-up Remise ligne

inputRemiseLigne.addEventListener("input", remiseLigne); // event pour l'input de la remise pour mettre a jour le pop-up Remise ligne

typeRemiseLigne.addEventListener("input", remiseLigne); // event pour le select du type de la remise pour mettre a jour le pop-up Remise ligne

/// MODAL REMISE TOTALE
exitRemiseTotale.addEventListener("click", exitModalTotale); // event pour fermer le Pop-up Remise Totale

inputRemiseTotale.addEventListener("input", remiseTotale); // event pour l'input de la remise pour mettre a jour le pop-up Remise Totale

typeRemiseTotale.addEventListener("input", remiseTotale); // event pour le select du type de la remise pour mettre a jour le pop-up Remise ligne


//// PAIEMENTS
paiement.addEventListener("click", envoiVersReglement);




/***** APPELS AUX APIS*****/

requ3.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            reponse = JSON.parse(this.responseText);
            if (reponse == false) {
                alert("Article inexistant ! ");
            } else {
                target.parentNode.parentNode.children[3].innerHTML = reponse.libArticle;//Mise a jour du libellé de  l'article
                target.parentNode.parentNode.children[4].innerHTML = reponse.prixVente;//Mise a jour du prix
                target.parentNode.parentNode.children[5].children[0].removeAttribute("disabled", "");//On enable l'input de quantité 
                target.parentNode.parentNode.children[7].innerHTML=reponse.quantiteStock;//On indique la quantité en stock disponible 
                target.parentNode.parentNode.children[5].children[0].focus();//Mise en place de l'autofocus sur la quantité
            }

        }
    }
}

requ4.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            reponse = JSON.parse(this.responseText);
            if (reponse.adresseMail != "") {
                popupMail.innerHTML = reponse.adresseMail;
            } else {
                popupMail.innerHTML = "Adresse mail non renseignée";
            }
            // on vérifie si le client sélectionné n'est pas le client non renseigné (id 1), pour éviter l'envoi vers le formulaire de celui ci
            if (reponse.idClient != 1)
            {
            boutonsCaisse[2].children[0].setAttribute("href", "index.php?page=Form&table=client&mode=modif&id=" + reponse.idClient);
            } else {
            boutonsCaisse[2].children[0].setAttribute("href", "");
            }
        }
    }
}


// requ5.onreadystatechange = function (e) {
//     // XMLHttpRequest.DONE === 4
//     if (this.readyState === XMLHttpRequest.DONE) {
//         if (this.status === 200) {
//             console.log(this.responseText);
// }
//     }
// }