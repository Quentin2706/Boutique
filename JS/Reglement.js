const requ = new XMLHttpRequest();
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
    input.setAttribute("pattern", "[0-9]{1,}");
    contenu.appendChild(input);
    input.addEventListener("input", check);

    var contenu = document.createElement("div")
    contenu.setAttribute("class", "contenu")
    contenu.innerHTML = moyenPaiement.options[moyenPaiement.selectedIndex].text;
    ligne.appendChild(contenu);

    var contenu = document.createElement("div")
    contenu.setAttribute("class", "contenu")
    ligne.appendChild(contenu);

    if(idModePaiement == "CH")
    {
    var inputCheque = document.createElement("input");
    inputCheque.setAttribute("class", "inputLigne redimInput");
    contenu.appendChild(inputCheque);
    //inputCheque.addEventListener("input", );
    }

    input.focus();
}

function check(e) {
    if (e.target.checkValidity()) {
        calcul();
    } else {
        resteDu.innerHTML = coutTicket
        resteDu.innerHTML += "€";

        totalReglement.innerHTML = 0
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
    totalReglement.innerHTML = somme
    totalReglement.innerHTML += "€";

    resteDu.innerHTML = coutTicket - somme;
    resteDu.innerHTML += "€";
}

function supprLigne(e)
{
    var confirm = window.confirm("Voulez vraiment supprimer cette ligne ?")
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

function supprTableau()
{
    var entete = tableau.children[0];
    tableau.innerHTML=""
    tableau.appendChild(entete);
    calcul();
}

function recupLaMoula()
{
    var lignesModePaiement = [];
    var cpt = 0;    
    for (let i = 1; i<tableau.childElementCount; i++)
    {   
        var ligne = tableau.children[i];
        var idModePaiement = ligne.children[1].innerHTML;
        var montant = ligne.children[2].children[0].value;
        lignesModePaiement[cpt] = [idModePaiement, montant];
        if (idModePaiement == "CH")
        {
            inputCheque = ligne.children[4].children[0]
            var banque = inputCheque.value;
            lignesModePaiement[cpt].push(banque);
        }
        cpt++;
    }
    var infoPaiement = {
        "idClient" : idClient.value,
        "idVente" : idVente.value,
        "tabModePaiement" : lignesModePaiement
    }
    infoPaiementJSON = JSON.stringify(infoPaiement);
    requ.open('POST', './index.php?page=apiPaiement', true);
    requ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    requ.send("paiement="+infoPaiementJSON);
    // setTimeout(function(){window.location.replace("index.php?page=PassageCaisse")},1000);
}
/********************EVENTS********************/
ajout.addEventListener("click", ajoutLigne);
supprTout.addEventListener("click", supprTableau)
payer.addEventListener("click", recupLaMoula)
/********************API********************/
requ.onreadystatechange = function (e) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
            console.log("Réponse reçue: %s", this.responseText);
            // reponse = JSON.parse(this.responseText);
            // console.log(reponse);
        }
    }
}