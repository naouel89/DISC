<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $titre = $_POST["titre"];
    
    // Connexion à la base de données (à adapter)
    $conn = new mysqli("localhost", "votre_nom_utilisateur", "votre_mot_de_passe", "votre_base_de_donnees");
    if ($conn->connect_error) {
        die("Échec de la connexion à la base de données : " . $conn->connect_error);
    }
    
    // Requête SQL pour ajouter un nouvel employé
    $sql = "INSERT INTO employes (nom, titre) VALUES ('$nom', '$titre')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Employé ajouté avec succès.";
    } else {
        echo "Erreur : " . $conn->error;
    }
    
    $conn->close();
}
?>
<br>
<a href="index.php">Retour à la liste</a>
