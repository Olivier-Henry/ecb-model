
<div class="col-md-4 col-md-offset-4">
    <h1>Ajout d'un genre</h1>
    <form class="form" action="/admin/ajout-genre" method="POST">
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
            <label>Genre :</label>
            <input type="text" name="genre" class="form-control" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit">Ajouter</button>
        </div>
    </form>
</div>



