<div class="col-md-4 col-md-offset-4">
    <form class="form" action="/login" method="POST">
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
            <label>Email :</label>
            <input type="text" name="login" value="<?= $login ?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Mot de passe :</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit">Valider</button>
        </div>
    </form>
</div>


