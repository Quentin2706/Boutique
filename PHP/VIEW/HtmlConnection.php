
<!-- Affichage du formulaire qui permet la saisie -->
<form method="post" action="index.php?action=connection">

	<fieldset>
		<legend>Connexion</legend>
		<div class="colonne">
			<div> <label for="pseudo">Pseudo :</label>
				<input name="pseudo" type="text" id="pseudo" />
			</div>
			<div> <label for="password">Mot de Passe :</label>
				<input type="password" name="password" id="password" />
			</div>
		</div>
	</fieldset>
	<div class="centrer">
		<input class="bouton centrer" type="submit" value="Connexion" />
	</div>
</form>
