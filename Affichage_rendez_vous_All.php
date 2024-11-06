<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion clinique</title>
</head>
<body>
<h2>Tous les rendez_vous patients à votre portée</h2>
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
    $date_rendez_vous = $_POST['date_rendez_vous'];
    $lieu = $_POST['lieu'];
}
// Requête SQL pour vérifier l'existence de l'utilisateur
$sql = "SELECT * FROM rendez_vous";
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
    echo '<th>Date du Rendez-vous</th>';
    echo '<th>Date du Prochain Rendez-vous</th>';
    echo '<th>Lieu</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $resultat->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
        echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_day']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_rendez_vous']) . '</td>';
        echo '<td>' . htmlspecialchars($row['date_prochain_rendez_vous']) . '</td>';
        echo '<td>' . htmlspecialchars($row['lieu']) . '</td>';
        echo '<td class="iconesaction">';
        echo '<a href="modifier_rv.php?id=' . $row['id'] . '"><img class="iconesaction" src="icones/icons8-modifier-la-propriété-48.png" alt="Modifier" title="Modifier"></a> ';
        echo '<a href="supprimer_rv.php?id=' . $row['id'] . '"><img class="iconesaction" src="icones/icons8-supprimer-pour-toujours-48.png" alt="Supprimer" title="Supprimer"></a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} else {
    echo '<h3>Aucun rendez-vous</h3>';
}
?>


</body>
</html>