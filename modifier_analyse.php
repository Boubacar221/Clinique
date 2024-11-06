<?php
$host = 'localhost'; 
$username = 'root'; 
$password = '';     
$dbname = 'clinique'; 

// Connexion à la base de données
$connexion = mysqli_connect($host, $username, $password, $dbname);

// Vérifiez si la connexion a échoué
if (!$connexion) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérifiez si l'ID est défini et sécurisez-le
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    die("ID invalide");
}

// Vérifiez si le bouton "modifier" a été cliqué
if (isset($_POST['modifier'])) {
    // Vérifiez si toutes les variables $_POST nécessaires existent et ne sont pas vides
    if (!empty($_POST['nom']) &&
        !empty($_POST['prenom']) &&
        !empty($_POST['date_day']) &&
        !empty($_POST['date_analyse']) &&
        !empty($_POST['analyse_prescrite'])) {

        // Utilisez `htmlspecialchars()` pour prévenir les failles XSS
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $date_day = htmlspecialchars($_POST['date_day']);
        $date_analyse = htmlspecialchars($_POST['date_analyse']);
        $analyse_prescrite = htmlspecialchars($_POST['analyse_prescrite']);

        // Préparez la requête SQL
        $sql = "UPDATE analyse_medicale
                SET nom = ?, prenom = ?, date_day = ?, date_analyse = ?, analyse_prescrite = ?
                WHERE id = ?";

        // Utilisez une requête préparée pour éviter les injections SQL
        $stmt = $connexion->prepare($sql);
        $stmt->bind_param("sssssi", $nom, $prenom, $date_day, $date_analyse, $analyse_prescrite, $id);

        // Exécutez la requête SQL et vérifiez si elle a réussi
        if ($stmt->execute()) {
            // Si la modification a réussi, rediriger vers la page d'affichage
            header("Location: affichage_analyses.php?message=Modification réussie");
            exit();
        } else {
            // Si une erreur se produit, rediriger avec un message d'erreur
            header("Location: affichage_analyses.php?message=Modification échouée");
            exit();
        }
    } else {
        // Redirection en cas de champs vides
        header("Location: affichage_analyses.php?message=Champs vides");
        exit();
    }
}

// Récupération des données existantes pour l'affichage du formulaire
$sql = "SELECT * FROM analyse_medicale WHERE id = ?";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultat = $stmt->get_result();

// Affichage du formulaire si des données sont trouvées
if ($resultat->num_rows > 0) {
    $row = $resultat->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier Analyse</title>
</head>
<body>
    <form class="formajoutpatient" action="" method="post">
        <h1>Modifier l'analyse d'un patient</h1>
        Nom : <input type="text" name="nom" value="<?php echo htmlspecialchars($row['nom']); ?>"><br><br>
        Prénom : <input type="text" name="prenom" value="<?php echo htmlspecialchars($row['prenom']); ?>"><br><br>
        Date du jour : <input type="date" name="date_day" value="<?php echo htmlspecialchars($row['date_day']); ?>"><br><br>
        Date de l'analyse : <input type="date" name="date_analyse" value="<?php echo htmlspecialchars($row['date_analyse']); ?>"><br><br>
        Analyse prescrite : <input type="text" name="analyse_prescrite" value="<?php echo htmlspecialchars($row['analyse_prescrite']); ?>"><br><br>
        <input type="submit" value="Modifier" name="modifier">
        <a href="affichage_analyses.php">Annuler</a>
    </form>
</body>
</html>
<?php
} else {
    echo "<h3>Aucune donnée trouvée pour cet ID.</h3>";
}
?>
