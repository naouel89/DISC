    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Modifier le disque</title>
        <!-- Intégration de Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <?php
            $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', '1234');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $requete = $db->prepare("SELECT * FROM disc WHERE disc_id = ?");
            $requete->execute(array($_GET["disc_id"]));
            $disc = $requete->fetch(PDO::FETCH_OBJ);
            ?>

            <h1 class="mt-5">Modifier le disque</h1>
            <form action="update_script.php" method="post" enctype="multipart/form-data" class="mt-4">
                <input type="hidden" name="disc_id" value="<?= $disc->disc_id ?>">

                <div class="form-group">
                    <label for="disc_title">Titre:</label>
                    <input type="text" name="disc_title" value="<?= $disc->disc_title ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="disc_label">Label:</label>
                    <input type="text" name="disc_label" value="<?= $disc->disc_label ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="disc_year">Année:</label>
                    <input type="text" name="disc_year" value="<?= $disc->disc_year ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="disc_genre">Genre:</label>
                    <input type="text" name="disc_genre" value="<?= $disc->disc_genre ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="disc_price">Prix:</label>
                    <input type="text" name="disc_price" value="<?= $disc->disc_price ?>" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>

        <!-- Intégration de Bootstrap JS (facultatif) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
