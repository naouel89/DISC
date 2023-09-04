<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $disc_id = $_POST["disc_id"];
        $disc_title = $_POST["disc_title"];
        $disc_label = $_POST["disc_label"];
        $disc_year = $_POST["disc_year"];
        $disc_genre = $_POST["disc_genre"];
        $disc_price = $_POST["disc_price"];
        $artist_id = $_POST["artist_id"];

        // Vérification et traitement de la nouvelle image si elle a été fournie
        if ($_FILES["disc_new_picture"]["name"]) {
            $target_dir = "uploads/"; // Répertoire où vous souhaitez stocker les images
            $target_file = $target_dir . basename($_FILES["disc_new_picture"]["name"]);
            move_uploaded_file($_FILES["disc_new_picture"]["tmp_name"], $target_file);

            // Mettre à jour la base de données avec le nouveau chemin de l'image
            $update_image_query = "UPDATE disc SET disc_picture = :disc_picture WHERE disc_id = :disc_id";
            $stmt = $db->prepare($update_image_query);
            $stmt->bindParam(':disc_picture', $target_file, PDO::PARAM_STR);
            $stmt->bindParam(':disc_id', $disc_id, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Mettre à jour les autres informations du disque
        $update_query = "UPDATE disc SET disc_title = :disc_title, disc_label = :disc_label, disc_year = :disc_year, disc_genre = :disc_genre, disc_price = :disc_price, artist_id = :artist_id WHERE disc_id = :disc_id";
        $stmt = $db->prepare($update_query);
        $stmt->bindParam(':disc_title', $disc_title, PDO::PARAM_STR);
        $stmt->bindParam(':disc_label', $disc_label, PDO::PARAM_STR);
        $stmt->bindParam(':disc_year', $disc_year, PDO::PARAM_INT);
        $stmt->bindParam(':disc_genre', $disc_genre, PDO::PARAM_STR);
        $stmt->bindParam(':disc_price', $disc_price, PDO::PARAM_STR);
        $stmt->bindParam(':artist_id', $artist_id, PDO::PARAM_INT);
        $stmt->bindParam(':disc_id', $disc_id, PDO::PARAM_INT);
        $stmt->execute();

        // Rediriger vers la page de détails du disque après la mise à jour
        header("Location: index.php?disc_id=" . $disc_id);
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}
?>
