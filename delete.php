<?php
// Connexion à la base de données
try {
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    die();
}

// Traitement de la suppression
if (isset($_GET['disc_id'])) {
    $discId = $_GET['disc_id'];

    // Récupération du chemin de l'image avant suppression
    $query = "SELECT disc_picture FROM disc WHERE disc_id = :discId";
    $statement = $db->prepare($query);
    $statement->bindParam(':discId', $discId);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Suppression de l'enregistrement
    $queryDelete = "DELETE FROM disc WHERE disc_id = :discId";
    $statementDelete = $db->prepare($queryDelete);
    $statementDelete->bindParam(':discId', $discId);

    if ($statementDelete->execute()) {
        // Suppression de l'image du dossier pictures
        $picturePath = $result['disc_picture'];
        if (!empty($picturePath) && file_exists($picturePath)) {
            unlink($picturePath);
        }

        header("Location: index.php"); // Redirection vers la liste des disques
        exit;
    } else {
        echo "Une erreur est survenue lors de la suppression du disque.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Supprimer un disque</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Supprimer un disque</h2>
        <p>Êtes-vous sûr de vouloir supprimer ce disque ?</p>
        <form action="" method="POST" class="d-inline">
            <input type="hidden" name="disc_id" value="<?= $_GET['disc_id'] ?>">
            <button type="submit" class="btn btn-danger">Oui, supprimer</button>
            <a href="index.php" class="btn btn-primary">Annuler</a>
        </form>
    </div>

    <!-- Intégration de Bootstrap JS (facultatif) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
