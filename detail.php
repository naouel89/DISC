<!DOCTYPE html>
<html>
<head>
    <title>Détails de l'Employé</title>
</head>
<body>
    <?php
    if (isset($_GET["id"])) {
        // Connexion à la base de données (à adapter)
        $conn = new mysqli("localhost", "votre_nom_utilisateur", "votre_mot_de_passe", "votre_base_de_donnees");
        if ($conn->connect_error) {
            die("Échec de la connexion à la base de données : " . $conn->connect_error);
        }
        
        $id = $_GET["id"];
        
        // Requête SQL pour récupérer les détails de l'employé
        $sql = "SELECT nom, titre FROM employes WHERE id=$id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h1>Détails de l'Employé</h1>";
            echo "<p>Nom : " . $row["nom"] . "</p>";
            echo "<p>Titre : " . $row["titre"] . "</p>";
        } else {
            echo "Aucun employé trouvé.";
        }
        
        $conn->close();
    } else {
        echo "ID d'employé manquant.";
    }
    ?>
    <a href="index.php">Retour à la liste</a>
</body>
</html>
