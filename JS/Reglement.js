const requ = new XMLHttpRequest();//Envoie info base de données
const requ2 = new XMLHttpRequest();//Envoi mail

/********************VARIABLES********************/
var ajout = document.getElementsByClassName("boutonCaisse")[0];
var supprTout = document.getElementsByClassName("boutonCaisse")[1];
var moyenPaiement = document.getElementById("moyenPaiement");
var tableau = document.getElementsByClassName("tableau")[0];
var resteDu = document.getElementById("resteDu");
var totalReglement = document.getElementById("totalReglement");
const coutTicket = parseFloat(resteDu.innerHTML.substring(0, resteDu.innerHTML.length - 1));
var payer = document.getElementsByClassName("payer")[0];
var idClient = document.getElementsByClassName("invisible")[1];
var idVente = document.getElementsByClassName("invisible")[0];

var checkEventPayer = false;

/**Modal Mail**/
var submitMail = document.getElementById("submitEnvoiMail");
var submitSansMail = document.getElementById("submitSansMail");

var modalEnvoiMail = document.getElementById("modalEnvoiMail");
var exitModalMail = document.getElementsByClassName("close")[0];
var inputMail = document.getElementById("inputMailClient");
var checkEventMail = false;

/**Premier input**/
var premLigne=document.getElementsByClassName("premierInput")[0];
var supprLignePrem=document.getElementsByClassName("supprLignePrem")[0];
/********************FONCTIONS********************/
function ajoutLigne() {
    idModePaiement = moyenPaiement.value;
    var ligne = document.createElement("div");
    ligne.setAttribute("class", "ligne");
    tableau.appendChild(ligne);

    var btnSuppr = document.createElement("div");
    btnSuppr.setAttribute("class", "supprLigne");
    ligne.appendChild(btnSuppr);

    var img = document.createElement("img");
    img.setAttribute("src", "./IMG/supprimer.png");
    btnSuppr.appendChild(img);
    btnSuppr.addEventListener("click", supprLigne);

    var contenu = document.createElement("div");
    contenu.setAttribute("class", "contenu");
    contenu.innerHTML = idModePaiement;
    ligne.appendChild(contenu);

    var contenu = document.createElement("div");
    contenu.setAttribute("class", "contenu");
    ligne.appendChild(contenu);

    var input = document.createElement("input");
    input.setAttribute("class", "inputLigne redimInput");
    input.setAttribute("pattern", "[0-9]+(\.[0-9][0-9]?)?");
    contenu.appendChild(input);
    input.addEventListener("input", check);

    var contenu = document.createElement("div");
    contenu.setAttribute("class", "contenu");
    contenu.innerHTML = moyenPaiement.options[moyenPaiement.selectedIndex].text;
    ligne.appendChild(contenu);

    var contenu = document.createElement("div");
    contenu.setAttribute("class", "contenu");
    ligne.appendChild(contenu);

    if (idModePaiement == "CH") {
        var inputCheque = document.createElement("input");
        inputCheque.setAttribute("class", "inputLigne redimInput");
        contenu.appendChild(inputCheque);
    }
    input.focus();
}

function check(e) {
    if (e.target.checkValidity()) {
        calcul();
    } else {
        resteDu.innerHTML = coutTicket;
        resteDu.innerHTML += "€";

        totalReglement.innerHTML = 0;
        totalReglement.innerHTML += "€";
    }
}

function calcul() {
    var inputs = document.getElementsByClassName("inputLigne");
    var somme = 0;
    for (let i = 0; i < inputs.length; i++) {
        // On vérifie si tous les inputs sont rempli correctement pour éviter le NaN dans les résultats resteDu et totalReglement
        if (isNaN(parseFloat(inputs[i].value))) {
            somme += 0;
        } else {
            somme += parseFloat(inputs[i].value);
        }
    }
    // calculs des résultats pour le reglement
    totalReglement.innerHTML = somme.toFixed(2);
    totalReglement.innerHTML += "€";

    resteDu.innerHTML = coutTicket - somme;
    if (resteDu.innerHTML == "0") {
        checkEventPayer = true;
        payer.addEventListener("click", affichePopupMail)
    } else {
        if (checkEventPayer == true) {
            payer.removeEventListener("click", affichePopupMail);
            checkEventPayer = false;
        }
    }
    resteDu.innerHTML += "€";
}

