<?php
try {
    // Connexion à la base de données MySQL
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifie si le paramètre 'disc_id' est présent dans l'URL
    if (isset($_GET['disc_id'])) {
        // Récupère l'ID du disque depuis l'URL
        $discId = $_GET['disc_id'];

        // Requête SQL pour récupérer les détails du disque et du nom de l'artiste associé
        $query = "SELECT d.*, a.artist_name
                  FROM disc d
                  INNER JOIN artist a ON d.artist_id = a.artist_id
                  WHERE d.disc_id = :discId";
        
        // Préparation de la requête SQL avec un paramètre :discId
        $statement = $db->prepare($query);
        $statement->bindValue(':discId', $discId);
        $statement->execute();

        // Récupère les résultats sous forme de tableau associatif
        $disc = $statement->fetch(PDO::FETCH_ASSOC);
    } else {
        // Si 'disc_id' n'est pas spécifié dans l'URL, affiche un message d'erreur et arrête le script
        die("ID de disque non spécifié.");
    }
} catch (PDOException $e) {
    // En cas d'erreur PDO, affiche l'erreur et arrête le script
    echo "Erreur : " . $e->getMessage() . "<br>";
    echo "N° : " . $e->getCode();
    die("Fin du script");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Détails du Disque</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if ($disc): ?>
            <!-- Affiche les détails du disque -->
            <h2><?= $disc['disc_title'] ?></h2>
            <p>Artiste: <?= $disc['artist_name'] ?></p>
            <p>Année: <?= $disc['disc_year'] ?></p>
            <p>Genre: <?= $disc['disc_genre'] ?></p>
            <p>Label: <?= $disc['disc_label'] ?></p>
            <p>Prix: <?= $disc['disc_price'] ?></p>
            <img src="<?= $disc['disc_picture'] ?>" alt="<?= $disc['disc_title'] ?>" class="img-fluid">
            
            <!-- Liens pour Modifier, Supprimer et Retour -->
            <div class="mt-3">
                <a href="update_form.php?disc_id=<?= $discId ?>" class="btn btn-primary">Modifier</a>
                <a href="delete.php?disc_id=<?= $discId ?>" class="btn btn-danger">Supprimer</a>
                <a href="index.php" class="btn btn-primary">Retour à la liste</a>
            </div>
        <?php else: ?>
            <!-- Affiche un message si le disque n'est pas trouvé -->
            <p>Disque non trouvé.</p>
        <?php endif; ?>
    </div>

    <!-- Intégration de Bootstrap JS (facultatif) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
