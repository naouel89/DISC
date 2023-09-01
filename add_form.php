<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un disque</title>
    <!-- Ajout des liens Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter un disque</h1>
        <form action="add_script.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="disc_title">Titre du disque:</label>
                <input type="text" class="form-control" name="disc_title" id="disc_title" required>
            </div>

            <div class="form-group">
                <label for="disc_year">Année:</label>
                <input type="text" class="form-control" name="disc_year" id="disc_year" required>
            </div>

            <div class="form-group">
                <label for="disc_price">Prix :</label>
                <input type="text" class="form-control" name="disc_price" id="disc_price" required>
            </div>            
            
            <div class="form-group">
                <label for="disc_picture">Image :</label>
                <input type="file" name="disc_picture" id="disc_picture" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label for="disc_label">Label:</label>
                <input type="text" class="form-control" name="disc_label" id="disc_label" required>
            </div>

            <div class="form-group">
                <label for="disc_genre">Genre:</label>
                <input type="text" class="form-control" name="disc_genre" id="disc_genre" required>
            </div>

         

            <div class="form-group">
                <label for="artist_id">Artiste:</label>
                <select class="form-control" name="artist_id" id="artist_id">
                    <?php
                    try {
                        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="index.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>
</body>
</html>
