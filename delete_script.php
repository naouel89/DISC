<?php
// Vérifiez si disc_id est présent dans la requête POST
if (isset($_POST['disc_id'])) {
    $disc_id = $_POST['disc_id'];

    // Effectuez la suppression du disque depuis la base de données en utilisant disc_id
    // Remplacez cette partie par votre logique de suppression en base de données

    // Redirigez vers la page de liste après la suppression
    header("Location: liste.php");
    exit();
} else {
    echo "ID de disque manquant dans la requête POST.";
}
?>
