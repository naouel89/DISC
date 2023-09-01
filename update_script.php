    <?php
    try {
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $discId = $_POST['disc_id'];
            $discTitle = $_POST['disc_title'];
            $discLabel = $_POST['disc_label'];
            $discGenre = $_POST['disc_genre'];
            $discYear = $_POST['disc_year'];
            $artistId = $_POST['artist'];
            $discPrice = $_POST['disc_price'];

            // Mise à jour des informations du disque
            $updateQuery = "UPDATE disc SET disc_title = :title, disc_label = :label, disc_genre = :genre, disc_year = :year, artist_id = :artist, disc_price = :price WHERE disc_id = :discId";
            $updateStatement = $db->prepare($updateQuery);
            $updateStatement->bindValue(':title', $discTitle);
            $updateStatement->bindValue(':label', $discLabel);
            $updateStatement->bindValue(':genre', $discGenre);
            $updateStatement->bindValue(':year', $discYear);
            $updateStatement->bindValue(':artist', $artistId);
            $updateStatement->bindValue(':price', $discPrice);
            $updateStatement->bindValue(':discId', $discId);
            $updateStatement->execute();

            // Mise à jour de l'image du disque
            if ($_FILES['disc_picture']['size'] > 0) {
                $targetDirectory = 'picture';
                $targetFilePath = $targetDirectory . basename($_FILES['disc_picture']['name']);
                move_uploaded_file($_FILES['disc_picture']['tmp_name'], $targetFilePath);

                $updatePictureQuery = "UPDATE disc SET disc_picture = :picture WHERE disc_id = :discId";
                $updatePictureStatement = $db->prepare($updatePictureQuery);
                $updatePictureStatement->bindValue(':picture', $targetFilePath);
                $updatePictureStatement->bindValue(':discId', $discId);
                $updatePictureStatement->execute();
            }

            // Redirection vers la page de liste
            header("Location: index.php");
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
    ?>
