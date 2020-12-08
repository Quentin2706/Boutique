<?php 

echo'<div class="conteneurTableau centrer">
        <div class="blocform">
            <form action="#" method="POST">
                <div>
                    <div class="centrer">
                        <label for="refCategories">Référence Catégories</label>
                        <input name="refCategories" type="text" id="refCategories" required/>
                    </div>
                    <div class="espace"></div>
                    <div class="centrer">
                        <label for="libCategories">Libellé Catégories</label>
                        <input name="libCategories" type="text" id="libCategories" required>
                    </div>
                    <div class="espace"></div>
                    <div class="centrer">
                        <label for="refUniversCategories">Univers</label>
                        <select name="refUniversCategories" id="refUniversCategories">
                            <option value="refUnivers">Divers</option>
                            <option value="refUnivers">Table</option>
                            <option value="refUnivers">Lit</option>
                            <option value="refUnivers">Cuisine</option>
                        </select>
                    </div>
                    <div class="espace"></div>
                    <div class="espace"></div>
                    <div class="centrer">
                    <div></div>
                        <div><input  class="bouton centrer" type="submit" value="Ajouter"><div>
                    <div></div>
                    </div>
                    <div class="espace"></div>
                    <div class="centrer">
                        <div><a href="index.php?page=default"><input  class="bouton centrer" type="submit" value="Retour"></a></div>
                    </div>
                </div>
            </form>
        </div>
    </div>'; 