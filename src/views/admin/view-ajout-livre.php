<div class="col-md-4 col-md-offset-4">
    <h1>Ajout d'un livre</h1>
    <form class="form" action="/admin/ajout-livre" method="POST">
        <div class="form-group">
            <label>Titre :</label>
            <input type="text" name="titre" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Prix :</label>
            <input type="text" name="prix" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date d'achat :</label>
            <input type="date" name="date_achat" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Editeur :</label>
            <select name="editeur" class="form-control">
                <?php foreach ($editeurs as $nom):?>
                <option value="<?=$nom['id']?>"><?=$nom['value']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label>Auteur :</label>
            <select name="auteur" class="form-control">
                <?php foreach ($auteurs as $nom):?>
                <option value="<?=$nom['id']?>"><?=$nom['value']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label>Genre :</label>
            <select name="genre" class="form-control">
                <?php foreach ($genres as $genre):?>
                <option value="<?=$genre['id']?>"><?=$genre['value']?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit">Ajouter</button>
        </div>
    </form>
</div>
