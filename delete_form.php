<!DOCTYPE html>
<html>
<head>
    <title>Supprimer le Disque</title>
    <!-- Ajoutez le lien vers le fichier CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <?php
                // Vérifiez si disc_id est présent dans l'URL
                if (isset($_GET['disc_id'])) {
                    $disc_id = $_GET['disc_id'];
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<h1 class='card-title'>Confirmez la suppression du Disque</h1>";
                    echo "<p class='card-text'>Êtes-vous sûr de vouloir supprimer ce disque ?</p>";
                    // Le formulaire de confirmation de suppression
                    echo "<form action='delete_script.php' method='post'>";
                    echo "<input type='hidden' name='disc_id' value='$disc_id'>";
                    echo "<button type='submit' class='btn btn-danger'>Supprimer</button>";
                    echo "<a href='details_disc.php?disc_id=$disc_id' class='btn btn-secondary ml-2'>Annuler</a>";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "ID de disque manquant dans l'URL.";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Ajoutez le lien vers le fichier JavaScript Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
