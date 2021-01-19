
/*********LES VARIABLES LISTE CLIENTS********/
    var lesClients = document.getElementsByClassName("ligne");

/*********LISTE CLIENTS********/
    for (let i = 1; i < lesClients.length; i++) {
        lesClients[i].addEventListener("click", function (e) {
            detailAchat(e);
        });
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
