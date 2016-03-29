<h1>Liste des produits (<?= $nbTotal ?>)</h1>
<table class="table table-striped table-bordered">
    <tr>
        <th>Titre</th>
        <th>Genre</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>prix</th>
        <th></th>
    </tr>
    <?php foreach ($catalogue as $livre): ?>
        <tr>
            <td><?= $livre['titre'] ?></td>
            <td><?= $livre['genre'] ?></td>
            <td><?= $livre['nom_auteur'] ?></td>
            <td><?= $livre['nom_editeur'] ?></td>
            <td class="text-right"><?= currency_format($livre['prix']) ?></td>
            <td><a href="/ajout-panier?id=<?= $livre['id'] ?>">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="text-center">
    <ul class="pagination ">
        <?php
        for ($i = 1; $i <= $nbPages; $i++) {
            $active = '';
            if ($i == $page) {
                $active = "class='active'";
            }
            
            $critere = '';
            if(!empty($recherche)){
                $critere = "&recherche=$recherche";
            }
            echo "<li $active><a href='/produit?page=$i".$critere."'>$i</a></li>";
        }
        ?>
    </ul>
</div>