function supprLigne(e) {
    console
    var confirm = window.confirm("Voulez vraiment supprimer cette ligne ?");
    if (confirm) {
        if (e.target.tagName == "IMG") {
            var ligneSuppr = e.target.parentNode.parentNode;
        } else {
            var ligneSuppr = e.target.parentNode;
        }

        ligneSuppr.remove();
    }
    calcul();
}

function supprTableau() {
    var entete = tableau.children[0];
    tableau.innerHTML = "";
    tableau.appendChild(entete);
    calcul();
}

function recupLaMoula(e) {
    var lignesModePaiement = [];
    var cpt = 0;
    for (let i = 1; i < tableau.childElementCount; i++) {
        var ligne = tableau.children[i];
        var idModePaiement = ligne.children[1].innerHTML;
        var montant = ligne.children[2].children[0].value;
        lignesModePaiement[cpt] = [idModePaiement, montant];
        if (idModePaiement == "CH") {
            inputCheque = ligne.children[4].children[0];
            var banque = inputCheque.value;
            lignesModePaiement[cpt].push(banque);
        }
        cpt++;
    }
    var infoPaiement = {
        "idClient": idClient.value,
        "idVente": idVente.value,
        "tabModePaiement": lignesModePaiement
    }
    if (e.target.getAttribute("id") == "submitEnvoiMail") {
        envoyerMail();
    }
    infoPaiementJSON = JSON.stringify(infoPaiement);
    requ.open('POST', './index.php?page=apiPaiement', true);
    requ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ.send("paiement=" + infoPaiementJSON);
    setTimeout(function () { window.location.replace("index.php?page=PassageCaisse") }, 1000);
}

function envoyerMail() {
    requ2.open('POST', './index.php?page=apiEnvoiMail', true);
    requ2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ2.send("mail=" + inputMail.value + "&idVente=" + idVente.value + "&idClient=" + idClient.value);
    exitModal();
}

function affichePopupMail() {
    modalEnvoiMail.style.display = "block";
    if (inputMail.value != "") {
        if (inputMail.checkValidity()) {
            submitMail.addEventListener("click", recupLaMoula);
        }
    }
}

function exitModal() { // Fonction qui permet d'enlever le Popup
    modalEnvoiMail.style.display = "none";
}

function checkMail() {
    if (inputMail.checkValidity()) {
        checkEventMail = true;
        submitMail.addEventListener("click", recupLaMoula);
    } else {
        if (checkEventMail == true) {
            submitMail.removeEventListener("click", recupLaMoula);
            checkEventMail = false;
        }
    }
}
/********************EVENTS********************/
ajout.addEventListener("click", ajoutLigne);
supprTout.addEventListener("click", supprTableau);
submitSansMail.addEventListener("click", recupLaMoula);
exitModalMail.addEventListener("click", exitModal); // event pour fermer le Pop-up Remise ligne
inputMail.addEventListener("input", checkMail);
premLigne.addEventListener("input", check); //On ajoute une ligne par défaut avec en input le prix total déjà rempli et CB en mode de paiement
payer.addEventListener("click", affichePopupMail);
supprLignePrem.addEventListener("click",supprLigne);

calcul();//On lance la fonction dès le démarrage pour mettre à zéro le reste dû vu qu'on démarre avec une ligne remplie par défaut

requ2.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log(this.responseText);
            reponse=JSON_parse(this.responseText);
            console.log(reponse);
        }
    }
}