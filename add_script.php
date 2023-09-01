<?php
// Vérifie si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Connexion à la base de données MySQL
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des données du formulaire
        $disc_title = $_POST['disc_title'];
        $disc_year = $_POST['disc_year'];
        $disc_label = $_POST['disc_label'];
        $disc_genre = $_POST['disc_genre'];
        $disc_price = $_POST['disc_price'];
        $artist_id = $_POST['artist_id'];

        // Traitement du fichier image uploadé
        $uploaded_file = $_FILES['disc_picture']['tmp_name'];
        $target_dir = 'picture'; // Répertoire de destination pour les images
        $target_file = $target_dir . basename($_FILES['disc_picture']['name']);
        $target_file = $target_dir . $original_file_name;
        move_uploaded_file($uploaded_file, $target_file); // Déplace le fichier téléchargé vers le répertoire de destination

        // Requête SQL préparée pour insérer un nouveau disque dans la base de données
        $query = "INSERT INTO disc (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id)
        VALUES (:title, :year, :picture, :label, :genre, :price, :artist_id)";

        // Préparation de la requête
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $disc_title);
        $statement->bindValue(':year', $disc_year);
        $statement->bindValue(':picture', $target_file);
        $statement->bindValue(':label', $disc_label);
        $statement->bindValue(':genre', $disc_genre);
        $statement->bindValue(':price', $disc_price);
        $statement->bindValue(':artist_id', $artist_id);

        // Exécution de la requête SQL
        $statement->execute();

        // Redirige l'utilisateur vers la page d'accueil après l'ajout du disque
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage(); // En cas d'erreur, affiche un message d'erreur
    }
} else {
    echo "Méthode non autorisée."; // Si la méthode n'est pas POST, affiche un message d'erreur
}
?>
