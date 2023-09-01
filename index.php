<?php
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des enregistrements
    $requete = $db->query("SELECT * FROM disc ORDER BY disc_title ASC");
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();

    // Diviser les enregistrements en deux groupes
    $middle = ceil(count($tableau) / 2);
    $firstColumn = array_slice($tableau, 0, $middle);
    $secondColumn = array_slice($tableau, $middle);
    
?>
<<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des disques</title>
    <link rel="stylesheet" href="style.css"> <!-- Ajoutez votre fichier CSS externe ici -->
</head>
<body>
    <header>
        <h1>Liste des disques (<?= count($tableau) ?>)</h1>
        <a href="add_form.php" class="btn btn-primary">Ajouter</a>
    </header>
    
    <section class="disc-container">
        <div class="disc-column">
            <?php foreach ($firstColumn as $disc): ?>
                <div class="disc-card">
                    <div class="disc-image">
                        <img src="<?= $disc->disc_picture ?>" alt="<?= $disc->disc_title ?>">
                    </div>
                    <div class="disc-details">
                        <h2><?= $disc->disc_title ?></h2>
                        <p><strong>Label:</strong> <?= $disc->disc_label ?></p>
                        <p><strong>Genre:</strong> <?= $disc->disc_genre ?></p>
                        <p><strong>Year:</strong> <?= $disc->disc_year ?></p>
                        <a href="details_disc.php?disc_id=<?= $disc->disc_id ?>" class="btn btn-primary">Détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="disc-column">
            <?php foreach ($secondColumn as $disc): ?>
                <div class="disc-card">
                    <div class="disc-image">
                        <img src="<?= $disc->disc_picture ?>" alt="<?= $disc->disc_title ?>">
                    </div>
                    <div class="disc-details">
                        <h2><?= $disc->disc_title ?></h2>
                        <p><strong>Label:</strong> <?= $disc->disc_label ?></p>
                        <p><strong>Genre:</strong> <?= $disc->disc_genre ?></p>
                        <p><strong>Year:</strong> <?= $disc->disc_year ?></p>
                        <a href="details_disc.php?disc_id=<?= $disc->disc_id ?>" class="btn btn-primary">Détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>