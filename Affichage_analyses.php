<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Gestion clinique</title>
</head>
<body>
    <a class="retour" href="gestion_dossier_patient.php">Retour</a>
    <h2>Information sur Les analyses patients</h2>
<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$nomDeLaBase = "clinique";
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $nomDeLaBase);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
if (isset($_POST[''])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_day = $_POST['date_day'];
    $date_analyse = $_POST['date_analyse'];
    $analyse_prescrite = $_POST['analyse_prescrite'];
}

$sql = "SELECT * FROM analyse_medicale";
$resultat = $connexion->query($sql);
// Vérification du résultat de la requête
if ($resultat->num_rows > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Date du Jour</th>';
    echo '<th>Date de l\'Analyse</th>';
    echo '<th>Analyse Prescrite</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($resultat)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
        echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_day']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_analyse']) . '</td>';
        echo '<td>' . htmlspecialchars($row['analyse_prescrite']) . '</td>';
        echo '<td class="icones">';
        echo '<a href="modifier_analyse.php?id=' . $row['id'] . '"><img src="icones/icons8-modifier-la-propriété-48.png" alt="Modifier" title="Modifier"></a> ';
        echo '<a href="supprimer_analyse.php?id=' . $row['id'] . '"><img src="icones/icons8-supprimer-pour-toujours-48.png" alt="Supprimer" title="Supprimer"></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<h3>Aucune information d\'analyse patient trouvée</h3>';
}
?>

</body>
</html>

