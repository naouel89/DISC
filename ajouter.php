<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Employé</title>
</head>
<body>
    <h1>Ajouter un Employé</h1>
    <form action="ajout_traitement.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom"><br>
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre"><br>
        <input type="submit" value="Ajouter">
    </form>
    <a href="index.php">Retour à la liste</a>
</body>
</html>
