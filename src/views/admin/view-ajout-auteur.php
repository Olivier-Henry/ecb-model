
<div class="col-md-4 col-md-offset-4">
    <h1>Ajout d'un auteur</h1>
    <form class="form" action="/admin/ajout-auteur" method="POST">
         <?php
        //Affichage des messages flash
        
            $flashes = getFlash();
            if(count($flashes)>0){
                echo "<div class='alert alert-danger'>\n";
                foreach ($flashes as $message) {
                    echo "<p>$message</p>\n";
                }
                echo "</div>\n";
            }
        ?>
        <div class="form-group">
            <label>nom :</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label>prenom :</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit">Ajouter</button>
        </div>
    </form>
</div>

