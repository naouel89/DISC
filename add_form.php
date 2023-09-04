<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un disque</title>
    <!-- Intégration de Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Ajouter un disque</h1>
        <form action="add_script.php" method="post" enctype="multipart/form-data" class="mt-4">
            <!-- Champ pour le titre du disque -->
            <div class="form-group">
                <label for="disc_title">Titre du disque:</label>
                <input type="text" name="disc_title" id="disc_title" class="form-control" required>
            </div>

            <!-- Champ pour l'année du disque -->
            <div class="form-group">
                <label for="disc_year">Année:</label>
                <input type="text" name="disc_year" id="disc_year" class="form-control" required>
            </div>

            <!-- Champ pour le label du disque -->
            <div class="form-group">
                <label for="disc_label">Label:</label>
                <input type="text" name="disc_label" id="disc_label" class="form-control" required>
            </div>

            <!-- Champ pour le genre du disque -->
            <div class="form-group">
                <label for="disc_genre">Genre:</label>
                <input type="text" name="disc_genre" id="disc_genre" class="form-control" required>
            </div>

            <!-- Champ pour le prix du disque -->
            <div class="form-group">
                <label for="disc_price">Prix:</label>
                <input type="text" name="disc_price" id="disc_price" class="form-control" required>
            </div>

            <!-- Liste déroulante pour sélectionner l'artiste du disque -->
            <div class="form-group">
                <label for="artist_id">Artiste:</label>
                <select name="artist_id" id="artist_id" class="form-control" required>
                    <option value="">Sélectionnez un artiste</option>
                    <?php
                    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 
                    // Récupération de la liste des artistes depuis la base de données
                    $requete = $db->query("SELECT * FROM artist");
                    while ($artist = $requete->fetch(PDO::FETCH_ASSOC)) {
                        // Création des options de la liste déroulante avec les noms des artistes et leurs IDs
                        echo "<option value='" . $artist['artist_id'] . "'>" . $artist['artist_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Champ pour téléverser l'image du disque -->
            <div class="form-group">
                <label for="disc_picture">Image du disque:</label>
                <input type="file" name="disc_picture" id="disc_picture" class="form-control-file" required>
            </div>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" class="btn btn-primary">Ajouter</button>

            <!-- Bouton pour retourner à la liste des disques sans soumettre le formulaire -->
            <a href="index.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>

    <!-- Intégration de Bootstrap JS (facultatif) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
