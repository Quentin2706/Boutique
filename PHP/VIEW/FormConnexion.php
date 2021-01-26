<?php

echo '
<div></div>
<div class="form">
        <form action="index.php?page=ActionUser&mode=connexion" method="POST">
            <fieldset>
            <div class="centrer"><h3>Connexion</h3></div>
                <div class="colonne">
                    <div class="inputConnexion">
                        <label for="pseudo">Pseudo</label>
                        <input name="pseudo" type="text" id="pseudo" required/>
                    </div>
                    <div class="inputConnexion">
                        <label for="password">Mot de Passe</label>
                        <input name="password" type="password" id="password" required>
                    </div>
                </div>
                <div class="espace">
                </div>
                <div class="centrer">
                    <input  class="bouton centrer" type="submit" value="Connexion">
                </div>
            </fieldset>
        </form>
    </div>
<div></div>
';