<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un disque</title>
    <!-- Ajout des liens Bootstrap pour le style (facultatif) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un disque</h1>
        <form action="add_script.php" method="post" enctype="multipart/form-data">
            <!-- Champ pour le titre du disque -->
            <div class="form-group">
                <label for="disc_title">Titre du disque:</label>
                <input type="text" class="form-control" name="disc_title" id="disc_title" required>
            </div>

            <!-- Champ pour l'année du disque -->
            <div class="form-group">
                <label for="disc_year">Année:</label>
                <input type="text" class="form-control" name="disc_year" id="disc_year" required>
            </div>

            <!-- Champ pour le prix du disque -->
            <div class="form-group">
                <label for="disc_price">Prix :</label>
                <input type="text" name="disc_price" id="disc_price" class="form-control" required>
            </div>
            
            <!-- Champ pour l'image du disque -->
            <div class="form-group">
                <label for="disc_picture">Image :</label>
                <input type="file" name="disc_picture" id="disc_picture" class="form-control-file" required>
            </div>

            <!-- Champ pour le label du disque -->
            <div class="form-group">
                <label for="disc_label">Label:</label>
                <input type="text" class="form-control" name="disc_label" id="disc_label" required>
            </div>

            <!-- Champ pour le genre du disque -->
            <div class="form-group">
                <label for="disc_genre">Genre:</label>
                <input type="text" class="form-control" name="disc_genre" id="disc_genre" required>
            </div>

            <!-- Sélection de l'artiste associé -->
            <div class="form-group">
                <label for="artist_id">Artiste:</label>
                <select class="form-control" name="artist_id" id="artist_id" required>
                    <?php
                    try {
                        // Connexion à la base de données MySQL
                        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Récupération de la liste des artistes depuis la base de données
                        $requete = $db->query("SELECT * FROM artist ORDER BY artist_name ASC");
                        while ($artist = $requete->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $artist['artist_id'] . "'>" . $artist['artist_name'] . "</option>";
                        }
                    } catch (PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                        die();
                    }
                    ?>
                </select>
            </div>

            <!-- Bouton pour soumettre le formulaire -->
            <button type="submit" class="btn btn-primary">Ajouter</button>
            
            <!-- Lien pour retourner à la liste des disques -->
            <a href="index.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>
