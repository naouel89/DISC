<?php
// Vérifie si la requête HTTP est une soumission de formulaire (méthode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données du formulaire depuis la superglobale $_POST
    $disc_title = $_POST['disc_title'];
    $disc_year = $_POST['disc_year'];
    $disc_label = $_POST['disc_label'];
    $disc_genre = $_POST['disc_genre'];
    $disc_price = $_POST['disc_price'];
    $artist_id = $_POST['artist_id'];

    // Gestion du téléchargement de l'image du disque
    $uploaded_file = $_FILES['disc_picture']['tmp_name'];
    $target_dir = 'uploads/'; // Répertoire de destination pour les images
    $target_file = $target_dir . basename($_FILES['disc_picture']['name']); // Chemin complet du fichier cible

    // Vérifie si le téléchargement du fichier est réussi
    if (move_uploaded_file($uploaded_file, $target_file)) {
        // Préparer une requête SQL pour insérer les données du disque dans la base de données
        $requete = $db->prepare("INSERT INTO disc (disc_title, disc_year, disc_label, disc_genre, disc_price, artist_id, disc_picture) VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Exécuter la requête avec les valeurs récupérées du formulaire
        $requete->execute([$disc_title, $disc_year, $disc_label, $disc_genre, $disc_price, $artist_id, $target_file]);
    }

    // Rediriger l'utilisateur vers la page de liste des disques après l'ajout réussi
    header("Location: index.php");
} else {
    // Afficher un message d'erreur si la méthode HTTP n'est pas autorisée
    echo "Méthode non autorisée.";
}
?>