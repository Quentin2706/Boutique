const requ2 = new XMLHttpRequest();//API Ventes Clients
/*********LES VARIABLES LISTE VENTES********/

    var entete = document.getElementById("hautTableau");
    var tableauVente = document.getElementsByClassName("tableau")[0];

    var rechVente = document.getElementsByTagName("input");
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
/*********LISTE VENTES********/

    rechVente[2].addEventListener("click", function (e) {
        filtreVente(e);
    })


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