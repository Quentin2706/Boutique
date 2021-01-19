/*********LES VARIABLES LISTE DONNEES********/
    var lesMenus = document.getElementsByClassName("menu");
    var lesSousMenu = document.getElementsByClassName("sousMenu");
    var lesContenuSousMenu = document.getElementsByClassName("contenuSousMenu");


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

/*********LISTE DONNEES********/

    for (let i = 0; i < lesMenus.length; i++) {
        lesMenus[i].addEventListener("click", afficheSousMenu);
    }
    for (let i = 0; i < lesContenuSousMenu.length; i++) {
        lesContenuSousMenu[i].addEventListener("click", redirige);
    }
